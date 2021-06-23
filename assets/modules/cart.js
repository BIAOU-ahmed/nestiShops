import { event } from "jquery";

export default class Cart {
    constructor(element) {
        this.load()
    }

    load() {
        const addButtons = document.querySelectorAll('.add_to_cart');

        addButtons.forEach(element => {
            element.addEventListener('click', add);

        });

        const addFromRecipeBtn = document.querySelectorAll('.add_to_cart_from_recipe');
        addFromRecipeBtn.forEach(element => {
            element.addEventListener('click', add);

        });


        function add(e) {
            let qtyInput = e.target;
            const article = qtyInput.dataset.id;
            const inventory = qtyInput.dataset.inventory;
            const articleDetailInput = document.querySelector('#qte_article');
            const quantity = document.querySelector('#qte_article') ? articleDetailInput.value : 1
    
            if (Number(quantity) > 0 && Number(quantity) <= Number(inventory)) {
                window.localStorage.setItem(article, quantity);
                qtyInput.value = "1";
            } else {
                alert('La quantité est incorect')
            }

            displayTotal()
            event.preventDefault
        }

        displayTotal()

        function displayTotal() {


            let total = 0;
            for (let i = 0; i < localStorage.length; i++) {
                var localValue = localStorage.getItem(localStorage.key(i));
                if (Number(localStorage.key(i))) {
                    total += Number(localValue);
                }

            }


            let shops = document.querySelectorAll('.shopping_cart');
            shops.forEach(elm => {
                elm.textContent = String(total);

            })
        }


        const section = document.querySelector('#cart_container')

        let url;
        if (section != null) {

            url = section.dataset.url;
            load()
        }


        function load() {
            let localArticles = [];
            for (let i = 0; i < localStorage.length; i++) {
                var localValue = localStorage.getItem(localStorage.key(i));
                if (Number(localStorage.key(i))) {
                    const article = { id: localStorage.key(i), nb: localValue }
                    localArticles.push(article);
                }

            }
            loadCart(localArticles);
        }

        function loadCart(localArticles) {
            $.post(url, {
                "localStorage": localArticles
            }, (response) => {
                section.innerHTML = response.content;

                let buttonPlus = document.querySelectorAll('.articleUp');
                buttonPlus.forEach(elm => {
                    elm.addEventListener('click', increaseNumber)
                })
                let buttonMinus = document.querySelectorAll('.articleDown');
                buttonMinus.forEach(elm => {
                    elm.addEventListener('click', decreaseNumber)
                })
                let buttonDelete = document.querySelectorAll('.deleteArticle');
                buttonDelete.forEach(elm => {
                    elm.addEventListener('click', deleteArticle)
                })
                displayTotal()
            });
        }

        function deleteArticle(e) {
            window.localStorage.removeItem(e.target.dataset.id);
            load();
        }

        function increaseNumber(e) {

            var localValue = Number(localStorage.getItem(e.target.dataset.id));
            const inventory = e.currentTarget.dataset.inventory
            if (Number(localValue) < Number(inventory)) {
                window.localStorage.setItem(e.currentTarget.dataset.id, String(localValue + 1))
                load();
            }

        }

        function decreaseNumber(e) {

            var localValue = Number(localStorage.getItem(e.currentTarget.dataset.id));
            if (localValue > 1) {
                window.localStorage.setItem(e.currentTarget.dataset.id, String(localValue - 1))

            }
            load();
        }

        const clear = document.querySelector('#clear_local');

        if (clear) {
            localStorage.clear()
            displayTotal()
        }
    }
}