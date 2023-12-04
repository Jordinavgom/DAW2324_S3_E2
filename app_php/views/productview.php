<!DOCTYPE html>
<html lang="en">
<?php include('header.php');
require_once('../controllers/ProductController.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detalles del Producto</title>
    <!-- Puedes añadir tu propio CSS aquí -->
    <script src="../public/assets/js/product.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <!-- Miniaturas a la izquierda -->
            <div class="col-lg-2">
                <?php
                $num = 0;
                // Verifica si se encontró información del producto antes de mostrar la vista
                if ($productInfo) {
                    foreach ($productImage as $image) {
                        $original = $image['original'];
                        $thumb = $image['thumb'];
                        $num++;

                ?>

                        <img src="<?= $thumb ?>" class="img-fluid img-rescale mb-3" id="thumb<?= $num ?>" alt="<?= $num ?>" onclick="handleThumbnailClick(<?= $num ?>, '<?= $original ?>')">

                <?php
                    }
                } else {
                    echo "Producto no encontrado.";
                }
                ?>
            </div>
            <!-- Imagen principal -->
            <div class="col-lg-6">
                <img src="<?= $original ?>" class="img-fluid img-rescale zoomable" alt="Producto">
            </div>
            <!-- Detalles del producto a la derecha -->
            <div class="col-lg-4">
                <h2 class="fw-bold"><?= $productInfo['name'] ?></h2>
                <select id="optionsSelect" onchange="updatePrice()">
                    <?php
                    // Verifica si se encontró información del producto antes de mostrar la vista
                    if ($productInfo) {

                        foreach ($productDetails as $details) {
                            $name = $details['name'];
                            $formattedPrice = $details['formatted_price'];

                            // Muestra los detalles del producto en la vista

                    ?>

                            <option value="<?= $formattedPrice ?>"><?= $name ?></option>


                    <?php
                        }
                    } else {
                        echo "Producto no encontrado.";
                    }
                    ?>
                </select>
                <h2 id="priceDisplay"><?= $formattedPrice ?></h2>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa Medium Zoom en la imagen principal
            const zoomableImage = document.querySelector('.col-lg-6 img.zoomable');
            mediumZoom(zoomableImage);
        });
    </script>


</body>

</html>