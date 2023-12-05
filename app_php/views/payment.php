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
        </div><!--#cards end-->
      </div><!--col-xs-5 end-->
      <div class="col-xs-5">
        <!--#cards end-->
      </div><!--col-xs-5 end-->
    </div><!--row end-->
    <div class="row">
      <div class="alert alert-danger" id="generalAlert" role="alert">Completa tots els camps</div>
      <div class="col-xs-5">
        <i class="fa fa fa-user"></i>
        <label for="cardholder">Nom del titular de la targeta</label>
        <input type="text" placeholder="John Doe" id="cardholder">
        <!-- <div class="alert alert-danger" id="alert-cardholder" role="alert"></div> -->
      </div><!--col-xs-5-->
      <div class="col-xs-5">
        <i class="fa fa-credit-card-alt"></i>
        <label for="cardnumber">Número de la targeta</label>
        <input type="text" placeholder="1234 1234 1234 1234" id="cardnumber">
        <!-- <div class="alert alert-danger" id="alertmail" role="alert"></div> -->
      </div><!--col-xs-5-->
    </div><!--row end-->
    <div class="row row-three">
      <div class="col-xs-2">
        <i class="fa fa-calendar"></i>
        <label for="date">Valid fins</label>
        <input type="text" placeholder="MM/YY" id="date">
        <!-- <div class="alert alert-danger" id="alertmail" role="alert"></div> -->
      </div><!--col-xs-3-->
      <div class="col-xs-2">
        <i class="fa fa-lock"></i>
        <label for="date">CVV / CVC *</label>
        <input type="text" id="cvc" placeholder="000">
        <!-- <div class="alert alert-danger" id="alertmail" role="alert"></div> -->
      </div><!--col-xs-3-->
      <!-- <div class="col-xs-5">
        <span class="small">* CVV or CVC is the card security code, unique three digits number on the back of your card seperate from its number.</span>
      </div>col-xs-6 end -->
    </div><!--row end-->
    <footer class="text-center">
      <button class="btn btn-success" id="boto-pagar">Pagar</a>
    </footer>
  </div><!--wrapper end-->
</body>