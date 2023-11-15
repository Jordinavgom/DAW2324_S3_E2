function realizarPago() {
  var filas = document.querySelectorAll("#tablaProductos tbody tr");
  
  if (filas.length > 0) {
      window.location.href = "../views/updateUserDetails.php";
  } else {
    console.log(filas.length)
      alert("No hi ha productes al carretó. Afegeix productes abans de realitzar el pagament.");
  }
}

function eliminarFila(button) {

  var fila = button.closest("tr");
  var productoId = fila.querySelector(".producto-id").value;
  fila.remove();
}