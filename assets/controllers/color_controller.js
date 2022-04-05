import {Controller} from "@hotwired/stimulus";

export default class extends Controller {

    static targets = ["name", "text"]

    static values = {
        colors: Array,
        refreshInterval: Number
    };

    index = 0;

    refreshTimer = null;

    connect() {

        this.change();

        if (this.hasRefreshIntervalValue) {
            this.startRefreshing()
        }
    }

    startRefreshing() {
        this.refreshTimer = setInterval(() => {
            this.change()
        }, this.refreshIntervalValue)
    }

    stopRefreshing() {
        this.index = 0;
        if (this.refreshTimer) {
            clearInterval(this.refreshTimer)
        }
    }

    disconnect() {
        this.stopRefreshing()
    }

    change() {
        if (this.index >= this.colorsValue.length) {
            this.index = 0;
        }

        const colorData = this.colorsValue[this.index++];

        this.element.style.background = colorData.value;

        const textColor = this.setTextColor(colorData.value);
        this.nameTarget.style.color = textColor;
        this.textTarget.style.color = textColor;
        this.nameTarget.innerText = colorData.name;
        this.textTarget.innerText = colorData.text;
    }

    setTextColor(hexColor) {
        let r, g, b;

        if (!hexColor) {
            r = g = b = '255';
            const brightness = (((parseInt(r, 16) * 299) +
                (parseInt(g, 16) * 587) +
                (parseInt(b, 16) * 114)) / 1000).toFixed(0);

            return (brightness > 125) ? 'black' : 'white';
        }

        if (hexColor[0] === '#') {
            hexColor = hexColor.substring(1);
        }

        if (hexColor.length === 6) {
            r = `${hexColor[0]}${hexColor[1]}`;
            g = `${hexColor[2]}${hexColor[3]}`;
            b = `${hexColor[4]}${hexColor[5]}`;
        } else if (hexColor.length === 3) {
            r = `${hexColor[0]}${hexColor[0]}`;
            g = `${hexColor[1]}${hexColor[1]}`;
            b = `${hexColor[2]}${hexColor[2]}`;
        } else {
            r = '255';
            g = '255';
            b = '255';
        }

        const brightness = (((parseInt(r, 16) * 299) +
            (parseInt(g, 16) * 587) +
            (parseInt(b, 16) * 114)) / 1000).toFixed(0);

        return (brightness > 125) ? 'black' : 'white';
    }
}