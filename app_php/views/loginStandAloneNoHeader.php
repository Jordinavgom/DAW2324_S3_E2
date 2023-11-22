<?php

if (empty($_SESSION['id_user'])) { ?>
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="alert alert-danger" id="generalAlert" role="alert"></div>
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2 h1">Sign in</h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form id="formulario" action="../controllers/UserController.php?action=login" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="floatingInput" class="input" placeholder="name@example.com" name="email">
                            <label for="floatingInput" class="inputInside">Correu electrònic</label>
                        </div>
                        <div class="alert alert-danger" id="alertmail" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="floatingPassword" class="input" placeholder="Password" name="pass">
                            <label for="floatingPassword" class="inputInside">Contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass" role="alert"></div>
                        <input type="submit" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" value="Entrar" />
                    </form>
                    <p><a class="link" href="sign_up_form.php">No tens compte? Registra't aquí</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/assets/js/sign_in_form.js"></script>
<?php



} else { ?>
    <?= include('header.php'); ?>
    <p style="color:white">Ya estas conectado</p>
<?php } ?>