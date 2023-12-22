$(document).ready(function () {
    $('#email').on('input', function () {
        var email = $(this).val();

        $.ajax({
            url: '../../controllers/UserController.php',
            type: 'POST',
            data: {
                action: 'check_email', // Nueva acción para la verificación de correo
                email: email
            },
            success: function (response) {
                try {
                    $('#correoDisponible').html(response);
                } catch (error) {
                    console.error('Error al procesar la respuesta AJAX:', error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    });
});