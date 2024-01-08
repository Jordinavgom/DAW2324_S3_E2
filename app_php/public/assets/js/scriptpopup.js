// Función para abrir el pop-up del carrito
popup.style.display = "none";

function abrirPopup(producto) {
    var popup = document.getElementById("carritoPopup");

    var precio = document.getElementById("priceDisplay").innerText;
    document.getElementById("precio").innerText = ("Precio unitario - " + precio);

    var selectElement = document.getElementById("optionsSelect");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    document.getElementById("variant").innerText = selectedOption.text;

    var cantidadInput = document.getElementById("cantidad");
    var valorCantidad = cantidadInput.value;
    document.getElementById("quantidad").innerText = ("Cantidad - " + valorCantidad);

    precio = parseFloat(precio.replace("€", ""));
    var precioTotal = (precio * valorCantidad);
    document.getElementById("total").innerText = ("Total - " + precioTotal + " €");

    popup.style.display = "block";
}

function carrito() {
    // Redirigir a la otra página
    window.location.href = 'shopping_cart.php';
}
// Función para cerrar el pop-up del carrito
function cerrarPopup() {
    var popup = document.getElementById("carritoPopup");
    popup.style.display = "none";
}

// Ejemplo de cómo usar la función abrirPopup
// Puedes llamar a esta función cuando un producto se añada al carrito
abrirPopup("Nombre del Producto");
