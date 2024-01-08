// Función para abrir el pop-up del carrito
function abrirPopup(producto) {
    var popup = document.getElementById("carritoPopup");

    precio = document.getElementById("priceDisplay").innerText;
    document.getElementById("precio").innerText = precio;

    popup.style.display = "block";
}

// Función para cerrar el pop-up del carrito
function cerrarPopup() {
    var popup = document.getElementById("carritoPopup");
    popup.style.display = "none";
}

// Ejemplo de cómo usar la función abrirPopup
// Puedes llamar a esta función cuando un producto se añada al carrito
abrirPopup("Nombre del Producto");
