import swal from 'bootstrap-sweetalert';

export default class Users {
    constructor() {
        this.initSweetAlerts();
    }

    initSweetAlerts()
    {
        const deleteUserForm = document.getElementsByClassName('delete-user');

        Array.from(deleteUserForm).forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                let route = form.action;

                swal({
                    title: "Are you sure you want to delete this user?",
                    text: "You can restore this user at any time.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete it!",
                    cancelButtonText: "Cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, (isConfirm) => {
                    if (!isConfirm) { return; }
                    form.submit();
                });
            })
        })

    }
}
