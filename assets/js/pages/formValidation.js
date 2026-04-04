(function () {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to

    const configurationForm = document.getElementById('configuration-form');

    if (configurationForm) {
        configurationForm.addEventListener('submit', function (event) {
            if (!configurationForm.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            //Validacion
            if (configurationForm["description"].value === '') {
                document.getElementById('descriptionMessage').innerHTML = 'Este valor es requerido';
                event.preventDefault()
                event.stopPropagation()
            }
            if (configurationForm["value"].value === '') {
                document.getElementById('valueMessage').innerHTML = 'Este valor es requerido';
                event.preventDefault()
                event.stopPropagation()
            }
            configurationForm.classList.add('was-validated')
        }, false);
    }


    const loginForm = document.getElementById('login-form');

    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            if (!loginForm.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            //Validacion
            if (loginForm["email"].value === '') {
                event.preventDefault()
                event.stopPropagation()
            }
            if (loginForm["password"].value === '') {
                event.preventDefault()
                event.stopPropagation()
            }
            loginForm.classList.add('was-validated')
        }, false);
    }


})()