$(document).ready(function () {
    $('#alertmail').hide();
    $('#generalAlert').hide();
    $('#alertPass').hide();

    $('#boto-login').click(function (event) {
        event.preventDefault(); 

        if (comprovarMail() && comprovarContrasenya()) {
            $('#formulario').submit();
        }
    });
});

let email, mailformat, patroAlfaNumeric, password;

function dades() {
    email = $('#email').val();
    mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    password = $('#password').val();
    patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;
    patroAlfabetic = /^[A-Za-z]+$/;
    patroNumeric = /^[0-9]+$/;
}

function comprovarDades() {
    if (email === '' || password === '') {
        $('#generalAlert').text('Completa tots els camps.').show();
    }
}

function comprovarMail() {
    if (email === '') {
        $('#email').addClass('border-danger');
        $('#alertmail').text('El correu electrònic es obligatori.').show();
    } else if (!email.match(mailformat)) {
        $('#alertmail').text('Introdueix un mail en format correcte.').show();
        $('#email').addClass('border-danger');
    } else {
        $('#alertmail').hide();
        $('#email').removeClass('border-danger');
        $('#email').addClass('border-success');
        return true;
    }
}

function comprovarContrasenya() {
    if (password === '') {
        $('#password').addClass('border-danger');
        $('#alertPass').text('Cal introduir una contrasenya.').show();
    } else if (!password.match(patroAlfaNumeric)) {
        $('#password').addClass('border-danger');
        $('#alertPass').text('La contrasenya ha de tenir un format vàlid.').show();
    } else if (password !== '' && password.length < 8) {
        $('#password').addClass('border-danger');
        $('#alertPass').text('La contrasenya ha de tenir com a mínim 8 caràcters.').show();
    } else {
        $('#alertPass').hide();
        $('#password').removeClass('border-danger');
        $('#password').addClass('border-success');
        return true;
    }
}

function formulari() {
    dades();
    comprovarDades();
    comprovarMail();
    comprovarContrasenya();
}