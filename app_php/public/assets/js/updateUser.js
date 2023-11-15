$(document).ready(function () {
    $('#generalAlert').hide();
    $('#alertNom').hide();
    $('#alertCognoms').hide();
    $('#alertAdreça').hide();
    $('#alertCiutat').hide();
    $('#alertCodiPostal').hide();
    $('#alertTelefon').hide();

    // Controladors de events para verificar els campos conforme s'escriuen
    $('#nom').on('input', comprovarNom);
    $('#cognoms').on('input', comprovarCognoms);
    $('#adreça').on('input', comprovarAdreça);
    $('#ciutat').on('input', comprovarCiutat);
    $('#codipostal').on('input', comprovarCodiPostal);
    $('#telefon').on('input', comprovarTelefon);

    // Controlador de events para el botó "Registrar-me"
    $('#boto-update').click(function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe de inmediato

        // Si els camps introduits son vàlids
        if (comprovarDades()) {
            // Enviar el formulari al servidor
            $('#formulario').submit();
        }
    });
});


function dades() {
    patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;
    patroAlfabetic = /^[A-Za-z]+$/;
    patroNumeric = /^[0-9]+$/;
    nom = $('#nom').val();
    cognoms = $('#cognoms').val();
    adreça = $('#adreça').val();
    ciutat = $('#ciutat').val();
    codipostal = $('#codipostal').val();
    telefon = $('#telefon').val();
}

function comprovarDades() {
    comprovarNom();
    comprovarCognoms();
    comprovarAdreça();
    comprovarCiutat();
    comprovarCodiPostal();
    comprovarTelefon();
    if (nom === '' || cognoms === '' || adreça === '' || ciutat === '' || codipostal === '' || telefon === '') {
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

function comprovarNom() {
    let nom = $('#nom').val();
    let patroAlfabetic = /^[A-Za-z]+$/;

    if (nom === '') {
        $('#nom').removeClass('border-success');
        $('#nom').addClass('border-danger');
        $('#alertNom').text('El nom és obligatori.').show();
    } else if (!nom.match(patroAlfabetic)) {
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

function comprovarCognoms() {
    let cognoms = $('#cognoms').val();
    let patroAlfabetic = /^[A-Za-z]+$/;

    if (cognoms === '') {
        $('#cognoms').removeClass('border-success');
        $('#cognoms').addClass('border-danger');
        $('#alertCognoms').text('Els cognoms són obligatoris.').show();
    } else if (!cognoms.match(patroAlfabetic)) {
        $('#cognoms').removeClass('border-success');
        $('#cognoms').addClass('border-danger');
        $('#alertCognoms').text('Introdueix els cognoms en format correcte.').show();
    } else {
        $('#alertCognoms').hide();
        $('#cognoms').removeClass('border-danger');
        $('#cognoms').addClass('border-success');
        return true;
    }
}

function comprovarAdreça() {
    let adreça = $('#adreça').val();
    let patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;

    if (adreça === '') {
        $('#adreça').removeClass('border-success');
        $('#adreça').addClass('border-danger');
        $('#alertAdreça').text('Ladreça és obligatoria.').show();
    } else if (!adreça.match(patroAlfaNumeric)) {
        $('#adreça').removeClass('border-success');
        $('#adreça').addClass('border-danger');
        $('#alertAdreça').text('Introdueix una adreça en format correcte.').show();
    } else {
        $('#alertAdreça').hide();
        $('#adreça').removeClass('border-danger');
        $('#adreça').addClass('border-success');
        return true;
    }
}

function comprovarCiutat() {
    let ciutat = $('#ciutat').val();
    let patroAlfabetic = /^[A-Za-z]+$/;
    if (ciutat === '') {
        $('#ciutat').addClass('border-danger');
        $('#alertCiutat').text('La ciutat és obligatòria.').show();
    } else if (!ciutat.match(patroAlfabetic)) {
        $('#ciutat').addClass('border-danger');
        $('#alertCiutat').text('Introdueix una ciutat en format correcte.').show();
    }
    else {
        $('#alertCiutat').hide();
        $('#ciutat').removeClass('border-danger');
        $('#ciutat').addClass('border-success');
        return true;
    }
}

function comprovarCodiPostal() {
    let codipostal = $('#codipostal').val();
    let patroNumeric = /^[0-9]+$/;

    if (codipostal === '') {
        $('#codipostal').removeClass('border-success');
        $('#codipostal').addClass('border-danger');
        $('#alertCodiPostal').text('El codi postal és obligatori.').show();
    } else if (!codipostal.match(patroNumeric)) {
        $('#codipostal').removeClass('border-success');
        $('#codipostal').addClass('border-danger');
        $('#alertCodiPostal').text('Introdueix un codi postal en format correcte.').show();
    } else if (codipostal.length !== 5) {
        $('#alertCodiPostal').text('Ha de contenir 5 dígits.').show();
    } else {
        $('#alertCodiPostal').hide();
        $('#codipostal').removeClass('border-danger');
        $('#codipostal').addClass('border-success');
        return true;
    }
}

function comprovarTelefon() {
    let telefon = $('#telefon').val();
    let patroNumeric = /^[0-9]+$/;

    if (telefon === '') {
        $('#telefon').removeClass('border-success');
        $('#telefon').addClass('border-danger');
        $('#alertTelefon').text('El telèfon és obligatori.').show();
    } else if (!telefon.match(patroNumeric)) {
        $('#telefon').removeClass('border-success');
        $('#telefon').addClass('border-danger');
        $('#alertTelefon').text('Introdueix un telèfon en format correcte.').show();
    } else if (telefon.length !== 9) {
        $('#alertTelefon').text('El telèfon ha de contenir 9 dígits.').show();
    }
    else {
        $('#alertTelefon').hide();
        $('#telefon').removeClass('border-danger');
        $('#telefon').addClass('border-success');
        return true;
    }
}


