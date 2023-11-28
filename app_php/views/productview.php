<!DOCTYPE html>
<html lang="en">
<?php include('header.php');
require_once('../controllers/ProductController.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detalles del Producto</title>
    <!-- Puedes añadir tu propio CSS aquí -->
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <!-- Miniaturas a la izquierda -->
            <div class="col-lg-2">
                <img src="./imatges/thumb.jpeg" class="img-fluid mb-3" alt="Thumb 1">
                <img src="./imatges/thumb.jpeg" class="img-fluid mb-3" alt="Thumb 2">
                <img src="./imatges/thumb.jpeg" class="img-fluid" alt="Thumb 3">
            </div>

            <!-- Imagen principal -->
            <div class="col-lg-6">
                <img src="./imatges/original.jpg" class="img-fluid" alt="Producto">
            </div>

            <!-- Detalles del producto a la derecha -->
            <div class="col-lg-4">
                <h2 class="fw-bold"><?= $productInfo['name'] ?></h2>
                <h2 class="fw-bold"> mida = <?= $product_Details['name'] ?></h2>


                <div class="mb-3">
                    <h4>Precio: <?= $product_Details['formatted_price'] ?></h4>
                </div>

                <!-- Formulario para añadir al carrito -->
                <form>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label nav-link">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" value="1" min="1">
                    </div>

                    <button type="submit" class="btn btn-primary">Añadir al Carrito</button>
                </form>

                <!-- Otras informaciones relevantes -->
                <div class="mt-3">
                    <!-- Puedes añadir más detalles aquí -->
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>