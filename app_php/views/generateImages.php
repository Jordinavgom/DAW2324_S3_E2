<? require('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../public/assets/js/generatedImages.js"></script>
</head>

<body>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 md-3">
                <div class="mt-3">
                    <input type="text" class="form-control" id="textPrompt" name="prompt">
                    <button id="promptButton" type="button" class="btn btn-primary mt-3 w-50" name="promptButton">Generar imatges</button>
                </div>
                <div class="row justify-content-center">
                    <div id="spinner" class="spinner-grow text-light mt-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <div id="contentAfterLoading" class="container w-50 mt-3 text-center">
        <div class="row">
            <div class="col">
                <img src="../public/assets/img/generatedImages/image-1.jpeg" id="img1" class="rounded img-fade" alt="..." width="200" height="200">
            </div>
            <div class="col">
                <img src="../public/assets/img/generatedImages/image-2.jpeg" id="img2" class="rounded img-fade" alt="..." width="200" height="200">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <img src="../public/assets/img/generatedImages/image-3.jpeg" id="img3" class="rounded img-fade" alt="..." width="200" height="200">
            </div>
            <div class="col">
                <img src="../public/assets/img/generatedImages/image-4.jpeg" id="img4" class="rounded img-fade" alt="..." width="200" height="200">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <button id="continueButton" type="button" class="btn btn-primary mt-3" name="continueButton">Escollir un suport</button>
            </div>
            <div class="row">
                <button id="keepTrying" type="button" class="btn btn-primary mt-3" name="keepTrying">Torna a generar una imatge</button>
            </div>
        </div>
</body>


</html>