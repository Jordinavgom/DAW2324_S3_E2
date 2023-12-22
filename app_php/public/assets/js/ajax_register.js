$(document).ready(function () {
    $('#email').blur(function () {
        var email = $(this).val();

        $.ajax({
            url: 'User.php',
            type: 'POST',
            data: { email: email },
            success: function (response) {
                $('#correoDisponible').html(response);
            }
        });
    });
});

// Evitar que el formulario se envíe si el correo no está disponible
$('#formulario').submit(function (e) {
    if ($('#correoDisponible').text() !== 'El correo electrónico está disponible.') {
        e.preventDefault();
        alert('Por favor, elija un correo electrónico disponible.');
    }
});