/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import Filter from './modules/Filter'
// start the Stimulus application
import './bootstrap';
const $ = require('jquery');
new Filter(document.querySelector('.js-filter'))
import './../node_modules/rateyo/src/jquery.rateyo'
import './../node_modules/rateyo/src/jquery.rateyo.css'
$(function() {

    $("#rateYo").rateYo({

        onSet: function(rating, rateYoInstance) {
            $("#rating").val(rating);
            console.log('toto', $("#rating"));
            alert("Rating is set to: " + rating);
        }
    });
});

$(function() {

    $("#rateYo").rateYo({
        normalFill: "#A0A0A0"
    });

    // alert($(".rateyo").data('value'))
    // $(".rateyo").rateYo({
    //     rating: $(this).data('value'),
    //     readOnly: true
    // });

    $(".rateyo").rateYo({
        readOnly: true,
        starWidth: "20px"

    });

});