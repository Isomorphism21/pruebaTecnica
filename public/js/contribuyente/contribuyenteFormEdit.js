$(document).ready(function () {
    $('#formEditContribuyente').on('submit', function (e) {
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
                alert('Contribuyente editado exitosamente.');
                if (response.redirect) {
                    window.location.href = response.redirect;
                }       
            },
            error: function (error) {
                console.log('Error al editar el contribuyente:', error.responseJSON || error.statusText);
            }
        });
    });
});