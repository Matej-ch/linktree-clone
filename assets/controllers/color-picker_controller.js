import {Controller} from '@hotwired/stimulus';
import '@easylogic/colorpicker/dist/colorpicker.css';
import ColorPickerUI from '@easylogic/colorpicker'

export default class extends Controller {
    static values = {
        color: String,
    };

    colorPicker;

    static targets = ["colorInput", "picker", "toggleGradientOn", "toggleGradientOff"];

    connect() {
        if (this.colorInput.includes('gradient')) {
            this.toggleGradientOffTarget.classList.remove('hidden');
            this.toggleGradientOnTarget.classList.add('hidden');


            this.colorPicker = ColorPickerUI.createGradientPicker({
                position: 'inline',
                container: this.pickerTarget,
                gradient: this.colorInput,
                onChange: gradientString => {
                    this.colorInput = gradientString;
                },
                onLastUpdate: gradientString => {
                    this.colorInput = gradientString;
                }
            })
        } else {
            this.toggleGradientOffTarget.classList.add('hidden');
            this.toggleGradientOnTarget.classList.remove('hidden');
            this.colorPicker = ColorPickerUI.create({
                type: "sketch",
                position: "inline",
                container: this.pickerTarget,
                color: this.colorInput,
                onChange: c => {
                    this.colorInput = c;
                },
                onLastUpdate: c => {
                    this.colorInput = c;
                }
            });
        }
    }

    get colorInput() {
        return this.colorInputTarget.value
    }

    set colorInput(value) {
        this.colorInputTarget.value = value;
    }

    hideGradient() {
        this.toggleGradientOffTarget.classList.add('hidden');
        this.toggleGradientOnTarget.classList.remove('hidden');

        this.pickerTarget.innerHTML = '';
        this.colorPicker.destroy();

        let color;
        if (this.colorInput.startsWith('#')) {
            color = this.colorInput;
        } else {
            color = this.colorInput.substring(
                this.colorInput.indexOf("#"),
                this.colorInput.lastIndexOf(" ")
            );
        }

        this.colorPicker = ColorPickerUI.create({
            type: "sketch",
            position: "inline",
            container: this.pickerTarget,
            color: color,
            onChange: c => {
                this.colorInput = c;
            },
            onLastUpdate: c => {
                this.colorInput = c;
            }
        });
    }

    showGradient() {
        this.toggleGradientOnTarget.classList.add('hidden');
        this.toggleGradientOffTarget.classList.remove('hidden');

        this.pickerTarget.innerHTML = '';
        this.colorPicker.destroy();

        let gradient;
        if (this.colorInput.startsWith('#')) {
            gradient = `linear-gradient(to right, white 0%, ${this.colorInput} 100%)`;
        } else {
            gradient = this.colorInput;
        }

        this.colorPicker = ColorPickerUI.createGradientPicker({
            position: 'inline',
            container: this.pickerTarget,
            gradient: gradient,
            onChange: gradientString => {
                this.colorInput = gradientString;
            },
            onLastUpdate: gradientString => {
                this.colorInput = gradientString;
            }
        })
    }
}