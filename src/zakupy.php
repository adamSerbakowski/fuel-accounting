<?php include_once 'header.php'; ?>

<div class="container-fluid" id="zakupy">
            <div class="row">
                <div class="col-12">
                        <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                    <div class="zakupy">
                        <h2>Zakupy paliwa</h2>
                        
                        
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
                                <input type="submit" value="Filtruj">
                                </div>
                                </form>
                                
                                <a href="/">Wyczyść Filtry</a>
                            </div>
                        
                        <div class="tabela col-12">
                            <div class="row table-head">
                                <span>ID</span>
                                <span>Dostawca</span>
                                <span>Nr doumentu</span>
                                <span>Ilość paliwa</span>
                                <span>Ilość adblue</span>
                                 <span>Data</span>
                            </div>
                            
                            <div class="row dodaj-zakup">
                                <form onsubmit="dodajZakup(event)">
                                    <input type="submit" value="DODAJ">
                                    <input type="text" id="dostawca" name="dostawca">
                                    <input type="text" id="nr_dokumentu" name="nr_dokumentu">
                                    <input type="text" id="ilosc_paliwa" name="ilosc_paliwa">
                                    <input type="text" id="ilosc_adblue" name="ilosc_adblue">
                                    <input type="date" id="data_zakupu" name="data_zakupu">
                                    
                                </form>
                             </div>   
                             <?php include_once 'template/zakupy.php'; ?>   
                                
                            
                        </div>
                </div>
                     </div>
                 </div>
     </div>

<?php include_once 'footer.php';