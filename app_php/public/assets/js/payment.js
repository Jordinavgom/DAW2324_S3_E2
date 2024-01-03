$(document).ready(function () {
    $('#generalAlert').hide();
});

function comprovaDades() {
    cardholder = $('#cardholder').val();
    cardnumber = $('#cardnumber').val();
    date = $('#date').val();
    cvc = $('#cvc').val();

    if (cardholder == '' || cardnumber == '' || date == '' || cvc == '') {
        $('#generalAlert').show();
    } else {
        window.location.href = "./confirmation.php"
    }
}