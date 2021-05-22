document.addEventListener("DOMContentLoaded", function () {

    console.log('toto')
    let sweep = document.querySelectorAll('.sweep');
    sweep.forEach(element => {
        console.log('sweep elem', element)
        element.addEventListener('click', function () {
            swipe(1);
        });
    });

//this get all the button which have "right" like id and add the ivent listener
    var keep = document.querySelectorAll('.keep');

    keep.forEach(element => {
        console.log(element)
        element.addEventListener('click', function (e) {
            swipe(2);
        },false);
    });
    var listKeep = [];
    var count = 0;
    function swipe(type) {
        console.log(event.currentTarget)
        var supperParent = event.currentTarget.parentNode;
        var mainBody = document.querySelector('#main_content')
        var list_recipes = document.querySelector('#list_recipes')
        var parent = supperParent.parentNode.parentNode

        var choice = document.createElement("div");
        console.log('supperParent', supperParent)
        console.log('parent', parent)
        const idIngredient = event.currentTarget.dataset.id
        event.stopPropagation();
        if (type == 1) {


            parent.className += " rotate-left"
            choice.className += "status dislike"
            text = document.createTextNode("Dislike");
        } else {

            parent.className += " rotate-right"
            choice.className += "status like"
            text = document.createTextNode("Like");
            console.log('ing id', idIngredient)
            listKeep.push(idIngredient);
            list_recipes.classList.remove("visually-hidden");

            localStorage.setItem("ingredients", JSON.stringify(listKeep));

        }
        console.log('my list of keep',listKeep)
        // parent.className += " rotate-left"
        choice.appendChild(text);
        supperParent.appendChild(choice)

        setTimeout(function() {

            parent.remove();

            parent.classList.remove("rotate-right");
            parent.classList.remove("rotate-left");
            console.log(parent)
            var status = supperParent.querySelector('.status');
            status.remove()
            mainBody.prepend(parent)
        }, 2000);

        count++;
        var total = document.querySelectorAll('#main_content>div');
        console.log("total " + total.length)
        if (count == total.length) {
            count = 0;
            displayRecipes();
        }

    }

    var list_btn = document.querySelector('#list_recipes')
    list_btn.addEventListener('click', displayRecipes)
    const section = document.querySelector('#title_choices')
    console.log(section)
    let url;
    if (section != null) {

        url = section.dataset.url;
    }

    function displayRecipes(){
        // alert('toto')
        // alert(url)
        const listOfing = JSON.parse(window.localStorage.getItem("ingredients"))
        parent = document.querySelector('#supper_parent')
        $.post(url, {
            "listOfingredients": listOfing
        }, (response) => {
            section.innerHTML = "Liste de Recettes"
            // console.log(response.content)
            // console.log('local', response.value)
            parent.innerHTML = response.content;
            $(".rateyo").rateYo({
                readOnly: true,
                starWidth: "20px"

            });
            // window.location.href = './profil';
        });

    }


});
