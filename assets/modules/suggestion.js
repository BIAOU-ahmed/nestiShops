
export default class Suggestion {

    constructor(element) {
        this.load()
    }

    load() {

        let sweep = document.querySelectorAll('.sweep');
        sweep.forEach(element => {
            element.addEventListener('click', function () {
                swipe(1);
            });
        });

        //this get all the button which have "right" like id and add the ivent listener
        var keep = document.querySelectorAll('.keep');

        keep.forEach(element => {
            element.addEventListener('click', function (e) {
                swipe(2);
            }, false);
        });
        var listKeep = [];
        var count = 0;
        function swipe(type) {
            var supperParent = event.currentTarget.parentNode;
            var mainBody = document.querySelector('#main_content')
            var list_recipes = document.querySelector('#list_recipes')
            var parent = supperParent.parentNode.parentNode

            var choice = document.createElement("div");
            const idIngredient = event.currentTarget.dataset.id
            event.stopPropagation();
            var text;
            if (type == 1) {


                parent.className += " rotate-left"
                choice.className += "status dislike"
                text = document.createTextNode("Dislike");
            } else {

                parent.className += " rotate-right"
                choice.className += "status like"
                text = document.createTextNode("Like");
                listKeep.push(idIngredient);
                list_recipes.classList.remove("visually-hidden");

                localStorage.setItem("ingredients", JSON.stringify(listKeep));

            }
            // parent.className += " rotate-left"
            choice.appendChild(text);
            supperParent.appendChild(choice)

            setTimeout(function () {

                parent.remove();

                parent.classList.remove("rotate-right");
                parent.classList.remove("rotate-left");
                var status = supperParent.querySelector('.status');
                status.remove()
                mainBody.prepend(parent)
            }, 2000);

            count++;
            var total = document.querySelectorAll('#main_content>div');
            if (count == total.length) {
                count = 0;
                displayRecipes();
            }

        }

        var list_btn = document.querySelector('#list_recipes')
        list_btn.addEventListener('click', displayRecipes)
        const section = document.querySelector('#title_choices')
        let url;
        if (section != null) {

            url = section.dataset.url;
        }

        function displayRecipes() {
            const listOfing = JSON.parse(window.localStorage.getItem("ingredients"))
            parent = document.querySelector('#supper_parent')
            $.post(url, {
                "listOfingredients": listOfing
            }, (response) => {
                section.innerHTML = "Liste de Recettes"
                parent.innerHTML = response.content;
                $(".rateyo").rateYo({
                    readOnly: true,
                    starWidth: "20px"

                });
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });
                // window.location.href = './profil';
            });

        }

    }

}


