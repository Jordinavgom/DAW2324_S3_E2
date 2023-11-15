<?php include('header.php'); ?>

<head>
    <title>Formulari de registre</title>
    <script src="../public/assets/js/sign_up_form.js"></script>
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
    <form id="formulario" action="../controllers/Controlador.php?action=signup" method="post">
        <div class="alert alert-danger" id="generalAlert" role="alert">
        </div>
        <div class="row justify-content-center">
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
                <div class="alert alert-danger" id="alertPass" role="alert"></div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Repeteix la contrasenya</label>
                    <input type="password" class="form-control" id="password2">
                </div>
                <div class="alert alert-danger" id="alertPass2" role="alert"></div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="checkCondicions">
                    <label class="form-check-label" for="checkCondicions">He llegit i accepto els termes i
                        condicions</label>
                    <div class="alert alert-danger" id="alertCondicions" role="alert"></div>
                </div>
                <button id="boto-registrar" type="button" class="btn btn-primary" name="boto-registrar" onclick="formulari()">Registrar-me</button>
            </div>
            
        </div>
    </form>
</div>
