<?php
session_start();
include('../models/Database.php');
require_once '../controllers/OrderController.php';
include('header.php');
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/assets/css/new_shopping_cart.css">
    <script src="../public/assets/js/new_shopping_cart.js"></script>
    <script src="../public/assets/js/updateUser.js"></script>
</head>

<body>
    <div class='container' style="justify-content: center;">
        <div class='window modal-content'>
            <div class='order-info'>
                <div class='order-info-content'>
                    <h2 style="color: white;">Carret de compres</h2>
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
                                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($order['image']) . '" class="full-width" />'; ?>
                                        <!-- <img src='https://dl.dropboxusercontent.com/s/sim84r2xfedj99n/%24_32.JPG' class='full-width'></img> -->
                                    </td>
                                    <td><?= $order['name']; ?></td>
                                    <td>
                                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($order['generatedImage']) . '" style="width: 150px; height: 150px;"/>'; ?>
                                        <!-- <img src='https://dl.dropboxusercontent.com/s/sim84r2xfedj99n/%24_32.JPG' class='full-width'></img> -->
                                    </td>
                                    <td><?= $order['quantity']; ?></td>
                                    <td><button class="btn btn-danger">Eliminar</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class='price' style="color:white"><?= $order['priceEach']; ?>€</div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <div class='line'></div>
                    <div class='total'>
                        <span style='float:left; color:white;'>
                            TOTAL <?= $order['priceEach']; ?>€
                        </span>
                        <span style='float:right; text-align:right;'>
                            <button id="boto-pagament" class="btn btn-primary">Procedir al pagament</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="updateDetails" class='container' style="justify-content: center;">
        <div class='window p-5'>
            <form class id="formulario" action="../controllers/UserController.php?action=update" method="post" style="margin-top: 20px;">
                <h2>Dades per a l'enviament</h2>
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
                <div class="row justify-content-center">
                    <button id="boto-update" type="submit" class="btn btn-primary w-50" name="boto-update" style="margin-top:20px;" onclick="formulari()">Procedeix al pagament</button>
                </div>
            </form>
        </div>
    </div>
</body>

<?php include('./footer.php');
?>