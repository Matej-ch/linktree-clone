import {Controller} from "@hotwired/stimulus"

export default class extends Controller {
    static values = {
        color: String,
    }

    static targets = ["colorInput"]

    connect() {
        console.log(this.colorInput);
    }

    get colorInput() {
        return this.colorInputTarget.value
    }
}