$(document).ready(function () {
    $('#updateDetails').hide();

    // Controlador de events para el botó "Registrar-me"
    $('#boto-pagament').click(function (event) {
        $('#updateDetails').show();

        $('html, body').animate({
            scrollTop: $("#updateDetails").offset().top
        }, 500);
    });
});

