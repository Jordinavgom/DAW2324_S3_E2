<?php include('header.php'); ?>

<head>
    <script src="../public/assets/js/sign_in_form.js"></script>
    <style>
        body,
        h1,
        h2,
        p,
        label {
            color: white;
        }
    </style>
</head>
<div class="container">
    <h1>Inicia sessió</h1>
    <a href="sign_up_form.php">Per a registrar-te fes clic aquí</a>
    <form id="formulario" action="../controllers/UserController.php?action=signin" method="post">
        <div class="alert alert-danger" id="generalAlert" role="alert"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Correu electrònic</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="alert alert-danger" id="alertmail" role="alert"></div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contrasenya</label>
                    <input type="password" class="form-control" id="password" name="pass">
                </div>
                <!--input type="hidden" name="action" value="signin"-->
                <div class="alert alert-danger" id="alertPass" role="alert"></div>
            </div>
        </div>
        <button id="boto-login" type="button" class="btn btn-primary" name="boto-login" value="Iniciar Sesión" onclick="formulari()">Inicia sessió</button>
    </form>
</div>
<?php require('footer.php'); ?>