$(document).ready(function () {
    $('#alertmail').hide();
    $('#generalAlert').hide();
    $('#alertPass').hide();

    $('#email').on('input', function () {
        comprovarMail();
        restablirEstils();
    });

    $('#pass').on('input', function () {
        comprovarContrasenya();
        restablirEstils();
    });

    $('#boto-login').click(function (event) {
        event.preventDefault();

        if (comprovarDades() && comprovarMail() && comprovarContrasenya()) {
            $('#formulario').submit();

        }
    });
});

let mailformat, patroAlfaNumeric;
function restablirEstils() {
    if ($('#email').val() === '') {
        $('#email').removeClass('border-danger');
        $('#alertmail').hide();
    } else if ($('#pass').val() === '') {
        $('#pass').removeClass('border-danger');
        $('#alertPass').hide();
    }
}
// function dades() {
//     mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//     patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;
//     patroAlfabetic = /^[A-Za-z]+$/;
//     patroNumeric = /^[0-9]+$/;
// }

function comprovarDades() {
    if (email === '' || password === '') {
        $('#generalAlert').text('Completa tots els camps.').show();
    }
}

function comprovarMail() {
    email = $('#email').val();
    let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email === '') {
        $('#email').removeClass('border-success');
        $('#email').addClass('border-danger');
        $('#alertmail').text('El correu electrònic es obligatori.').show();
    } else if (!email.match(mailformat)) {
        $('#alertmail').text('Introdueix un mail en format correcte.').show();
        $('#email').removeClass('border-success');
        $('#email').addClass('border-danger');
    } else {
        $('#alertmail').hide();
        $('#email').removeClass('border-danger');
        $('#email').addClass('border-success');
        return true;
    }
}

function comprovarContrasenya() {
    password = $('#pass').val();
    if (password === '') {
        $('#pass').addClass('border-danger');
        $('#alertPass').text('Cal introduir una contrasenya.').show();
    } else if (!password.match(patroAlfaNumeric)) {
        $('#pass').addClass('border-danger');
        $('#alertPass').text('La contrasenya ha de tenir un format vàlid.').show();
    } else if (password !== '' && password.length < 8) {
        $('#pass').addClass('border-danger');
        $('#alertPass').text('La contrasenya ha de tenir com a mínim 8 caràcters.').show();
    } else {
        $('#alertPass').hide();
        $('#pass').removeClass('border-danger');
        $('#pass').addClass('border-success');
        return true;
    }
}

function formulari() {
    //dades();
    comprovarDades();
    comprovarMail();
    comprovarContrasenya();
}