import { Datepicker } from '../datepicker';
import { FilePond } from '../fileuploader';

export default class Profile {
    constructor() {
        this.initDatepicker();
        this.handleUsername();
        this.handlePhotoBrowser();
    }

    initDatepicker() {
        let now = new Date();
        let field = document.getElementById('date_of_birth');
        let options = {
            yearRange: [now.getFullYear() - 80, now.getFullYear() - 11],
            minDate: new Date(now.getFullYear() - 85, 0, 1),
            maxDate: new Date(now.getFullYear() - 10, 11, 31),
            defaultDate: new Date(now.getFullYear() - 11, 11, 31),
        };

        let datepicker = new Datepicker(field, options);
        datepicker.init();
    }

    handlePhotoBrowser() {
        const fileBrowser = document.querySelector('input#photo');
        let filepond = new FilePond(fileBrowser);
    }

    handleUsername() {
        // The username input element
        let username = document.getElementsByName("username")[0];
        let timeout = null;

        username.addEventListener("keyup", (event) => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                let route = document.getElementsByName('username-validation-route')[0].value;
                fetch(route, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        'username': username.value
                    })
                })
                .then(response => response.json())
                .then(response => {
                    if (response.hasOwnProperty('error') && response.error.length > 0) {
                        username.classList.remove('is-valid');
                        username.classList.add('is-invalid');
                        document.getElementById('username-error').innerHTML = response.error;
                        return;
                    }

                    username.classList.remove('is-invalid');
                    username.classList.add('is-valid');
                    document.getElementById('username-success').innerHTML = response.message;
                })
                .catch((error) => console.log('Error: ', error))
            }, 500);
        })
    }
}
