<?php
session_start();

require('../models/Database.php');

$database = new Database();
$conn = $database->connect('mariadb', 'root', 'rootpwd', 'app');
include('header.php');

try {
    $sql = "SELECT products.id_product, products.name, products.costPrice, products.image, orderDetails.generatedImage FROM products INNER JOIN orderDetails ON products.id_product = orderDetails.id_product";
    $result = $conn->query($sql);
    $datos = array();
    
    if ($result->num_rows > 0) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $datos[$i] = [
                "id_product" => $row["id_product"],
                "name" => $row["name"],
                "costPrice" => $row["costPrice"],
                "image" => $row["image"],
                "generatedImage" => $row["generatedImage"]
            ];
            $i++;
        }
    } else {
        echo "0 results";
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php if (empty($_SESSION['id_user'])) { ?>
    <h1 class="registro">No estàs registrat</h1>
<?php } else { ?>
    <head>
        <script src="../public/assets/js/shopping_cart.js"></script>
    </head>
    <div class="container">
        <table class="table table-striped" id="tablaProductos">
            <thead>
                <tr>
                    <th scope="col">Producte</th>
                    <th scope="col">Preu(€)</th>
                    <th scope="col">Imatge</th>
                    <th scope="col">Imatge Generada</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $dat): ?>
                    <tr>
                        <td><?= $dat['name']; ?></td>
                        <td><?= $dat['costPrice']; ?></td>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($dat['image']); ?>" class="img-thumbnail" width="100"></td>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($dat['generatedImage']); ?>" class="img-thumbnail" width="100"></td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button>
                            <input type="hidden" class="producto-id" value="<?= $dat['id_product']; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary" onclick="realizarPago()">Pagar</button>
    </div>
<?php } ?>