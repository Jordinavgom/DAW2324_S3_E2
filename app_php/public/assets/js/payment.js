$(document).ready(function () {
  $('#nombre').on('input', validarCampo);
  $('#numero-tarjeta').on('input', validarCampo);
  $('#fecha-expiracion').on('input', validarCampo);
  $('#codigo-seguridad').on('input', validarCampo);

  function validarTodosLosCampos() {
      const campos = ['nombre', 'numero-tarjeta', 'fecha-expiracion', 'codigo-seguridad'];
      let todosLosCamposValidos = true;

      for (const campo of campos) {
          if (!validarCampo.call($('#' + campo))) {
              todosLosCamposValidos = false;
              break; 
          }
      }

      if (todosLosCamposValidos) {
          const valores = campos.map(campo => $('#' + campo).val());
          if (valores.every(valor => valor !== '')) {
              window.location.href = "confirmation.php";
          }
      }
  }

  function validarCampo() {
      const input = $(this);
      const valor = input.val();
      const nombre = input.attr('id');

      const errores = {
          nombre: 'nombre-error',
          'numero-tarjeta': 'numero-tarjeta-error',
          'fecha-expiracion': 'fecha-expiracion-error',
          'codigo-seguridad': 'codigo-seguridad-error',
      };

      const mensajes = {
          nombre: 'Nombre no válido. Por favor, ingrese solo letras.',
          'numero-tarjeta': 'Número de tarjeta no válido. Debe tener 16 dígitos.',
          'fecha-expiracion': 'Fecha de expiración no válida. El formato debe ser MM/AA',
          'codigo-seguridad': 'Código de seguridad no válido. Debe tener 3 dígitos.',
      };

      const campoError = $('#' + errores[nombre]);

      switch (nombre) {
          case 'nombre':
              if (!/^[A-Za-z\s]+$/.test(valor)) {
                  mostrarError(campoError, mensajes[nombre]);
              } else {
                  ocultarError(campoError);
                  return true;
              }
              break;
          case 'numero-tarjeta':
              if (!/^\d{16}$/.test(valor)) {
                  mostrarError(campoError, mensajes[nombre]);
              } else {
                  ocultarError(campoError);
                  return true
              }
              break;
          case 'fecha-expiracion':
              if (!/^(0[1-9]|1[0-2])\/(2[3-9]|[3-9]\d|\d{3,})$/.test(valor)) {
                  mostrarError(campoError, mensajes[nombre]);
              } else {
                  ocultarError(campoError);
                  return true;
              }
              break;

          case 'codigo-seguridad':
              if (!/^\d{3}$/.test(valor)) {
                  mostrarError(campoError, mensajes[nombre]);
              } else {
                  ocultarError(campoError);
                  return true
              }
              break;
      }
  }

  function mostrarError(elemento, mensaje) {
      elemento.text(mensaje);
      elemento.show();
  }

  function ocultarError(elemento) {
      elemento.text('');
      elemento.hide();
  }

  $('#pagar').click(function (event) {
      event.preventDefault();
      validarTodosLosCampos();
  });
});