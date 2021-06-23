import { Controller } from 'stimulus';

import Filter from './../modules/Filter'
import Cart from './../modules/cart'
import Barfiller from './../modules/jquery.barfiller'
import Magnific from './../modules/jquery.magnific-popup.min'
import NiceSelect from './../modules/jquery.nice-select.min'
import NiceScroll from './../modules/jquery.nicescroll.min'
import Slicknav from './../modules/jquery.slicknav'
import Main from './../modules/main'
import Owl from './../modules/owl.carousel.min'


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
 
        $(function() {
            new Filter(document.querySelector('.js-filter'))
            new Cart()
        })
        new Owl()
        new Barfiller()
        new Magnific()
            // new NiceSelect()
        new NiceScroll()
        new Slicknav()
        new Main()
        $("#rateYo").rateYo({

            onSet: function(rating) {
                $("#rating").val(rating);
                alert("Rating is set to: " + rating);
            }
        });
        $("#updateRateYo").rateYo({

            onSet: function(rating) {
                $("#updateRating").val(rating);
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

    }
}