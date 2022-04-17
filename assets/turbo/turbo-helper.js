const TurboHelper = class {
    constructor() {
        document.addEventListener('turbo:before-cache', () => {

        });

        document.addEventListener('turbo:before-render', () => {

        });

        document.addEventListener('turbo:render', () => {

        });
        document.addEventListener('turbo:load', () => {
            // for analytics
        });
    }
}

export default new TurboHelper();