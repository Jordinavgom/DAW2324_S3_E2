<?php
// xdebug_info();
session_start();
include('views/header.php'); ?>

<body>
    <style> 
        #footer {
        margin-top: auto;
        background-color: #4e45a3;
        color: white;
        text-align: center;
        padding: 10px; /* Puedes ajustar este valor según tu diseño */
        position: static;
        width: 100%;
        }
    </style>

    <div class="container">
        <div class="p-5 bg-body-tertiary rounded-3" id="jumbotron">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <div class="h-50">
                        <img src="../public/assets/img/logo.png" class="img-fluid d-block mx-auto" alt="Logo">
                    </div>
                </div>

                <div class="col-md-6 order-md-1">
                    <h1 class="display-5 fw-bold">Da vida a tus pensamientos</h1>
                    <p class="fs-4">Imagina. <br> Crea. <br> Personaliza. <br> Diseños únicos, tú eliges dónde brillar.</p>

                    <a href="./views/generateImages.php">
                        <button class="btn btn-primary btn-lg" type="button" id="botonCrear">Empieza a crear</button>
                    </a>
                </div>
            </div>
        </div>
        <h2 class="tituloSeccion col-md-2">Popular</h2>
    </div>

    <div class="album py-5 tertiary" id="album">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="img/imgInicio/1.png" alt="">
                        <div class="card-body">
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="img/imgInicio/2.png" alt="">
                        <div class="card-body">
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="img/imgInicio/3.png" alt="">
                        <div class="card-body">
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cc.cdn.civiccomputing.com/9/cookieControl-9.x.min.js"></script>
    <script>
        var config = {
            apiKey: '33014b62ff1fa0dac6259bc9880be870d5721ff5',
            product: 'community',
            optionalCookies: [{
                name: 'analytics',
                label: 'Analytics',
                description: '',
                cookies: [],
                onAccept: function() {},
                onRevoke: function() {}
            }, {
                name: 'marketing',
                label: 'Marketing',
                description: '',
                cookies: [],
                onAccept: function() {},
                onRevoke: function() {}
            }, {
                name: 'preferences',
                label: 'Preferences',
                description: '',
                cookies: [],
                onAccept: function() {},
                onRevoke: function() {}
            }],

            position: 'RIGHT',
            theme: 'LIGHT'
        };

        CookieControl.load(config);
    </script>

</body>
<?php require('views/footer.php'); ?>