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

    function swipe(type) {
        console.log(event.currentTarget)
        var supperParent = event.currentTarget.parentNode;
        var mainBody = document.querySelector('#main_content')
        var parent = supperParent.parentNode.parentNode
        console.log('supperParent', supperParent)
        console.log('parent', parent)
        event.stopPropagation();
        if (type == 1) {


            parent.className += " rotate-left"
            // choice.className += "status dislike"
            // text = document.createTextNode("Dislike");
        } else {

            parent.className += " rotate-right"
            // choice.className += "status like"
            text = document.createTextNode("Like");
            // listKeep.push(title);
            // localStorage.setItem("ingredients", JSON.stringify(listKeep));

        }
        parent.className += " rotate-left"

        setTimeout(function() {

            parent.remove();

            parent.classList.remove("rotate-right");
            parent.classList.remove("rotate-left");
            console.log(parent)
            // var trr = supperParent.querySelector('.status');
            // trr.remove()
            mainBody.prepend(parent)
        }, 2000);
    }

});
