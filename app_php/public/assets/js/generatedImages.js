$(document).ready(function () {
    $("#contentAfterLoading").hide();
    $("#spinner").hide();
    $("#img1").hide();
    $("#img2").hide();
    $("#img3").hide();
    $("#img4").hide();
    $("#continueButton").hide();
    $("#keepTrying").hide();
    $("#contentContainer").hide();

    $("#promptButton").click(function () {
        $("#textPrompt").hide();
        $("#promptButton").hide();
        $("#spinner").show();
        $("#contentAfterLoading").show();
        $("#continueButton").addClass('disabled');
        setTimeout(function () {
            $("#spinner").fadeOut(3000, function () {


                $("#img1").fadeIn(1000, function () {
                    $("#img2").fadeIn(1000, function () {
                        $("#img3").fadeIn(1000, function () {
                            $("#img4").fadeIn(1000, function () {
                                $("#continueButton").fadeIn(1000, function () {
                                    $("#keepTrying").fadeIn(3000);
                                });
                            });
                        });
                    });
                });
            });
        }, 1000);
    });

    $("#keepTrying").click(function () {
        $("#textPrompt").fadeIn(1000, function () {
            $("#promptButton").fadeIn(3000);
        });
    });

    $("#continueButton").click(function () {
        // Cargar y mostrar contenido de otra página en el contenedor
        $("#contentContainer").show();

        $('html, body').animate({
            scrollTop: $("#contentContainer").offset().top
        }, 500);
    });
});

function buttonClick(clickedImage) {
    // Elimina la clase 'selected' de todas las imágenes
    $('.img-fade').removeClass('border border-5 border-warning');

    // Agrega la clase 'selected' a la imagen clicada
    $('#' + clickedImage).addClass('border border-5 border-warning');
    $("#continueButton").removeClass('disabled');
    $("#continueButton").text('Selecciona un suport');
}