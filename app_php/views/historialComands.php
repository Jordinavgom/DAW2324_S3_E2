<?php
session_start();
include('../models/Database.php');
require_once '../controllers/OrderController.php';
require_once '../controllers/UserController.php';
include('./header.php');
?>

<!DOCTYPE html>
<html lang="en">

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
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>Nom</th>
                        <th>Cognoms</th>
                        <th>Correu electrònic</th>
                        <th>Número de telèfon</th>
                        <th>Adreça</th>
                        <th>Ciutat</th>
                        <th>Codi Postal</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td><?= $userInfo[0]['name'] ?> </td>
                        <td><?= $userInfo[0]['surnames'] ?> </td>
                        <td><?= $userInfo[0]['email'] ?> </td>
                        <td><?= $userInfo[0]['telephone'] ?> </td>
                        <td><?= $userInfo[0]['address'] ?> </td>
                        <td><?= $userInfo[0]['city'] ?> </td>
                        <td><?= $userInfo[0]['postcode'] ?> </td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <h1 class="registro">Encara no has realitzat cap comanda.</h1>
        <?php endif; ?>
    </div>
</body>
<?php include('footer.php'); ?>