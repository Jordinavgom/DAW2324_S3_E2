function mostrarRegistre() {
    $("#sign-in").css("display", "none");
    $("#sign-up").css("display", "block");
}

function mostrarLogin() {
    $("#sign-in").css("display", "block");
    $("#sign-up").css("display", "none");
}






// LOGIN
$(document).ready(function () {
    $('#alertmail1').hide();
    $('#generalAlert1').hide();
    $('#alertPass1').hide();

    $('#emaillogin').on('input', function () {
        comprovarMail();
        restablirEstils();
    });

    $('#password').on('input', function () {
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
    if ($('#emaillogin').val() === '') {
        $('#emaillogin').removeClass('border-danger');
        $('#alertmail1').hide();
    } else if ($('#password').val() === '') {
        $('#password').removeClass('border-danger');
        $('#alertPass1').hide();
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
        $('#generalAlert1').text('Completa tots els camps.').show();
    }
}

function comprovarMail() {
    email = $('#emaillogin').val();
    let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email === '') {
        $('#emaillogin').removeClass('border-success');
        $('#emaillogin').addClass('border-danger');
        $('#alertmail1').text('El correu electrònic es obligatori.').show();
    } else if (!email.match(mailformat)) {
        $('#alertmail1').text('Introdueix un mail en format correcte.').show();
        $('#emaillogin').removeClass('border-success');
        $('#emaillogin').addClass('border-danger');
    } else {
        $('#alertmail1').hide();
        $('#emaillogin').removeClass('border-danger');
        $('#emaillogin').addClass('border-success');
        return true;
    }
}

function comprovarContrasenya() {
    password = $('#password').val();
    if (password === '') {
        $('#password').addClass('border-danger');
        $('#alertPass1').text('Cal introduir una contrasenya.').show();
    } else if (!password.match(patroAlfaNumeric)) {
        $('#password').addClass('border-danger');
        $('#alertPass1').text('La contrasenya ha de tenir un format vàlid.').show();
    } else if (password !== '' && password.length < 8) {
        $('#password').addClass('border-danger');
        $('#alertPass1').text('La contrasenya ha de tenir com a mínim 8 caràcters.').show();
    } else {
        $('#alertPass1').hide();
        $('#password').removeClass('border-danger');
        $('#password').addClass('border-success');
        return true;
    }
}

function formulari() {
    //dades();
    comprovarDades();
    comprovarMail();
    comprovarContrasenya();
}





// REGISTRE

$(document).ready(function () {
    $('#generalAlert').hide();
    $('#alertmail').hide();
    $('#alertPass').hide();
    $('#alertPass2').hide();
    $('#alertCondicions').hide();

    // Controladors de events para verificar els campos conforme s'escriuen
    $('#email').on('input', comprovarMail);
    $('#password1, #password2').on('input', comprovarContrasenya);
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
    password = $('#password1').val();
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

function formulariregistre() {
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
    let password = $('#password1').val();
    let password2 = $('#password2').val();
    let patroAlfaNumeric = /^[a-zA-Z0-9\s\-_.,'"/&(){}[\]<>]+$/;

    // Restableix els estils i els missatges d'alerta
    $('#password1, #password2').removeClass('border-danger border-success');
    $('#alertPass').hide().empty();

    if (password === '' && password2 === '') {
        mostrarError('La contrasenya és obligatòria.');
    } else if (password.length < 8) {
        mostrarError('La contrasenya ha de tenir com a mínim 8 caràcters.');
    } else if (!password.match(patroAlfaNumeric) || !password2.match(patroAlfaNumeric) && password2 !== '') {
        mostrarError('La contrasenya ha de tenir un format vàlid.');
    } else if (password2 !== password) {
        mostrarError('Les contrasenyes han de coincidir.');
    } else {
        $('#password1, #password2').addClass('border-success');
        return true;
    }

    return false;

    function mostrarError(missatge) {
        $('#password1, #password2').addClass('border-danger');
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
