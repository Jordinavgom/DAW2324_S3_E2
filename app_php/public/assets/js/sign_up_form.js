$(document).ready(function () {
    $('#generalAlert').hide();
    $('#alertmail').hide();
    $('#alertPass').hide();
    $('#alertPass2').hide();
    $('#alertCondicions').hide();

    // Controladors de events para verificar els campos conforme s'escriuen
    $('#email').on('input', comprovarMail);
    $('#pass, #password2').on('input', comprovarContrasenya);
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

// checkbox = $("#checkCondicions")[0];
function dades() {
    email = $('#email').val();
    password = $('#pass').val();
    password2 = $('#password2').val();
}

function comprovarDades() {
    comprovarMail();
    comprovarContrasenya();
    comprovarCheckBox();
    if (email === '' || password === '' || password2 === '') {
        $('#generalAlert').text('Completa tots els camps.').show();
    } else if (comprovarMail() && comprovarContrasenya() && comprovarCheckBox()) {
        $('#generalAlert').hide();
        $('#formulario').submit();
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
    let password = $('#pass').val();
    let password2 = $('#password2').val();
    let patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;

    // Restableix els estils i els missatges d'alerta
    $('#pass, #password2').removeClass('border-danger border-success');
    $('#alertPass').hide().empty();

    if (password === '' && password2 === '') {
        mostrarError('La contrasenya és obligatòria.');
    } else if (password.length < 8) {
        mostrarError('La contrasenya ha de tenir com a mínim 8 caràcters.');
    } else if ( !password.match(patroAlfaNumeric) || !password2.match(patroAlfaNumeric) && password2 !=='' ) {
        mostrarError('La contrasenya ha de tenir un format vàlid.');
    } else if (password2 !== password) {
        mostrarError('Les contrasenyes han de coincidir.');
    } else {
        $('#pass, #password2').addClass('border-success');
        return true;
    }

    return false;

    function mostrarError(missatge) {
        $('#pass, #password2').addClass('border-danger');
        $('#alertPass').text(missatge).show();
    }
}



function comprovarNom() {
    let nom = $('#nom').val();
    let patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;

    if (nom === '') {
        $('#nom').removeClass('border-success');
        $('#nom').addClass('border-danger');
        $('#alertNom').text('El nom és obligatori.').show();
    } else if (!nom.match(patroAlfaNumeric)) {
        $('#nom').removeClass('border-success');
        $('#nom').addClass('border-danger');
        $('#alertNom').text('Introdueix un nom en format correcte.').show();
    } else {
        $('#alertNom').hide();
        $('#nom').removeClass('border-danger');
        $('#nom').addClass('border-success');
        return true;
    }
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
