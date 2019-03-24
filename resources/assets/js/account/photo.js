export default class PhotoUpload {
    constructor(selector) {
        this.upload = $(selector);
        this.bindEvents();
    }

    bindEvents() {
        this.upload.on('click', this.handleClick);
    }

    handleClick(event) {
        $(event.currentTarget).next('input[type=file]').click();
    }
}
