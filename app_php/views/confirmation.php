<? session_start();
include('./header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Confirmació</title>
    <link rel="stylesheet" href="../css/botoanimat.css">
    <style>
        #footer {
            margin-top: auto;
            color: white;
            text-align: center;
            padding: 10px;
            /* Puedes ajustar este valor según tu diseño */
            position: static;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="registro">Confirmació de pagament</h1>
                <h1 class="registro">Compra realitzada correctament! Gràcies per la seva visita!</h1>
            </div>
        </div>
    </div>

    <div class="text-center">
        <br>
        <img src="../public/assets/img/GifEnvio.gif" class="img-fluid">
    </div>

    <div class="text-center mt-4 mb-3">
        <a href="historialComands.php">
            <button class="w-50 mt-1 btn-lg rounded-3 custom-btn btn-1" style="color: white" type="button" id="botonCrear">Veure historial de compres</button>
        </a>
    </div>
</body>

</html>
<?php require('footer.php'); ?>