<?php
session_start();
include('../models/Database.php');
$database = new Database();
$conn = $database->connect('mariadb', "root", "rootpwd", "app");

if (empty($_SESSION['id_user'])) { ?>
    <script>window.location.replace("loginStandAlone.php");</script>
<?php } else {
    include('header.php');
    try {

        $sql = "SELECT o.id_order,p.name,o.date, o.status, p.image,od.generatedImage,od.quantity,od.priceEach,od.carrier,od.shipping_price, od.priceEach + od.shipping_price as total FROM orders as o, orderDetails as od, products as p where p.id_product = od.id_product and o.id_order = od.id_order;";
        $result = $conn->query($sql);
        $datos = array();
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $datos[$i] = [
                    "id_order" => $row["id_order"],
                    "name" => $row["name"],
                    "date" => $row["date"],
                    "image" => $row["image"],
                    "generatedImage" => $row["generatedImage"],
                    "quantity" => $row["quantity"],
                    "priceEach" => $row["priceEach"],
                    "carrier" => $row["carrier"],
                    "shipping_price" => $row["shipping_price"],
                    "status" => $row["status"],
                    "total" => $row["total"]
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
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID comanda</th>
                        <th scope="col">Producte</th>
                        <th scope="col">Data</th>
                        <th scope="col">Imatge</th>
                        <th scope="col">Imatge generada</th>
                        <th scope="col">Quantitat</th>
                        <th scope="col">Transportista</th>
                        <th scope="col">Preu</th>
                        <th scope="col">Preu d'enviament</th>
                        <th scope="col">Preu total</th>
                        <th scope="col">Estat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($datos as $dat) : ?>
                        <tr>
                            <td><?= $datos[$i]['id_order']; ?> </td>
                            <td><?= $datos[$i]['name']; ?> </td>
                            <td> <?= $datos[$i]['date']; ?></td>
                            <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($datos[$i]['image']).'" style="width: 100px; height: 100px;"/>';?></td>
                            <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($datos[$i]['generatedImage']).'" style="width: 100px; height: 100px;"/>';?></td>
                            <td> <?= $datos[$i]['quantity']; ?></td>
                            <td> <?= $datos[$i]['carrier']; ?></td>
                            
                            <td> <?= $datos[$i]['priceEach']; ?></td>
                            <td> <?= $datos[$i]['shipping_price']; ?></td>
                            <td> <?= $datos[$i]['total']; ?></td>
                            <td> <?= $datos[$i]['status']; ?></td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>

            </table>
        </div>
    </main>
<?php } ?>