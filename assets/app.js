/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/swipe.css';
import Filter from './modules/Filter'
import './modules/cart.js'
import './modules/suggestion.js'
// start the Stimulus application
import './bootstrap';
const $ = require('jquery');
new Filter(document.querySelector('.js-filter'))
import './../node_modules/rateyo/src/jquery.rateyo'
import './../node_modules/rateyo/src/jquery.rateyo.css'
import './../node_modules/vicopo/api'
$(function() {

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
});

$(function() {

    // $("#rateYo").rateYo({
    //     normalFill: "#A0A0A0"
    // });
    //
    //
    // $(".rateyo").rateYo({
    //     readOnly: true,
    //     starWidth: "20px"
    //
    // });

});