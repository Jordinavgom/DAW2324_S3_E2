<?php include('./header.php'); ?>

<head>
    <title>Registro</title>
    <script src="../public/assets/js/sign_up_form.js"></script>
    <!-- <script src="../public/assets/js/ajax_register.js"></script> -->
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

        input:invalid {
            border: none;
        }

        input:valid {
            border: 2px solid green;
        }
    </style>
</head>

<body>
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignup">
        <div class="modal-dialog" role="document">
            <div class="alert alert-danger" id="generalAlert" role="alert"></div>
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2 h1">Sign Up</h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form id="formulario" action="../controllers/UserController.php" method="post">
                        <input type="hidden" name="action" value="signup">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="email" placeholder="name@example.com" name="email" minlength="8" maxlength="40" required>
                            <label for="floatingInput" class="inputInside" style="color: black">Correu electrònic</label>
                            <span id="correoDisponible"></span>
                        </div>

                        <div class="alert alert-danger" id="alertmail" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="pass" placeholder="Password" name="pass" minlength="8" maxlength="20" required>
                            <label for="floatingPassword" class="inputInside" style="color: black">Contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass" role="alert"></div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="password2" placeholder="Confirm password" name="password2" minlength="8" maxlength="20" required>
                            <label for="floatingPassword" class="inputInside" style="color: black">Confirmar contrasenya</label>
                        </div>
                        <div class="alert alert-danger" id="alertPass2" role="alert"></div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="checkCondicions" required>
                            <label class="form-check-label" for="checkCondicions">He llegit i accepto els termes i condicions</label>
                            <div class="alert alert-danger" id="alertCondicions" role="alert"></div>
                        </div>
                        <button id="boto-registrar" type="submit" class="w-100 mt-1 btn-lg rounded-3 custom-btn btn-1" name="boto-registrar" onclick="formulari()">Registrar-me</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>