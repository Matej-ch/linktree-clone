import {Controller} from "@hotwired/stimulus"
import '@easylogic/colorpicker/dist/colorpicker.css';
import ColorPickerUI from '@easylogic/colorpicker'

export default class extends Controller {
    static values = {
        color: String,
    };

    colorPicker;

    static targets = ["colorInput", "picker", "toggleGradientOn", "toggleGradientOff"];

    connect() {
        this.colorPicker = ColorPickerUI.create({
            type: "sketch",
            position: "inline",
            container: this.pickerTarget,
            color: this.colorInput,
            onChange: c => {
                console.log(c);
            },
            onLastUpdate: c => {
                console.log(c);
            }
        });
    }

    get colorInput() {
        return this.colorInputTarget.value
    }

    hideGradient() {
        this.toggleGradientOffTarget.classList.add('hidden');
        this.toggleGradientOnTarget.classList.remove('hidden');

        this.pickerTarget.innerHTML = '';
        this.colorPicker.destroy();

        this.colorPicker = ColorPickerUI.create({
            type: "sketch",
            position: "inline",
            container: this.pickerTarget,
            color: this.colorInput,
            onChange: c => {
                console.log(c);
            },
            onLastUpdate: c => {
                console.log(c);
            }
        });
    }

    showGradient() {
        this.toggleGradientOnTarget.classList.add('hidden');
        this.toggleGradientOffTarget.classList.remove('hidden');

        this.pickerTarget.innerHTML = '';
        this.colorPicker.destroy();

        this.colorPicker = ColorPickerUI.createGradientPicker({
            color: this.colorInput,
            position: 'inline',
            container: this.pickerTarget,
            gradient: `linear-gradient(to right, white 0%, ${this.colorInput} 100%)`,
            onChange: gradientString => {
                console.log(gradientString);
            },
            onLastUpdate: gradientString => {
                console.log(gradientString);
            }
        })
    }
}