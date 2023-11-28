<?php include('header.php'); ?>

<head>
    <title>Formulari de registre</title>
    <script src="../public/assets/js/sign.js"></script>
    <link rel="stylesheet" href="../css/botoanimat.css">
    <link rel="stylesheet" href="../css/style.css">
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
<div id="sign-up" style="display: none">
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignup">
        <div class="modal-dialog" role="document">
            <div class="alert alert-danger" id="generalAlert1" role="alert"></div>
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                <a href="#" onclick="mostrarLogin()" style="text-decoration: none; color: inherit;">
                        <h1 class="fw-bold mb-0 fs-2 h1">Sign In</h1>
                    </a>
                    <h1 class="fw-bold mb-0 fs-2 h1">Sign Up</h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form id="signupForm" action="../controllers/UserController.php?action=signup" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="emaillogin" placeholder="name@example.com" name="emaillogin">
                            <label for="floatingInput" class="inputInside" style="color: black">Correu electrònic</label>
                        </div>

                        <div class="alert alert-danger" id="alertmail1" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="password1" placeholder="Password" name="password1">
                            <label for="floatingPassword" class="inputInside" style="color: black">Contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass1" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="password2" placeholder="Confirm password" name="password2">
                            <label for="floatingPassword" class="inputInside" style="color: black">Confirmar contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass2" role="alert"></div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="checkCondicions">
                            <label class="form-check-label" for="checkCondicions">He llegit i accepto els termes i condicions</label>
                            <div class="alert alert-danger" id="alertCondicions" role="alert"></div>
                        </div>
                        <button id="boto-registrar" type="button" class="w-100 mt-1 btn-lg rounded-3 custom-btn btn-1" name="boto-registrar" onclick="formulariregistre()">Registrar-me</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registre  -->

<div id="sign-in">
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="alert alert-danger" id="generalAlert" role="alert"></div>
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2 h1">Sign In</h1>
                    <a href="#" onclick="mostrarRegistre()" style="text-decoration: none; color: inherit;">
                        <h1 class="fw-bold mb-0 fs-2 h1">Sign Up</h1>
                    </a>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form id="formulario" action="../controllers/UserController.php?action=login" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="email" placeholder="name@example.com" name="email">
                            <label for="floatingInput" class="inputInside" style="color: black">Correu electrònic</label>
                        </div>
                        <div class="alert alert-danger" id="alertmail" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="password" placeholder="Password" name="password">
                            <label for="floatingPassword" class="inputInside" style="color: black">Contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass" role="alert"></div>
                        <button id="boto-login" type="button" class="w-100 mt-1 btn-lg rounded-3 custom-btn btn-1" value="Iniciar Sesión" name="boto-login" onclick="formulari()">Inicia sessió</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>