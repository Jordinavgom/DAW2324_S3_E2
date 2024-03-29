<?php

if (empty($_SESSION['idClient'])) { ?>
    <?php include('./header.php'); ?>

    <head>
        <script src="../public/assets/js/sign_in_form.js"></script>
        <link rel="stylesheet" href="../css/botoanimat.css">
        <title>Inicio de sesión</title>
        <style>
            input:invalid {
                border: none;
            }

            input:valid {
                border: 2px solid green;
            }
        </style>
    </head>
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="alert alert-danger" id="generalAlert" role="alert"></div>
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2 h1">Sign in</h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form id="formulario" action="../controllers/UserController.php" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="email" placeholder="name@example.com" name="email" minlength="8" maxlength="40" required>
                            <label for="floatingInput" class="inputInside">Correu electrònic</label>
                        </div>
                        <div class="alert alert-danger" id="alertmail" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="pass" placeholder="Password" name="pass" minlength="8" maxlength="20" required>
                            <label for="floatingPassword" class="inputInside">Contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass" role="alert"></div>
                        <button id="boto-login" type="submit" class="w-100 mt-1 btn-lg rounded-3 custom-btn btn-1" value="Iniciar Sesión" name="boto-login" onclick="formulari()">Inicia sessió</button>
                    </form>
                    <p><a class="link" href="sign_up_form.php">No tens compte? Registra't aquí</a></p>
                </div>
            </div>
        </div>
    </div>

<?php
} else { ?>
    <?php include('header.php'); ?>
    <p style="color:white">Ya estas conectado</p>
<?php } ?>