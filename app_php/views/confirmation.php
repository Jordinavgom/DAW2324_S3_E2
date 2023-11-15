<? require('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    body, h1, h2, p, label {
      color: white;
    }
  </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <h1 class="display-4">Confirmació de pagament</h1>
                <br>
                <h2 class="text-white">Compra realitzada correctament! Gràcies per la seva visita!</h2>
            </div>
        </div>
    </div>
   
    <div class="text-center">
        <br>
        <img src = "../public/assets/img/GifEnvio.gif" class="img-fluid">
    </div>

    <div class="text-center mt-4">
        <br>
        <a href="historialComands.php" class="btn btn-primary">Veure historial de compres</a>
    </div>
</body>
</html>
<?php require('footer.php'); ?>  

