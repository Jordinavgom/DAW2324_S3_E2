<?php require('header.php'); ?>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src='../public/assets/js/payment.js'></script>
  <title>Pàgina de Pagament</title>
  <style>
    body,
    h1,
    h2,
    p,
    label {
      color: white;
    }
  </style>
</head>

<div class="container" style="margin-top:50px;">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2>Informació del Pagament</h2>
      <form id="formulario-pago">
        <div class="form-group">
          <label for="nombre">Nom a la Targeta</label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Titular de la Targeta" required>
          <div id="nombre-error" class="alert alert-danger" style="display: none;"></div>
        </div>
        <br>
        <div class="form-group">
          <label for="numero-tarjeta">Número de Targeta</label>
          <input type="text" class="form-control" name="numero-tarjeta" id="numero-tarjeta" placeholder="Número de Targeta" required>
          <div id="numero-tarjeta-error" class="alert alert-danger" style="display: none;"></div>
        </div>
        <br>
        <div class="form-group">
          <label for="fecha-expiracion">Data d'Expiració</label>
          <input type="text" class="form-control" name="fecha-expiracion" id="fecha-expiracion" placeholder="MM/AA" required>
          <div id="fecha-expiracion-error" class="alert alert-danger" style="display: none;"></div>
        </div>
        <br>
        <div class="form-group">
          <label for="codigo-seguridad">Códi de Seguretat</label>
          <input type="text" class="form-control" name="codigo-seguridad" id="codigo-seguridad" placeholder="Codi de Seguretat" required>
          <div id="codigo-seguridad-error" class="alert alert-danger" style="display: none;"></div>
        </div>
        <br>
        <div class="form-group">
          <button id="pagar" type="button" class="btn btn-primary">Pagar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>