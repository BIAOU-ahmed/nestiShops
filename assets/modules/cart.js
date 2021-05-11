document.addEventListener("DOMContentLoaded", function () {
    const addButtons = document.querySelectorAll('.add_to_cart');

    addButtons.forEach(element => {
        element.addEventListener('click', add);
        console.log('add event')

    });

    function add() {
        let qtyInput = document.querySelector('#qte_article');
        const article = qtyInput.dataset.id;
        const quantity = qtyInput.value
        console.log('quantity', qtyInput.value)
        console.log('id', qtyInput.dataset.id)
        console.log('add to cart')
        window.localStorage.setItem(article, quantity);

        displayTotal()

    }

    displayTotal()

    function displayTotal() {
        // let shop = document.querySelector('.shop')
        // console.log('shopp', shop)
        //

        let total = 0;
        for (let i = 0; i < localStorage.length; i++) {
            var localValue = localStorage.getItem(localStorage.key(i));
            if (Number(localStorage.key(i))) {
                total += Number(localValue);
            }

        }

        // const localArticles = JSON.parse(window.localStorage.getItem('test'));
        // localArticles.forEach(elm => {
        //     total += Number(elm.nb);
        // })
        let shops = document.querySelectorAll('.shop');
        console.log('number', total);
        shops.forEach(elm => {
            elm.textContent = String(total);

        })
    }

    const requestBody = [{
        'email': 'asd@example.com',
        'pass': '123',
    }];
    const section = document.querySelector('#cart_container')
    console.log(section)
    let url;
    if (section != null) {

        url = section.dataset.url;
        load()
    }

    // $.ajax({
    //     url: url,
    //     type: "post",
    //     data: requestBody,
    //     success: function(data) {
    //         alert(data)
    //         console.log(data.content)
    //         console.log(section)
    //         section.innerHTML = data.content;
    //     }
    // });

    // const clear = document.querySelector('#clearStogare')
    //
    // if(clear){
    //     console.log('cleare the local')
    // }

    function load() {
        let localArticles = [];
        for (let i = 0; i < localStorage.length; i++) {
            var localValue = localStorage.getItem(localStorage.key(i));
            if (Number(localStorage.key(i))) {
                const article = {id: localStorage.key(i), nb: localValue}
                localArticles.push(article);
            }

        }
        loadCart(localArticles);
    }

    function loadCart(localArticles) {
        $.post(url, {
            "localStorage": localArticles
        }, (response) => {
            // console.log(response.content)
            // console.log('local', response.value)
            section.innerHTML = response.content;

            let buttonPlus = document.querySelectorAll('.articleUp');
            console.log(buttonPlus)
            buttonPlus.forEach(elm => {
                elm.addEventListener('click', increaseNumber)
            })
            let buttonMinus = document.querySelectorAll('.articleDown');
            buttonMinus.forEach(elm => {
                elm.addEventListener('click', decreaseNumber)
            })
            displayTotal()
            // window.location.href = './profil';
        });
    }


    function increaseNumber(e) {
        console.log('click')
        console.log(e.target)

        var localValue = Number(localStorage.getItem(e.target.dataset.id));
        window.localStorage.setItem(e.target.dataset.id, String(localValue + 1))
        console.log('nb', localValue)
        load();
    }

    function decreaseNumber(e) {
        console.log('click')
        console.log(e.target)

        var localValue = Number(localStorage.getItem(e.target.dataset.id));
        if (localValue > 1) {
            window.localStorage.setItem(e.target.dataset.id, String(localValue - 1))

        }
        console.log('nb', localValue)
        load();
    }

    // async loadUrl(url)
    // {
    //     const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
    //         headers: {
    //             'X-Requested-with': 'XMLHttpRequest'
    //         }
    //     })
    // }

    const clear = document.querySelector('#clear_local');

    if (clear) {
        // console.log('local storage', localStorage)
        // const length = localStorage.length
        // for (let i = 0; i < length; i++) {
        //     var localValue = localStorage.getItem(localStorage.key(i));
        //     console.log('just key', localStorage.key(i), 'key', i)
        //     if (Number(localStorage.key(i))) {
        //         localStorage.removeItem(localStorage.key(i));
        //         console.log('storage ', localStorage.key(i))
        //     }
        //     console.log('in for')
        // }
        localStorage.clear()
        displayTotal()
        console.log('cleare the local')
    } else {
        console.log('not clear')
    }
});