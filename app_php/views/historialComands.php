<?php
session_start();
include('../models/Database.php');
require_once '../controllers/OrderController.php';
require_once '../controllers/UserController.php';
include('./header.php');
?>

<!DOCTYPE html>
<title>Pedidos</title>
<html lang="en">
<style>
    ::marker {
        color: white
    }

    #footer {
        margin-top: auto;
        background-color: #061f41;
        color: white;
        text-align: center;
        padding: 10px;
        /* Puedes ajustar este valor según tu diseño */
        position: static;
        width: 100%;
    }

    .window {
        text-align: center;
        height: auto;
        margin: 0 auto;
        width: 50%;
        background-color: #061f41;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: list-item;
        box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
        border-radius: 30px;
        z-index: 10;
    }
</style>

<body>
    <div class="container">
        <h1 class="registro">Les meves comandes</h1>
        <?php if (!empty($orders)) : ?>
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>ID comanda</th>
                        <th>Data</th>
                        <th>Producte</th>
                        <th>Descripció</th>
                        <th>Quantitat</th>
                        <th>Imatge generada</th>
                        <th>Preu</th>
                        <th>Preu d'enviament</th>
                        <th>Preu total</th>
                        <th>Estat</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $order['idOrder'] ?> </td>
                            <td> <?= $order['datetime'] ?></td>
                            <td><?php echo '<img src="' . $order['thumb'] . '" style="width: 100px; height: 100px;"/>'; ?></td>
                            <td><?= $order['name']; ?> </td>
                            <td> <?= $order['quantity']; ?></td>
                            <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($order['generatedImage']) . '" style="width: 100px; height: 100px;"/>'; ?></td>
                            <td> <?= $order['priceEach'] . ' €'  ?></td>
                            <td> <?= $order['shippingPrice'] . ' €'  ?></td>
                            <td><?= $order['priceEach'] + $order['shippingPrice'] . ' €' ?></td>
                            <td> <?= $order['orderStatus'] ?></td>
                        </tr>
                    <?php break;
                    endforeach; ?>
                </tbody>
            </table>
            <h1 class="registro">Direcció d'entrega</h1>
            <div class="window">
                <p>Nom: <?= $userInfo[0]['name'] ?><br>
                    Cognoms: <?= $userInfo[0]['surnames'] ?><br>
                    Correu electrònic: <?= $userInfo[0]['email'] ?><br>
                    Telèfon: <?= $userInfo[0]['telephone'] ?><br>
                    Adreça: <?= $userInfo[0]['address'] ?><br>
                    Ciutat: <?= $userInfo[0]['city'] ?><br>
                    Codi postal: <?= $userInfo[0]['postcode'] ?><br></p>
            </div>
        <?php else : ?>
            <h1 class="registro">Encara no has realitzat cap comanda.</h1>
        <?php endif; ?>
    </div>
</body>
<?php include('footer.php');
?>