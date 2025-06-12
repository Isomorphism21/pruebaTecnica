$(document).ready(function () {
    $('#formCrearContribuyente').on('submit', function (e) {
        e.preventDefault();
        const email = $('#email').val();
        if (!window.Helpers.validarEmail(email)) {
            e.preventDefault();
            alert('Correo electrónico inválido.');
            return;
        }

        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function (response) {
                alert('Contribuyente creado exitosamente.');
                form.trigger('reset');
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            },
            error: function (error) {
                console.log('Ocurrió un error al crear el contribuyente.', error.responseJSON || error.statusText);
            }
        });
    });
});