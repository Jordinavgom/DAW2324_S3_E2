<?php
session_start();
include('../models/Database.php');
require_once '../controllers/OrderController.php';
require_once '../controllers/UserController.php';
include('./header.php');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/assets/css/new_shopping_cart.css">
    <script src="../public/assets/js/new_shopping_cart.js"></script>
    <script src="../public/assets/js/updateUser.js"></script>
    <link rel="stylesheet" href="../css/botoanimat.css">
    <title>Carrito</title>
</head>

<div class='container d-flex justify-content-center'>
    <div class='window'>
        <div class='order-info'>
            <div class='order-info-content'>
                <h2 class="fw-bold" style="color: #01eeac">Carret de compres</h2>
                <div class='line'></div>
                <table class='order-table'>
                    <thead class="text-center">
                        <tr>
                            <th>Producte</th>
                            <th>Descripció</th>
                            <th>Imatge generada</th>
                            <th>Quantitat</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td>
                                    <?php echo '<img src="' . $order['thumb'] . '" style="width: 150px; height: 150px;" />'; ?>
                                    <!-- <img src='https://dl.dropboxusercontent.com/s/sim84r2xfedj99n/%24_32.JPG' class='full-width'></img> -->
                                </td>
                                <td><?= $order['name']; ?></td>
                                <td>
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($order['generatedImage']) . '" style="width: 150px; height: 150px;"/>'; ?>
                                    <!-- <img src='https://dl.dropboxusercontent.com/s/sim84r2xfedj99n/%24_32.JPG' class='full-width'></img> -->
                                </td>
                                <td><?= $order['quantity']; ?></td>
                                <td><button class="mt-1 btn-lg rounded-3 custom-btn btn-1">Eliminar</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class='price'><?= $order['priceEach']; ?>€</div>
                                </td>
                            </tr>
                        <?php break;
                        endforeach; ?>
                    </tbody>

                </table>
                <div class='line'></div>
                <div class='total'>
                    <span style='float:left; color: white'>
                        TOTAL <?= $order['priceEach']; ?>€
                    </span>
                    <span style='float:right; text-align:right;'>
                        <button id="boto-pagament" class="rounded-3 custom-btn btn-1" style="font-size: 16px">Afegir direcció</button>

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class='container2 d-flex justify-content-center'>
    <div id="updateDetails" class='window px-4' style="height : 250px">
        <form class id="formulario" action="../controllers/UserController.php" method="post" style="margin-top: 20px;">
            <input type="hidden" name="action" value="update">
            <div class="row">
                <div class="col-md-4">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $userInfo[0]['name'] ?>">
                    <div class="alert alert-danger" id="alertNom" role="alert"></div>
                </div>

                <div class="col-md-4">
                    <label for="cognoms" class="form-label">Cognoms</label>
                    <input type="text" class="form-control" id="cognoms" name="cognoms" value="<?= $userInfo[0]['surnames'] ?>">
                    <div class="alert alert-danger" id="alertCognoms" role="alert"></div>
                </div>


                <div class="col-md-4">
                    <label for="adreça" class="form-label">Adreça</label>
                    <input type="text" class="form-control" id="adreça" name="adreça" value="<?= $userInfo[0]['address'] ?>">
                    <div class="alert alert-danger" id="alertAdreça" role="alert"></div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="ciutat" class="form-label">Ciutat</label>
                    <input type="text" class="form-control" id="ciutat" name="ciutat" value="<?= $userInfo[0]['city'] ?>">
                    <div class="alert alert-danger" id="alertCiutat" role="alert"></div>
                </div>
                <div class="col-md-4">
                    <label for="codipostal" class="form-label">Codi Postal</label>
                    <input type="text" class="form-control" id="codipostal" name="codipostal" value="<?= $userInfo[0]['postcode'] ?>">
                    <div class="alert alert-danger" id="alertCodiPostal" role="alert"></div>
                </div>
                <div class="col-md-4">
                    <label for="telefon" class="form-label">Número de telèfon</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" value="<?= $userInfo[0]['telephone'] ?>">
                    <div class="alert alert-danger" id="alertTelefon" role="alert"></div>
                </div>

            </div>

            <button id="boto-update" type="submit" class="mt-3 btn-lg rounded-3 custom-btn btn-1" name="boto-update" style="margin-top:20px;" onclick="formulari()">Procedeix al pagament</button>
        </form>
    </div>
</div>