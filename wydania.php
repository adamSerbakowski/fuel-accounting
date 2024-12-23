<?php include_once 'header.php'; ?>

<div class="col-12 col-md-12">
        <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                    <div class="wydania">
                        <h2>Tankowania paliwa</h2>
                        
                        <div class="row filtr filtr-wydanie">
                                <div class="col-3">
                                <form onsubmit="filtrujWydania">
                                    
                                    <p id="wybranySamochod">Filtruj po samochodzie</p>
                                
                                    <input id="samochodFi" name="samochodFiltr" list="samochodF" placeholder="Wybierz z listy">
                                    <datalist id="samochodF"> 
                  <?php $getSamochodyF = "SELECT DISTINCT id_samochod FROM wydania_paliwa";
                        $samochodyF = $conn->query($getSamochodyF); 
//                        $dostawcy = array_unique($dostawcyAll);
                        foreach ($samochodyF as $row) : 
                            $idFunkcji = $row['id_samochod'];
                                    $getNrRej = "SELECT nr_rejestracyjny FROM samochody WHERE id_samochod='$idFunkcji'";
        $nrRej = $conn->query($getNrRej);
                            foreach ($nrRej as $sub) :
                            ?>
                                <option value="<?= $row['id_samochod']; ?>"><?= $sub['nr_rejestracyjny']; ?></option>
                        <?php 
endforeach;
endforeach;
                        ?>
                                </datalist>
                                    </div>
                                <div class="col-3">
                                <p>Ustaw początek zakresu</p>
                                <input type="date" id="wydaniePoczatek" name="wydaniePoczatek">
                                </div>
                                <div class="col-3">
                                <p>Ustaw koniec zakresu</p>
                                <input type="date" id="wydanieKoniec" name="wydanieKoniec">
                                </div>
                                <div class="col-3">
                                <input type="submit" value="Filtruj">
                                </div>
                                </form>
                                
                                <a href="/">Wyczyść Filtry</a>
                            </div>
                        <div class="tabela col-12">
                            <div class="row table-head">
                                <span>ID</span>
                                <span>Samochód</span>
                                <span>Ilość paliwa</span>
                                <span>Ilość adblue</span>
                                <span>Ilość REF</span>
                                 <span>Data</span>
                                 <span>Miejsce wydania</span>
                            </div>
                            
                            <div class="row dodaj-wydanie">
                                
                                <form onsubmit="dodajWydanie(event)">
                                    <input type="submit" value="DODAJ">
                                    <input id="samochod" name="samochod" list="numeryrej" placeholder="Wybierz z listy">
                                    <datalist id="numeryrej">
                                                             <?php   $getSamochody2 = "SELECT * FROM samochody";
                        $samochody2 = $conn->query($getSamochody2);
 foreach ($samochody2 as $row) : ?>
                                          <option data-id="<?= $row['id_samochod']; ?>" value="<?= $row['id_samochod']; ?>"><?= $row['nr_rejestracyjny']; ?></option>
                                          <?php endforeach; ?>
                                    </datalist>
                                    <input type="text" id="w_ilosc_paliwa" name="w_ilosc_paliwa" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue" name="w_ilosc_adblue" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref" name="w_ilosc_ref" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania" name="data_wydania" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj" name="rodzaj" placeholder="Baza czy trasa" list="rodzaje">
                                    <datalist id="rodzaje">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                </form>
                                
                                
                                
                            </div>
                        
                             <?php include_once 'template/wydania.php'; ?>
                            
                    </div>
                        
                        
                        
                    </div>
                </div>

<?php include_once 'footer.php';