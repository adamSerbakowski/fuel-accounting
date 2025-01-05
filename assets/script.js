$(document).ajaxStop(function(){
    window.location.reload();
});

// ADDITIONS

function dodajZakup(ev) {
    ev.preventDefault();
    sendZakup();
}

function sendZakup() {
     $.ajax({
        url : '/dataUpdate', 
        type : 'POST', 
        dataType : 'json', 
        data : { 
            type: 'addPurchase',
            dostawca: $('#dostawca').val(),
            nr_dokumentu: $('#nr_dokumentu').val(),
            ilosc_paliwa: $('#ilosc_paliwa').val(),
            ilosc_adblue: $('#ilosc_adblue').val(),
            data_zakupu: $('#data_zakupu').val()
        }
    })
}

function dodajWydanie(ev) {
    ev.preventDefault();
    sendWydanie();
}

function sendWydanie() {
     $.ajax({
        url : '/dataUpdate', 
        type : 'POST', 
        dataType : 'json', 
        data : {
            type: 'addRelease',
            samochod: $('#samochod').val(),
            w_ilosc_paliwa: $('#w_ilosc_paliwa').val(),
            w_ilosc_adblue: $('#w_ilosc_adblue').val(),
            w_ilosc_ref: $('#w_ilosc_ref').val(),
            data_wydania: $('#data_wydania').val(),
            rodzaj: $('#rodzaj').val()
        }
    })
}

function dodajTrasa(ev) {
    ev.preventDefault();
    sendTrasa();
}

function sendTrasa() {
     $.ajax({
        url : '/dataUpdate', 
        type : 'POST', 
        dataType : 'json', 
        data : {
            type: 'addDelivery',
            samochod: $('#samochod').val(),
            kierowca: $('#kierowca').val(),
            data_poczatek: $('#data_poczatek').val(),
            data_koniec: $('#data_koniec').val(),
            przejechane_kilometry: $('#przejechane_kilometry').val(),
            poprawne_kilometry: $('#poprawne_kilometry').val(),
            poprawne_spalanie: $('#poprawne_spalanie').val()
        }
    })
}

function dodajKierowca(ev) {
    ev.preventDefault();
    sendKierowca();
}

function sendKierowca() {
    // add validation error message
     $.ajax({
        url         : '/dataUpdate', 
        type      : 'POST', 
        dataType    : 'json', 
        data        : {
            type: 'addDriver',
            nazwisko: $('#nazwisko').val()
        }
    });
}

function dodajSamochod(ev) {
    ev.preventDefault();
    sendSamochod();
}

function sendSamochod() {
    // add validation error message
     $.ajax({
        url         : '/dataUpdate', 
        type      : 'POST', 
        dataType    : 'json', 
        data        : {
            type: 'addCar',
            nr_rejestracyjny: $('#nr_rejestracyjny').val(),
            bak_paliwo: $('#bak_paliwo').val(),
            bak_adblue: $('#bak_adblue').val()
        }
    });
}

function dodajTrasaCala(ev) {
    ev.preventDefault();
    sendTrasaCala();
}

function sendTrasaCala() {
    let deliveryPurchases = [];
    inputPurchases = $( "#deliveryPurchases" ).find( ".deliveryPurchase" );
    inputPurchases.each(function() {
        purchase = {
            w_ilosc_paliwa: $(this).find('.w_ilosc_paliwa').val(),
            w_ilosc_adblue: $(this).find('.w_ilosc_adblue').val(), 
            w_ilosc_ref: $(this).find('.w_ilosc_ref').val(), 
            data_wydania: $(this).find('.data_wydania').val(), 
            rodzaj: $(this).find('.rodzaj').val(),   
        };
        deliveryPurchases.push(purchase);
    });

    $.ajax({
        url : '/dataUpdate', 
        type : 'POST', 
        dataType : 'json', 
        data : {
            type: 'addAggregatedDelivery',
            samochod: $('#samochod').val(),
            kierowca: $('#kierowca').val(),
            data_poczatek: $('#data_poczatek').val(),
            data_koniec: $('#data_koniec').val(),
            przejechane_kilometry: $('#przejechane_kilometry').val(),
            poprawne_kilometry: $('#poprawne_kilometry').val(),
            poprawne_spalanie: $('#poprawne_spalanie').val(),
            purchases: deliveryPurchases
        }
    });
}

// EDITION

var fieldToEdit = '';
var idToEdit = '';
var tableToEdit = '';
var currentValue = '';

$(window).ready(function() {
    $('.editable').click(function() {
        fieldToEdit = $(this).attr('data-field');
        idToEdit = $(this).parent().attr('data-id');
        tableToEdit = $(this).parent().attr('data-type');
        currentValue = $(this).text();

        if ($(this).hasClass('date-input')) {
            $('#var').attr('type', 'date');
        } else {
            $('#var').attr('type', 'text');
        };

        if (fieldToEdit === 'id_car') {
            showCarRelationEditPopup();
        }
        else if (fieldToEdit === 'id_driver') {
            showDriverRelationEditPopup();
        } else {
            showEditPopup();
        };
    });
});

function showEditPopup() {
    $('#editPopUp').css('display','block');
    $('.popup__header').text('Edycja '+fieldToEdit);
    if (!currentValue) {
        $('#var').attr('placeholder', 'Wprowadź nowy '+fieldToEdit);
    } else {
        $('#var').val(currentValue);
    }
}

function submitEdit(ev) {
    ev.preventDefault();
    if (ev.key === 'Enter') {
        if ($('#var').val()!== '') {
            sendEditForm();
        }
    }
}

function sendEditForm () {
    $.ajax({
        url         : '/dataUpdate', 
        type      : 'POST', 
        dataType    : 'json', 
        data        : {
            type: 'updateField',
            id: idToEdit,
            field: fieldToEdit,
            value: $('#var').val(),
            table: tableToEdit
        }
    })
}

function exitEditForm() {
    $('#editPopUp').css('display','none');
    fieldToEdit = '';
    idToEdit = '';
    $('#var').val('');
    currentValue = '';
}
function submitPrzypisz(ev) {
    ev.preventDefault();
    
    if (ev.key === 'Enter') {
        if ($('#varP').val()) {
            sendPrzypiszForm();
        }
            
            
        //     $('#varK').val()) {

        //     sendPrzypiszForm();
        // }
    }
}

function showCarRelationEditPopup() {
    $('#przypiszPopUp').css('display','block');
    if (!currentValue) {
        $('#varP').attr('placeholder', 'Wprowadź nowy '+fieldToEdit);
    } else {
        $('#varP').val(currentValue);
    }
}

function showDriverRelationEditPopup() {
    $('#przypiszKierPopUp').css('display','block');
    if (!currentValue) {
        $('#varK').attr('placeholder', 'Wprowadź nowy '+fieldToEdit);
    } else {
        $('#varK').val(currentValue);
    }
}

function sendPrzypiszForm () {
    v = findValidCar($('#varP').val());
    if (v == []) {
        console.log('no matching car found');
    } else {
        $.ajax({
            url : '/dataUpdate', 
            type : 'POST', 
            dataType : 'json', 
            data : { 
                type: 'updateField',
                id: idToEdit,
                field: fieldToEdit,
                value: v.id,
                table: tableToEdit
            }
        })
    }

    console.log(v);

}
function sendPrzypiszFormKier () {
    $.ajax({
        url         : '/dataUpdate', 
        type      : 'POST', 
        dataType    : 'json', 
        data        : {
            type: 'updateField',
            id: idToEdit,
            field: fieldToEdit,
            value: $('#varK').val(),
            table: tableToEdit
        }
    })
}
function exitPrzypiszForm() {
    $('#przypiszPopUp').css('display','none');
    $('#przypiszKierPopUp').css('display','none');
    fieldToEdit = '';
    idToEdit = '';
    $('#varP').val('');
    $('#varK').val('');
}

function findValidCar(registration) {
    validCars = $( "#numeryrejEdit" ).find('option');
    v = [];
    validCars.each(function() {
        car = {
            id: $(this).attr('data-id'),
            registration: $(this).val(),
        };
        v.push(car);
    });
    match = $.grep( v, function(n) {
        return n.registration === registration;
    });
    // console.log(v);
    // console.log(registration);
    // console.log(match);
    // if (v.includes(registration)) {
    //     return true;
    // }

    return match;
}
