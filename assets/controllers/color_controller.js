import {Controller} from "@hotwired/stimulus";

export default class extends Controller {

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

        this.element.style.background = this.colorsValue[this.index++].value;
    }
}