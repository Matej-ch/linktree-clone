import {Controller} from "@hotwired/stimulus"
import '@easylogic/colorpicker/dist/colorpicker.css';
import ColorPickerUI from '@easylogic/colorpicker'

export default class extends Controller {
    static values = {
        color: String,
    }

    static targets = ["colorInput", "gradient", "toggleGradientOn", "toggleGradientOff"]

    connect() {
        console.log(this.colorInput);
    }

    get colorInput() {
        return this.colorInputTarget.value
    }

    hideGradient() {
        this.toggleGradientOffTarget.classList.add('hidden');
        this.toggleGradientOnTarget.classList.remove('hidden');
    }

    showGradient() {
        this.toggleGradientOnTarget.classList.add('hidden');
        this.toggleGradientOffTarget.classList.remove('hidden');

        console.log(this.colorInput);
        const colorpicker = ColorPickerUI.createGradientPicker({
            color: this.colorInput, // init color code
            position: 'inline',
            container: this.gradientTarget,
            gradient: `linear-gradient(to right, white 0%, ${this.colorInput} 100%)`,
            //type: 'sketch', // or 'sketch',  default type is 'chromedevtool'
            onHide: () => {
                console.log('hide');
            },
            onChange: gradientString => {
                console.log(gradientString);
            },
            onLastUpdate: gradientString => {
                console.log(gradientString);
            }
        })
    }
}