$(document).ready(function () {
    $('#generalAlert').hide();
    cardholder = $('#cardholder').val();
    cardnumber = $('#cardnumber').val();
    date = $('#date').val();
    cvc = $('#cvc').val();



    $('#boto-pagar').click(function (event) {
        if (cardholder == '' || cardnumber == '' || date == '' || cvc == '') {
            $('#generalAlert').show();
        } else {
            window.location.href = "./confirmation.php"
        }
    });
});