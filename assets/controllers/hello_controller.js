import {Controller} from 'stimulus';

import Filter from './../modules/Filter'
import Cart from './../modules/cart'

import './../../node_modules/rateyo/src/jquery.rateyo'
import './../../node_modules/rateyo/src/jquery.rateyo.css'
import './../app'

const $ = require('jquery');

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        // this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
        console.log('controller hello stimulus ')
        new Filter(document.querySelector('.js-filter'))
        new Cart()
        $("#rateYo").rateYo({

            onSet: function (rating) {
                $("#rating").val(rating);
                console.log('toto', $("#rating"));
                alert("Rating is set to: " + rating);
            }
        });
        $("#updateRateYo").rateYo({

            onSet: function (rating) {
                $("#updateRating").val(rating);
                console.log('toto', $("#updateRating"));
                alert("Rating is set : " + rating);
            }
        });

        $("#rateYo").rateYo({
            normalFill: "#A0A0A0"
        });


        $(".rateyo").rateYo({
            readOnly: true,
            starWidth: "20px"

        });


        // $("#user_zipCode").removeAttr("value");

        // $('#user_zipCode').keyup(function (e) {
        //     console.log('toto')
        //     if (e.keyCode == 13) {
        //         var $ville = $(this);
        //         $.vicopo($ville.val(), function (input, cities) {
        //             if (input == $ville.val() && cities[0]) {
        //                 console.log('city', cities[0].city)
        //                 console.log('code', cities[0].code)
        //
        //                 $('#user_idCity').val(cities[0].city);
        //                 // $('#code').val(cities[0].code);
        //                 // $ville.val(cities[0].city).vicopoTargets().vicopoClean();
        //             }
        //         });
        //         e.preventDefault();
        //         e.stopPropagation();
        //     }
        //     setTimeout(function () {
        //         $('.code_element').click(function (e) {
        //             let t = $(this).text();
        //             console.log('moi', $(this).childNodes)
        //             console.log('first ', $(this).firstElementChild)
        //             // console.log('last', $(this).last())
        //             console.log('index', t.indexOf())
        //             var $ville = $('#user_zipCode');
        //             $.vicopo($ville.val(), function (input, cities) {
        //                 if (input == $ville.val() && cities[0]) {
        //                     console.log('city', cities[0].city)
        //                     console.log('code', cities[0].code)
        //
        //                     $('#user_idCity').val(cities[0].city).vicopoTargets().vicopoClean();
        //                     $('#user_zipCode').val(cities[0].code).vicopoTargets().vicopoClean();
        //                     // $ville.val(cities[0].city).vicopoTargets().vicopoClean();
        //                 }
        //             });
        //             e.preventDefault();
        //             e.stopPropagation();
        //             console.log('click on one code')
        //         })
        //         // click = document.querySelectorAll('.code_element')
        //         // console.log(click)
        //         // click.forEach(elem => {
        //         //     console.log('my elemen', elem)
        //         //     elem.addEventListener('click', add)
        //         // })
        //     }, 2000);
        //
        // });

        $(function () {
        //     let s = $('#output>li')
        //     // console.log(s)
        //     $('#output').html("");
        //     setTimeout(function () {
        //         $('#output').append(s)
        //         console.log('it done')
        //     }, 4000);
        //     // console.log('in set out ', $('#output>li'))
        //     $('#output').html(" <li data-vicopo=\" #user_zipCode\" type=\"button\" data-vicopo-click='{\"#user_zipCode\": \"code\", \"#user_idCity\": \"ville\"}' >\n" +
        //         "            <strong data-vicopo-code-postal></strong>\n" +
        //         "            <span data-vicopo-ville></span>\n" +
        //         "        </li>")
        })



        // $('#city_output').html("   <li data-vicopo=\"#user_idCity\" type=\"button\" data-vicopo-click='{\"#user_zipCode\": \"code\", \"#user_idCity\": \"ville\"}' >\n" +
        //     "            <strong data-vicopo-code-postal></strong>\n" +
        //     "            <span data-vicopo-ville></span>\n" +
        //     "        </li>")
        console.log('afleter rateyo')
    }
}
