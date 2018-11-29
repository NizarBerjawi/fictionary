import Pikaday from 'pikaday';

export default class Datepicker {
    constructor(element, options = {}) {
        this.element = {field: element};
        this.options = options;
    }

    init() {
        let parameters = {...this.element, ...this.options};
        return new Pikaday(parameters);
    }
}
