<? require('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../public/assets/js/generatedImages.js"></script>
</head>
<style>
    .zoom {
        background-color: green;
        transition: transform .2s;
        /* Animation */
    }

    .zoom:hover {
        transform: scale(1.05);
        cursor: pointer;
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
</style>

<body>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 md-3">
                <div class="mt-3">
                    <input type="text" class="form-control" id="textPrompt" name="prompt">
                    <button id="promptButton" type="button" class="btn btn-primary mt-3 w-50" name="promptButton">Generar imatges</button>
                </div>
            </div>

        </div>
    </div>
    </div>
    <div id="contentAfterLoading" class="container w-50 modal-content rounded p-3 p-md-5 text-center bg-success">
        <div class="row justify-content-center">
            <div id="spinner" class="spinner-grow text-light mt-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <img id="img1" class="rounded img-fade zoom" onclick="buttonClick('img1')" src="../public/assets/img/generatedImages/image-1.jpeg" alt="..." width="70%" height="auto">
            </div>
            <div class="col-12 col-md-6">
                <img id="img2" class="rounded img-fade zoom" onclick="buttonClick('img2')" src="../public/assets/img/generatedImages/image-2.jpeg" alt="..." width="70%" height="auto">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <img id="img3" class="rounded img-fade zoom" onclick="buttonClick('img3')" src="../public/assets/img/generatedImages/image-3.jpeg" alt="..." width="70%" height="auto">
            </div>
            <div class="col-12 col-md-6">
                <img id="img4" class="rounded img-fade zoom" onclick="buttonClick('img4')" src="../public/assets/img/generatedImages/image-4.jpeg" alt="..." width="70%" height="auto">
            </div>
        </div>
    </div>

    <div class="col">
        <div class="row justify-content-center">
            <button id="continueButton" type="button" class="btn mt-3 w-25" name="continueButton">Escollir un suport</button>
        </div>
        <div class="row justify-content-center">
            <button id="keepTrying" type="button" class="btn btn-primary mt-3 w-25" name="keepTrying">Torna a generar una imatge</button>
        </div>
    </div>
</body>


</html>