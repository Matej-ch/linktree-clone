import {Controller} from "@hotwired/stimulus"
import '@easylogic/colorpicker/dist/colorpicker.css';
import ColorPickerUI from '@easylogic/colorpicker'

export default class extends Controller {
    static values = {
        color: String,
    };

    colorPicker;

    static targets = ["colorInput", "gradient", "toggleGradientOn", "toggleGradientOff"];

    connect() {

    }

    get colorInput() {
        return this.colorInputTarget.value
    }

    hideGradient() {
        this.toggleGradientOffTarget.classList.add('hidden');
        this.toggleGradientOnTarget.classList.remove('hidden');

        this.gradientTarget.innerHTML = '';
        this.colorPicker.destroy();
    }

    showGradient() {
        this.toggleGradientOnTarget.classList.add('hidden');
        this.toggleGradientOffTarget.classList.remove('hidden');

        console.log(this.colorInput);
        this.colorPicker = ColorPickerUI.createGradientPicker({
            color: this.colorInput,
            position: 'inline',
            container: this.gradientTarget,
            gradient: `linear-gradient(to right, white 0%, ${this.colorInput} 100%)`,
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