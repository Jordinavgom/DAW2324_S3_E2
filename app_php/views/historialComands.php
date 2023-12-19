<?php
session_start();
include('../models/Database.php');
require_once '../controllers/OrderController.php';

include('./header.php'); ?>

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
                        <th>Transportista</th>
                        <th>Preu</th>
                        <th>Preu d'enviament</th>
                        <th>Preu total</th>
                        <th>Estat</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $order['id_order'] ?> </td>
                            <td> <?= $order['date'] ?></td>
                            <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($order['image']) . '" style="width: 100px; height: 100px;"/>'; ?></td>
                            <td><?= $order['name']; ?> </td>
                            <td> <?= $order['quantity']; ?></td>
                            <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($order['generatedImage']) . '" style="width: 100px; height: 100px;"/>'; ?></td>
                            <td> <?= $order['carrier']; ?></td>
                            <td> <?= $order['priceEach']; ?></td>
                            <td> <?= $order['shipping_price']; ?></td>
                            <td><?= $order['priceEach'] + $order['shipping_price'] ?></td>
                            <td> <?= $order['status'] ?></td>
                        </tr>
                    <?php break;
                    endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <h1 class="registro">Encara no has realitzat cap comanda.</h1>
        <?php endif; ?>
    </div>
</body>
<?php //include('footer.php'); 
?>