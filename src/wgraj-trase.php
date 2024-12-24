<?php include_once 'header.php'; ?>

<div class="col-12 col-md-12">
    <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                    <div class="trasy">
                        <h2>Dodaj Trasę</h2>
                        <div class="col-12">
                                                    <div class="row table-head">
                                <span>ID</span>
                                <span>Samochód</span>
                                <span>Kierowca</span>
                                <span>Data początkowa</span>
                                 <span>Data końcowa</span>
                                 <span>Przejechane kilometry kierowcy</span>
                                 <span>Kilometry system</span>
                                 <span>Paliwo system</span>
                            </div></div>
<form onsubmit="dodajTrasaCala(event)">
                                    <input type="submit" value="DODAJ">
                                    <input id="samochod" name="samochod" list="numeryrej" placeholder="Wybierz z listy">
                                    <datalist id="numeryrej">
                                                             <?php   $getSamochody2 = "SELECT * FROM samochody";
                        $samochody2 = $conn->query($getSamochody2);
 foreach ($samochody2 as $row) : ?>
                                          <option data-id="<?= $row['id_samochod']; ?>" value="<?= $row['id_samochod']; ?>"><?= $row['nr_rejestracyjny']; ?></option>
                                          <?php endforeach; ?>
                                    </datalist>
                                    <input type="text" id="kierowca" name="kierowca" list="trasakierowca">
                <datalist id="trasakierowca">
                                                             <?php $getKierowcy = "SELECT * FROM kierowcy";
                        $kierowcy = $conn->query($getKierowcy);
 foreach ($kierowcy as $row) : ?>
                                          <option data-id="<?= $row['id_kierowca']; ?>" value="<?= $row['id_kierowca']; ?>"><?= $row['nazwisko']; ?></option>
                                          <?php endforeach; ?>
                                    </datalist>
                                    <input type="date" id="data_poczatek" name="data_poczatek">
                                    <input type="date" id="data_koniec" name="data_koniec">
                                    <input type="text" id="przejechane_kilometry" name="przejechane_kilometry">
                                    <input type="text" id="poprawne_kilometry" name="poprawne_kilometry">
                                    <input type="text" id="poprawne_spalanie" name="poprawne_spalanie">
                                    <br>
                                    <h4>Tankowanie do trasy 1</h4>
                                    <input type="text" id="w_ilosc_paliwa1" name="w_ilosc_paliwa1" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue1" name="w_ilosc_adblue1" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref1" name="w_ilosc_ref1" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania1" name="data_wydania1" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj1" name="rodzaj1" placeholder="Baza czy trasa" list="rodzaje1">
                                    <datalist id="rodzaje1">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                    <h4>Tankowanie do trasy 2</h4>
                                    <input type="text" id="w_ilosc_paliwa2" name="w_ilosc_paliwa" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue2" name="w_ilosc_adblue" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref2" name="w_ilosc_ref" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania2" name="data_wydania" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj2" name="rodzaj" placeholder="Baza czy trasa" list="rodzaje2">
                                    <datalist id="rodzaje2">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                    <h4>Tankowanie do trasy 3</h4>
                                    <input type="text" id="w_ilosc_paliwa3" name="w_ilosc_paliwa" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue3" name="w_ilosc_adblue" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref3" name="w_ilosc_ref" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania3" name="data_wydania" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj3" name="rodzaj" placeholder="Baza czy trasa" list="rodzaje3">
                                    <datalist id="rodzaje3">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                    <h4>Tankowanie do trasy 4</h4>
                                    <input type="text" id="w_ilosc_paliwa4" name="w_ilosc_paliwa" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue4" name="w_ilosc_adblue" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref4" name="w_ilosc_ref" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania4" name="data_wydania" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj4" name="rodzaj" placeholder="Baza czy trasa" list="rodzaje4">
                                    <datalist id="rodzaje4">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                    <h4>Tankowanie do trasy 5</h4>
                                    <input type="text" id="w_ilosc_paliwa5" name="w_ilosc_paliwa" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue5" name="w_ilosc_adblue" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref5" name="w_ilosc_ref" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania5" name="data_wydania" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj5" name="rodzaj" placeholder="Baza czy trasa" list="rodzaje5">
                                    <datalist id="rodzaje5">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                </form>                        
                        

                                    
                        
                                            </div>
                </div>

<?php include_once 'footer.php';