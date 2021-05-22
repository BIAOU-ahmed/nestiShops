import {Controller} from 'stimulus';
import Suggestion from './../modules/suggestion'
export default class extends Controller {
    connect() {

        console.log('toootototocontrolle stimulus')
        new Suggestion();


    }
}