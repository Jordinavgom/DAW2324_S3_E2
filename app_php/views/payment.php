<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../public/assets/js/credit_card.js"></script>
  <script src="../public/assets/js/payment.js"></script>
  <link rel="stylesheet" href="../public/assets/css/payment.css">
</head>

<body>

  <div id="wrapper">
    <div class="row">
      <div class="col-xs-5">
        <div id="cards">
          <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png">
          <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png">
        </div>
      </div>

    </div>

    <div class="alert alert-danger" id="generalAlert" role="alert">Completa tots els camps</div>
    <div class="row w-50 mx-auto">
      <div class="col">
        <div class="form-group mb-3">
          <i class="fa fa-user"></i>
          <label for="cardholder">Nom del titular de la targeta</label>
          <input type="text" class="form-control" placeholder="John Doe" id="cardholder">
        </div>

        <div class="form-group mb-3">
          <i class="fa fa-credit-card-alt"></i>
          <label for="cardnumber">Número de la targeta</label>
          <input type="text" class="form-control" placeholder="1234 1234 1234 1234" id="cardnumber">
        </div>

        <div class="form-group mb-3">
          <i class="fa fa-calendar"></i>
          <label for="date">Valid fins</label>
          <input type="text" class="form-control" placeholder="MM/YY" id="date">
        </div>

        <div class="form-group mb-3">
          <i class="fa fa-lock"></i>
          <label for="cvc">CVV / CVC *</label>
          <input type="text" class="form-control" id="cvc" placeholder="000">
        </div>
      </div>
    </div>

    <footer class="text-center">
      <button class="btn btn-success" id="boto-pagar" onclick=comprovaDades()>Pagar</a>
    </footer>
  </div>
</body>