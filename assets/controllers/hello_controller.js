import { Controller } from 'stimulus';

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

            onSet: function(rating) {
                $("#rating").val(rating);
                console.log('toto', $("#rating"));
                alert("Rating is set to: " + rating);
            }
        });
        $("#updateRateYo").rateYo({

            onSet: function(rating) {
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

    
        console.log('afleter rateyo')
    }
}
