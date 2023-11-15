$(document).ready(function () {
    $('#alertmail').hide();
    $('#generalAlert').hide();
    $('#alertPass').hide();
    $('#alertPass2').hide();
    $('#alertCondicions').hide();

    // Controladors de events para verificar els campos conforme s'escriuen
    $('#email').on('input', comprovarMail);
    $('#password, #password2').on('input', comprovarContrasenya);
    $('#checkCondicions').on('change', comprovarCheckBox);

    // Controlador de events para el botó "Registrar-me"
    $('#boto-registrar').click(function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe de inmediato

        // Si els camps introduits son vàlids
        if (comprovarDades()) {
            // Enviar el formulari al servidor
            $('#formulario').submit();
        }
    });
});


function dades() {
    email = $('#email').val();
    mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    password = $('#password').val();
    password2 = $('#password2').val();
    patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;
    patroAlfabetic = /^[A-Za-z]+$/;
    patroNumeric = /^[0-9]+$/;
}

function comprovarDades() {
    comprovarMail();
    comprovarContrasenya();
    comprovarCheckBox();
    if (email === '' || password === '') {
        $('#generalAlert').text('Completa tots els camps.').show();
    }else {
        $('#generalAlert').hide();
        return true;
    }
}

function formulari() {
    dades();
    comprovarDades();
}

function comprovarMail() {
    let email = $('#email').val();
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
    let password = $('#password').val();
    let password2 = $('#password2').val();
    let patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;

    if (password === '' && password2 === '') {
        $('#password, #password2').addClass('border-danger');
        $('#alertPass').text('La contrasenya és obligatòria.').show();
    } else if (password.length < 8) {
        $('#password, #password2').removeClass('border-success');
        $('#password').addClass('border-danger');
        $('#alertPass').text('La contrasenya ha de tenir com a mínim 8 caràcters.').show();
    } else if (!password.match(patroAlfaNumeric) && !password2.match(patroAlfaNumeric)) {
        $('#password, #password2').removeClass('border-success');
        $('#password, #password2').addClass('border-danger');
        $('#alertPass').text('La contrasenya ha de tenir un format vàlid.').show();
    } else if (password2 !== '' && password !== password2) {
        $('#password2').addClass('border-danger');
        $('#alertPass').text('Les contrasenyes han de coincidir.').show();
    } else if (password === password2) {
        $('#alertPass').hide();
        $('#password, #password2').removeClass('border-danger');
        $('#password, #password2').addClass('border-success');
    } else {
        $('#alertPass').hide();
        $('#password, #password2').removeClass('border-danger');
        $('#password').addClass('border-success');
        return true;
    }
    // } else if (password.length < 8) {
    //     $('#password, #password2').removeClass('border-success');
    //     $('#password').addClass('border-danger');
    //     $('#alertPass').text('La contrasenya ha de tenir com a mínim 8 caràcters.').show();
    // } else if (!password.match(patroAlfaNumeric) && !password2.match(patroAlfaNumeric)) {
    //     $('#password, #password2').removeClass('border-success');
    //     $('#password, #password2').addClass('border-danger');
    //     $('#alertPass').text('La contrasenya ha de tenir un format vàlid.').show();
    // } 
    // else if (password2 !== '' && password !== password2) {
    //     $('#alertPass').text('Cal introduir la mateixa contrasenya.').show();
    //     $('#password, #password2').removeClass('border-success');
    //     $('#password, #password2').addClass('border-danger');
    // } else if (password === password2) {
    //     $('#alertPass, #alertPass2').hide();
    //     $('#password, #password2').removeClass('border-danger');
    //     $('#password, #password2').addClass('border-success');
    // }
}

function comprovarCheckBox() {
    const checkbox = $("#checkCondicions")[0]; // Obtén el elemento DOM a través de [0]

    if (!checkbox.checked) {
        $('#checkCondicions').removeClass('border-success');
        $('#checkCondicions').addClass('border-danger');
        $('#alertCondicions').text('Cal llegir i acceptar els termes i condicions.').show();
    } else {
        $('#checkCondicions').removeClass('border-danger');
        $('#checkCondicions').addClass('border-success');
        $('#alertCondicions').hide();
        return true;
    }
}
