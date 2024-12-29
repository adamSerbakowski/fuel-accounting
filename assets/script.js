$(document).ajaxStop(function(){
    window.location.reload();
});

function submitEdit(ev) {
    ev.preventDefault();
    
    if (ev.key === 'Enter') {
        if ($('#var').val()!== '') {
            sendEditForm();
        }
    }
}
        
var fieldToEdit = '';
var idToEdit = '';
var napToEdit = '';

function edit(field, id, tabela) {
    $('#editPopUp').css('display','block');
    $('.popup__header').text('Edycja '+field);
    var fieldVal = $(`span[data-field=''+field+''][data-id=''+id+'']`).text();
    if (fieldVal === '') {
        $('#var').attr('placeholder', 'Wprowadź nowy '+field);
    } else {
        $('#var').val(fieldVal);
    }
    
    fieldToEdit = field;
    idToEdit = id;
    napToEdit = tabela;
    //console.log();
}



function sendEditForm () {
   // console.log(idToEdit, fieldToEdit, $('#var').val(), napToEdit);
            $.ajax({
                url         : '/paliwo/update.php', 
                type      : 'POST', 
                dataType    : 'json', 
                data        : { 
                    id: idToEdit,
                    field: fieldToEdit,
                    value: $('#var').val(),
                    naprawa: napToEdit
                }})
                .done(function(res) {
                    if (res.code === 1) {
                        fieldToEdit = '';
                        idToEdit = '';
                        location.reload();
            
                    } else {
                        console.error('błąd połączenia');
                    }
                }); 

                
}
function exitEditForm() {
    $('#editPopUp').css('display','none');
    fieldToEdit = '';
    idToEdit = '';
    $('#var').val('');
}

// DODAWANIE

function dodajZakup(ev) {
    ev.preventDefault();
    sendZakup();
}

function sendZakup() {
     $.ajax({
                url         : '/dataUpdate', 
                type      : 'POST', 
                dataType    : 'json', 
                data        : { 
                    type: 'addPurchase',
                    dostawca: $('#dostawca').val(),
                    nr_dokumentu: $('#nr_dokumentu').val(),
                    ilosc_paliwa: $('#ilosc_paliwa').val(),
                    ilosc_adblue: $('#ilosc_adblue').val(),
                    data_zakupu: $('#data_zakupu').val()
                }})
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
        }})
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
        }})
}

// PRZYPISYWANIE

function submitPrzypisz(ev) {
    ev.preventDefault();
    
    if (ev.key === 'Enter') {
        if ($('#varP').val()!== '' || $('#varK').val()!== '' ) {
            sendPrzypiszForm();
        }

    }
}
        
var fieldToEdit = '';
var idToEdit = '';
var napToEdit = '';

function przypisz(field, id, tabela) {
    $('#przypiszPopUp').css('display','block');
    var fieldVal = $(`span[data-field=''+field+''][data-id=''+id+''][data-tab=''+tabela+'']`).text();
    if (fieldVal === '') {
        $('#varP').attr('placeholder', 'Wprowadź nowy '+field);
    } else {
        $('#varP').val(fieldVal);
    }
    
    fieldToEdit = field;
    idToEdit = id;
    napToEdit = tabela;
    //console.log();
}
function przypiszKier(field, id, tabela) {
    $('#przypiszKierPopUp').css('display','block');
    var fieldVal = $(`span[data-field=''+field+''][data-id=''+id+''][data-tab=''+tabela+'']`).text();
    if (fieldVal === '') {
        $('#varK').attr('placeholder', 'Wprowadź nowy '+field);
    } else {
        $('#varK').val(fieldVal);
    }
    
    fieldToEdit = field;
    idToEdit = id;
    napToEdit = tabela;
    //console.log();
}

function sendPrzypiszForm () {
   // console.log(idToEdit, fieldToEdit, $('#var').val(), napToEdit);
            $.ajax({
                url         : '/paliwo/update.php', 
                type      : 'POST', 
                dataType    : 'json', 
                data        : { 
                    id: idToEdit,
                    field: fieldToEdit,
                    value: $('#varP').val(),
                    naprawa: napToEdit
                }})
                .done(function(res) {
                    if (res.code === 1) {
                        fieldToEdit = '';
                        idToEdit = '';
                        location.reload();
            
                    } else {
                        console.error('błąd połączenia');
                    }
                }); 

                
}
function sendPrzypiszFormKier () {
   // console.log(idToEdit, fieldToEdit, $('#var').val(), napToEdit);
            $.ajax({
                url         : '/paliwo/update.php', 
                type      : 'POST', 
                dataType    : 'json', 
                data        : { 
                    id: idToEdit,
                    field: fieldToEdit,
                    value: $('#varK').val(),
                    naprawa: napToEdit
                }})
                .done(function(res) {
                    if (res.code === 1) {
                        fieldToEdit = '';
                        idToEdit = '';
                        location.reload();
            
                    } else {
                        console.error('błąd połączenia');
                    }
                }); 

                
}
function exitPrzypiszForm() {
    $('#przypiszPopUp').css('display','none');
    $('#przypiszKierPopUp').css('display','none');
    fieldToEdit = '';
    idToEdit = '';
    $('#varP').val('');
    $('#varK').val('');
}

// FILTRY

//function filtrDostawca(dostawca) {
//    dostawcaFiltr = dostawca;
//    console.log(dostawcaFiltr);
//    $.ajax({
//                url         : '/paliwo/?dostawcaFiltr='+dostawcaFiltr, 
//                type      : 'GET', 
//                dataType    : 'json', 
//                data        : { 
//                    dostawcaFiltr: dostawcaFiltr
//                }})
//            .done(function(res) {
//                        location.reload();
//                }); 
//}


function filtrujZakupy () {
    
                $.ajax({
                url         : '/', 
                type      : 'GET', 
                dataType    : 'json', 
                data        : { 
                    dataPoczatek: $('#zakupPoczatek').val(),
                    dataKoniec: $('#zakupKoniec').val(),
                    dostawcaFiltr: $('#dostawcaFi').val()
                }});
            $('#wybranyDostawca').text($('#dostawcaFi').val());
            }


function filtrujWydania () {
    
                $.ajax({
                url         : '/', 
                type      : 'GET', 
                dataType    : 'json', 
                data        : { 
                    wdataPoczatek: $('#wydaniePoczatek').val(),
                    wdataKoniec: $('#wydanieKoniec').val(),
                    samochodFiltr: $('#samochodFi').val()
                }});
            $('#wybranySamochod').text($('#samochodFi').val());
            }
            
            
            
function dodajTrasaCala(ev) {
    ev.preventDefault();
    sendTrasaCala();
}

function sendTrasaCala() {
     $.ajax({
                url         : '/paliwo/dodaj-cala-trasa.php', 
                type      : 'POST', 
                dataType    : 'json', 
                data        : { 
                    samochod: $('#samochod').val(),
                    kierowca: $('#kierowca').val(),
                    data_poczatek: $('#data_poczatek').val(),
                    data_koniec: $('#data_koniec').val(),
                    przejechane_kilometry: $('#przejechane_kilometry').val(),
                     poprawne_kilometry: $('#poprawne_kilometry').val(),
                    poprawne_spalanie: $('#poprawne_spalanie').val(),

                    w_ilosc_paliwa1: $('#w_ilosc_paliwa1').val(),
                    w_ilosc_adblue1: $('#w_ilosc_adblue1').val(), 
                    w_ilosc_ref1: $('#w_ilosc_ref1').val(), 
                    data_wydania1: $('#data_wydania1').val(), 
                    rodzaj1: $('#rodzaj1').val(),            
            
                    w_ilosc_paliwa2: $('#w_ilosc_paliwa2').val(),
                    w_ilosc_adblue2: $('#w_ilosc_adblue2').val(), 
                    w_ilosc_ref2: $('#w_ilosc_ref2').val(), 
                    data_wydania2: $('#data_wydania2').val(), 
                    rodzaj2: $('#rodzaj2').val(), 
                    
                    w_ilosc_paliwa3: $('#w_ilosc_paliwa3').val(),
                    w_ilosc_adblue3: $('#w_ilosc_adblue3').val(), 
                    w_ilosc_ref3: $('#w_ilosc_ref3').val(), 
                    data_wydania3: $('#data_wydania3').val(), 
                    rodzaj3: $('#rodzaj3').val(), 
                    
                    w_ilosc_paliwa4: $('#w_ilosc_paliwa4').val(),
                    w_ilosc_adblue4: $('#w_ilosc_adblue4').val(), 
                    w_ilosc_ref4: $('#w_ilosc_ref4').val(), 
                    data_wydania4: $('#data_wydania4').val(), 
                    rodzaj4: $('#rodzaj4').val(), 
                    
                    w_ilosc_paliwa5: $('#w_ilosc_paliwa5').val(),
                    w_ilosc_adblue5: $('#w_ilosc_adblue5').val(), 
                    w_ilosc_ref5: $('#w_ilosc_ref5').val(), 
                    data_wydania5: $('#data_wydania5').val(), 
                    rodzaj5: $('#rodzaj5').val()

                }})
                .done(function(res2) {
                    samochod: '';
            kierowca: '';
                    data_poczatek: '';
                    data_koniec: '';
                    przejechane_kilometry: '';
                    poprawne_kilometry: '';
                    poprawne_spalanie: '';
                    
                    w_ilosc_paliwa1: '';
                    w_ilosc_adblue1: '';
                    w_ilosc_ref1: '';
                    data_wydania1: '';
                    rodzaj1: '';
                    
                    w_ilosc_paliwa2: '';
                    w_ilosc_adblue2: '';
                    w_ilosc_ref2: '';
                    data_wydania2: '';
                    rodzaj2: '';
                    
                    w_ilosc_paliwa3: '';
                    w_ilosc_adblue3: '';
                    w_ilosc_ref3: '';
                    data_wydania3: '';
                    rodzaj3: '';
                    
                    w_ilosc_paliwa4: '';
                    w_ilosc_adblue4: '';
                    w_ilosc_ref4: '';
                    data_wydania4: '';
                    rodzaj4: '';
                    
                    w_ilosc_paliwa5: '';
                    w_ilosc_adblue5: '';
                    w_ilosc_ref5: '';
                    data_wydania5: '';
                    rodzaj5: '';
            location.reload();
                }); 
}
