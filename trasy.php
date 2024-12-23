<?php include_once 'header.php'; ?>

<div class="col-12 col-md-12">
    <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                    <div class="trasy">
                        <h2>Trasy</h2>
                        
                        
                        <div class="tabela col-12">
                            <div class="row table-head">
                                <span>ID</span>
                                <span>Samochód</span>
                                <span>Kierowca</span>
                                <span>Data początkowa</span>
                                 <span>Data końcowa</span>
                                 <span>Przejechane kilometry kierowcy</span>
                                 <span>Paliwo kierowca</span>
<!--                                 <span>Spalanie deklarowane adblue</span>-->
                                 <span>Kilometry system</span>
                                 <span>Paliwo system</span>
                                 <span>Spalanie l/100km kierowcy</span>
                                 <span>Spalanie l/100km system</span>
                                 <span>Różnica (l)</span>
                            </div>
                        
                            <div class="row dodaj-trasa">
                                <form onsubmit="dodajTrasa(event)">
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
                                    <input disabled></input>
<!--                                    <input disabled></input>-->
                                    <input type="text" id="poprawne_kilometry" name="poprawne_kilometry">
                                    <input type="text" id="poprawne_spalanie" name="poprawne_spalanie">
                                    
                                </form>
                             </div>   
                            
                            
                            <?php include_once 'template/trasy.php'; ?>
                    </div>
                        
                        
                    </div>
                </div>

<?php include_once 'footer.php';