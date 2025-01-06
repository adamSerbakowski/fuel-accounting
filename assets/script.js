$(document).ajaxStop(function(){
    window.location.reload();
});

function ajaxPost(data) {
    $.ajax({
        url : '/dataUpdate', 
        type : 'POST', 
        dataType : 'json', 
        data : data
    })
}

// ADDITIONS

function addPurchase(ev) {
    ev.preventDefault();
    ajaxPost({
        type: 'addPurchase',
        dostawca: $('#dostawca').val(),
        nr_dokumentu: $('#nr_dokumentu').val(),
        ilosc_paliwa: $('#ilosc_paliwa').val(),
        ilosc_adblue: $('#ilosc_adblue').val(),
        data_zakupu: $('#data_zakupu').val()
    })
}

function addRelease(ev) {
    ev.preventDefault();
    v = matchValidCar($('#samochod').val());
    if (v.length == 0) {
        console.log('no matching car found');
    } else {
        ajaxPost({
            type: 'addRelease',
            samochod: v[0].id,
            w_ilosc_paliwa: $('#w_ilosc_paliwa').val(),
            w_ilosc_adblue: $('#w_ilosc_adblue').val(),
            w_ilosc_ref: $('#w_ilosc_ref').val(),
            data_wydania: $('#data_wydania').val(),
            rodzaj: $('#rodzaj').val()
        })
    }
}

function addDriver(ev) {
    ev.preventDefault();
    // add validation error message
    ajaxPost({
        type: 'addDriver',
        nazwisko: $('#nazwisko').val()
    });
}

function addCar(ev) {
    ev.preventDefault();
    // add validation error message
    ajaxPost({
        type: 'addCar',
        nr_rejestracyjny: $('#nr_rejestracyjny').val(),
        bak_paliwo: $('#bak_paliwo').val(),
        bak_adblue: $('#bak_adblue').val()
    });
}

function addDelivery(ev) {
    ev.preventDefault();
    let data = prepareDeliveryData();
    if (data) {
        let extendedData = $.extend({type: 'addDelivery'}, data)
        ajaxPost(extendedData);
    }
}

function addAggregatedDelivery(ev) {
    ev.preventDefault();
    let data = prepareDeliveryData();
    if (data) {
        let extendedData = $.extend(
            {type: 'addAggregatedDelivery'}, 
            data, 
            prepareDeliveryPurchases()
        )
        ajaxPost(extendedData);
    }
}

function prepareDeliveryData() {
    let car = matchValidCar($('#samochod').val());
    let driver = matchValidDriver($('#kierowca').val());
    if (car.length == 0) {
        console.log('no matching car found');
        return false;
    } else if (driver.length == 0) {
        console.log('no matching driver found');
        return false;
    } else {
        return {
            samochod: car[0].id,
            kierowca:  driver[0].id,
            data_poczatek: $('#data_poczatek').val(),
            data_koniec: $('#data_koniec').val(),
            przejechane_kilometry: $('#przejechane_kilometry').val(),
            poprawne_kilometry: $('#poprawne_kilometry').val(),
            poprawne_spalanie: $('#poprawne_spalanie').val()
        }
    }
}

function prepareDeliveryPurchases() {
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
    return {purchases: deliveryPurchases};
}

// EDITION

$(window).ready(function() {
    getValidCars();
    getValidDrivers();

    $('#add-release').click(function () {
        let replaced = release.replaceAll('{{ count }}', c);
        $('#deliveryPurchases').append(replaced);
        c++;
    });

    $('.close-button').click(function () {
        $('.popup').css('display','none');
        fieldToEdit = '';
        idToEdit = '';
        $('.var').val('');
        currentValue = '';
    });

    $('.editable').click(function() {
        fieldToEdit = $(this).attr('data-field');
        idToEdit = $(this).parent().attr('data-id');
        tableToEdit = $(this).parent().attr('data-type');
        currentValue = $(this).text();
        if ($(this).hasClass('date-input')) {
            $('.var').attr('type', 'date');
        } else {
            $('.var').attr('type', 'text');
        };
        showPopup()
    });
});

function showPopup() {
    $('.popup__header').text('Edycja '+fieldToEdit);
    if (!currentValue) {
        $('.var').attr('placeholder', 'Wprowadź nowy '+fieldToEdit);
    } else {
        $('.var').val(currentValue);
    }

    if (fieldToEdit === 'id_car') {
        $('#przypiszPopUp').css('display','block');
    }
    else if (fieldToEdit === 'id_driver') {
        $('#przypiszKierPopUp').css('display','block');
    } else {
        $('#editPopUp').css('display','block'); 
    };
}

function submitEdit(ev) {
    ev.preventDefault();
    if (ev.key === 'Enter') {
        if ($('#var').val()!== '') {
            sendEditForm();
        }
    }
}

function submitChangeCarRelation(ev) {
    ev.preventDefault();
    if (ev.key === 'Enter') {
        if ($('#varP').val()) {
            sendPrzypiszForm();
        }
    }
}
function submitChangeDriverRelation(ev) {
    ev.preventDefault();
    if (ev.key === 'Enter') {
        if ($('#varK').val()) {
            sendPrzypiszFormKier();
        }
    }
}

function sendEditForm () {
    ajaxPost({
        type: 'updateField',
        id: idToEdit,
        field: fieldToEdit,
        value: $('#var').val(),
        table: tableToEdit
    })
}

function sendPrzypiszForm () {
    v = matchValidCar($('#varP').val());
    if (v.length == 0) {
        console.log('no matching car found');
    } else {
        ajaxPost({
            type: 'updateField',
            id: idToEdit,
            field: fieldToEdit,
            value: v[0].id,
            table: tableToEdit
        })
    }
}
function sendPrzypiszFormKier () {
    v = matchValidDriver($('#varK').val());
    if (v.length == 0) {
        console.log('no matching driver found');
    } else {
        ajaxPost({
            type: 'updateField',
            id: idToEdit,
            field: fieldToEdit,
            value: v[0].id,
            table: tableToEdit
        })
    }
}

// TOOLS

function matchValidCar(registration) {
    match = $.grep( validCars, function(n) {
        return n.registration === registration;
    });

    return match;
}

function matchValidDriver(name) {
    match = $.grep( validDrivers, function(n) {
        return n.name === name;
    });

    return match;
}

function getValidCars() {
    carsList = $( "#numeryrejEdit" ).find('option');
    carsList.each(function() {
        car = {
            id: $(this).attr('data-id'),
            registration: $(this).val(),
        };
        validCars.push(car);
    });
}

function getValidDrivers() {
    driversList = $( "#nazwiskoEdit" ).find('option');
    driversList.each(function() {
        driver = {
            id: $(this).attr('data-id'),
            name: $(this).val(),
        };
        validDrivers.push(driver);
    });
}

var fieldToEdit = '';
var idToEdit = '';
var tableToEdit = '';
var currentValue = '';
var validCars = [];
var validDrivers = [];
var release = `<h4>Tankowanie do trasy {{ count }}</h4>
<div class='deliveryPurchase' data-purchaseId='{{ count }}'>
<input type="text" class="w_ilosc_paliwa" name="w_ilosc_paliwa{{ count }}" placeholder="Wpisz ilość paliwa">
<input type="text" class="w_ilosc_adblue" name="w_ilosc_adblue{{ count }}" placeholder="Wpisz ilość adblue">
<input type="text" class="w_ilosc_ref" name="w_ilosc_ref{{ count }}" placeholder="Wpisz ilość REF">
<input type="date" class="data_wydania" name="data_wydania{{ count }}" placeholder="Wybierz datę">
<input type="text" class="rodzaj" name="rodzaj{{ count }}" placeholder="Baza czy trasa" list="rodzaje{{ count }}">
<datalist id="rodzaje{{ count }}">
    <option value="baza">baza</option>
    <option value="E100">E100</option>
    <option value="inne">inne</option>
</datalist>
</div>`;
var c = 2;