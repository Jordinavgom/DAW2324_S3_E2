<?php
session_start();
var_dump($_SESSION);
?>

<head>
    <title>La teva comanda</title>
    <script src="../public/assets/js/new_sign_up_form.js"></script>
</head>

<?php
// include("shopping_cart.php");
?>

<div class="container">>
    <form class id="formulario" action="../controllers/UserController.php" method="post" style="margin-top: 20px;">
        <input type="hidden" name="action" value="update">
        <div class="row">
            <div class="col-md-4">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom">
                <div class="alert alert-danger" id="alertNom" role="alert"></div>
            </div>

            <div class="col-md-4">
                <label for="cognoms" class="form-label">Cognoms</label>
                <input type="text" class="form-control" id="cognoms" name="cognoms">
                <div class="alert alert-danger" id="alertCognoms" role="alert"></div>
            </div>


            <div class="col-md-4">
                <label for="adreça" class="form-label">Adreça</label>
                <input type="text" class="form-control" id="adreça" name="adreça">
                <div class="alert alert-danger" id="alertAdreça" role="alert"></div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="ciutat" class="form-label">Ciutat</label>
                <input type="text" class="form-control" id="ciutat" name="ciutat">
                <div class="alert alert-danger" id="alertCiutat" role="alert"></div>
            </div>
            <div class="col-md-4">
                <label for="codipostal" class="form-label">Codi Postal</label>
                <input type="text" class="form-control" id="codipostal" name="codipostal">
                <div class="alert alert-danger" id="alertCodiPostal" role="alert"></div>
            </div>
            <div class="col-md-4">
                <label for="telefon" class="form-label">Número de telèfon</label>
                <input type="text" class="form-control" id="telefon" name="telefon">
                <div class="alert alert-danger" id="alertTelefon" role="alert"></div>
            </div>

        </div>

        <button id="boto-update" type="submit" class="btn btn-primary" name="boto-update" style="margin-top:20px;" onclick="formulari()">Procedeix al pagament</button>
    </form>
</div