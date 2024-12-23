<div class="container-fluid" id="dashboard">
                            <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="zakupy">
                        <h2>Zakupy paliwa</h2>
                        
                        <div class="tabela col-12">
                            <div class="row filtr filtr-zakupy">
                                <div class="col-3">
                                <form onsubmit="filtrujZakupy">
                                    
                                    <p id="wybranyDostawca">Filtruj po dostawcy</p>
                                
                                    <input id="dostawcaFi" name="dostawcaFiltr" list="dostawcaF">
                                    <datalist id="dostawcaF"> 
                  <?php $getDostawcy = "SELECT DISTINCT dostawca FROM zakupy_paliwa";
                        $dostawcy = $conn->query($getDostawcy); 
//                        $dostawcy = array_unique($dostawcyAll);
                        foreach ($dostawcy as $row) : ?>
                                <option value="<?= $row['dostawca']; ?>"></option>
                        <?php 
endforeach;
                        ?>
                                </datalist>
                                    </div>
                                <div class="col-3">
                                <p>Ustaw początek zakresu</p>
                                <input type="date" id="zakupPoczatek" name="zakupPoczatek">
                                </div>
                                <div class="col-3">
                                <p>Ustaw koniec zakresu</p>
                                <input type="date" id="zakupKoniec" name="zakupKoniec">
                                </div>
                                <div class="col-3">
                                    <p></p>
                                <input type="submit" value="Filtruj">
                                </div>
                                </form>
                                
                                <a href="/">Wyczyść Filtry</a>
                            </div>
                            <div class="row table-head">
                                <span>ID</span>
                                <span>Dostawca</span>
                                <span>Ilość paliwa</span>
                                <span>Ilość adblue</span>
                                 <span>Data</span>
                            </div>
                            
                            <div class="row dodaj-zakup">
                                <form onsubmit="dodajZakup(event)">
                                    <input type="submit" value="DODAJ">
                                    <input type="text" id="dostawca" name="dostawca">
                                    <input type="text" id="ilosc_paliwa" name="ilosc_paliwa">
                                    <input type="text" id="ilosc_adblue" name="ilosc_adblue">
                                    <input type="date" id="data_zakupu" name="data_zakupu">
                                    
                                </form>
                             </div>   
                             <?php include_once 'template/zakupy.php'; ?>   
                                
                            
                        </div>
                </div>
                    </div>
                <div class="col-12 col-md-6">
                    <div class="wydania">
                        <h2>Tankowania paliwa</h2>
                        
                        <div class="tabela col-12">
                            <div class="row filtr filtr-zakupy">
                                <div class="col-3">
                                <form onsubmit="filtrujWydania">
                                    
                                    <p id="wybranySamochod">Filtruj po dostawcy</p>
                                
                                    <input id="samochodFi" name="samochodFiltr" list="samochodF">
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
                                    <p></p>
                                <input type="submit" value="Filtruj">
                                </div>
                                </form>
                                
                                <a href="/">Wyczyść Filtry</a>
                            </div>
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
                                    <input id="samochod" name="samochod" list="numeryrej">
                                    <datalist id="numeryrej">
                                                             <?php   $getSamochody2 = "SELECT * FROM samochody";
                        $samochody2 = $conn->query($getSamochody2);
 foreach ($samochody2 as $row) : ?>
                                          <option data-id="<?= $row['id_samochod']; ?>" value="<?= $row['id_samochod']; ?>"><?= $row['nr_rejestracyjny']; ?></option>
                                          <?php endforeach; ?>
                                    </datalist>
                                    <input type="text" id="w_ilosc_paliwa" name="w_ilosc_paliwa">
                                    <input type="text" id="w_ilosc_adblue" name="w_ilosc_adblue">
                                    <input type="text" id="w_ilosc_ref" name="w_ilosc_ref">
                                    <input type="date" id="data_wydania" name="data_wydania">
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
                </div>
            
                
                
           
            
        </div>
