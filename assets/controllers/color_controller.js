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

        if (!colorData.textColor.length) {
            this.textTarget.style.color = this.setTextColor(colorData.value);
        } else {
            if (colorData.textColor.includes('gradient')) {
                this.nameTarget.cssText = `background:${colorData.textColor};-webkit-background-clip: text;-webkit-text-fill-color: transparent;`;
            } else {
                this.textTarget.style.color = colorData.textColor;
            }
        }

        if (!colorData.nameColor.length) {
            this.nameTarget.style.color = this.setTextColor(colorData.value);
        } else {
            if (colorData.nameColor.includes('gradient')) {
                this.nameTarget.cssText = `background:${colorData.nameColor};-webkit-background-clip: text;-webkit-text-fill-color: transparent;`;
            } else {
                this.nameTarget.style.color = colorData.nameColor;
            }
        }

        this.nameTarget.innerText = colorData.name;
        this.textTarget.innerText = colorData.text;

        this.visit(colorData);
    }

    async visit(color) {
        const formData = new FormData();
        formData.append('color', color);

        fetch('/visit-color/' + color.id, {
            method: 'POST',
            body: formData,
        }).then(res => res.json()).then(data => {
        }).catch(err => console.error(err));
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