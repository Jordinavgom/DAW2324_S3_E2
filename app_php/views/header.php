<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src='../public/assets/js/shopping_cart.js'></script>
    <script src="../public/assets/js/updateUser.js"></script>
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-md-right" id="navbarsExample08">
                    <div class="container borderYtoX">
                        <ul class="navbar-nav">
                            <?php if (empty($_SESSION['id_user'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" aria-current="page" href="../index.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" href="#">Tendencias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" href="">Servicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" href="">Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" href="../views/historialComands.php">Pedidos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link fw-bold" href="../views/loginStandAlone.php">Login</a>
                                </li>

                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="../index.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Tendencias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">Servicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../views/historialComands.php">Pedidos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../views/shopping_cart.php">Carrito</a>
                                </li>
                                <li class="nav-item">
                                    <form method="POST" action="../logout.php">
                                        <input type="submit" class="nav-link" name="logOut" value="LogOut" />
                                    </form>
                                </li>
                            <?php } ?>


                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>