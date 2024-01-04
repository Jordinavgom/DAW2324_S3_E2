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
        $("#promptIdea1").hide();
        $("#promptIdea2").hide();
        $("#promptIdea3").hide();
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
        $('#contentAfterLoading, #keepTrying, #continueButton').hide();
        $("#textPrompt").fadeIn(1000, function () {
            $("#promptButton, #promptIdea1, #promptIdea2, #promptIdea3").fadeIn(3000, function () {

            });
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

function promptIdea1() {
    $("#textPrompt").val("Imagina un paisatge hivernal màgic on l'aurora boreal il·lumina el cel estavellat");
}

function promptIdea2() {
    $("#textPrompt").val("Visualitza un moment romàntic a la tarda de Sant Valentí. Una parella està asseguda en un acollidor cafè, il·luminat per llums tènues");
}

function promptIdea3() {
    $("#textPrompt").val("Imagina una escena d'amor en una assolellada tarda de primavera. Al cor de l'escena, una parella comparteix rialles i converses en un jardí encantador");
}

function buttonClick(clickedImage) {
    // Elimina la clase 'selected' de todas las imágenes
    $('.img-fade').removeClass('border border-5 border-warning');

    // Agrega la clase 'selected' a la imagen clicada
    $('#' + clickedImage).addClass('border border-5 border-warning');
    $("#continueButton").removeClass('disabled');
    $("#continueButton").text('Selecciona un suport');
}