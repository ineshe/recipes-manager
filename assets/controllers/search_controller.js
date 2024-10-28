import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [ 'searchbar' ]

    toggle() {
        if(this.searchbarTarget.offsetHeight === 0) {
            this.searchbarTarget.style.height = `${this.searchbarTarget.scrollHeight}px`;
        } else {
            this.searchbarTarget.style.height = '0px';
        }
    }
}