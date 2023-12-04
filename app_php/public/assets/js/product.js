function handleThumbnailClick(thumbNumber, imageUrl) {
    // Cambia la imagen principal al hacer clic en una miniatura
    var mainImage = $(".col-lg-6 img");
    mainImage.attr("src", imageUrl);

    // Puedes realizar otras acciones específicas cuando se hace clic en una miniatura
    console.log('Clic en la miniatura ' + thumbNumber);
}

$("#optionsSelect").change(updatePrice);

function updatePrice() {
    // Obtén el elemento select y el elemento de visualización del precio
    var select = $("#optionsSelect");
    var priceDisplay = $("#priceDisplay");

    // Obtén el precio seleccionado de la opción actual
    var selectedPrice = select.val();

    // Actualiza el elemento de visualización del precio con el precio seleccionado
    priceDisplay.text(selectedPrice);
}


$(document).ready(function () {
    updatePrice();

});

