<?php include_once 'header.php'; ?>

<div class="col-12 col-md-12">
        <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                    <div class="samochody">
                        <h2>Samochody</h2>
                        
                        
                        <div class="tabela col-12">
                            <div class="row table-head">
                                <span>ID</span>
                                <span>Nr rejestracyjny</span>
                                <span>Wielkość zbiornika paliwa</span>
                                <span>Wielkość zbiornika adblue</span>
                            </div>
                            <div class="row dodaj-samochod">
                                <form onsubmit="dodajSamochod(event)">
                                    <input type="submit" value="DODAJ">
                                    <input type="text" id="nr_rejestracyjny" name="nazwisko">
                                    <input type="text" id="bak_paliwo" name="nazwisko">
                                    <input type="text" id="bak_adblue" name="nazwisko">
                                    
                                </form>
                                
                                
                                
                            </div>
                        <?php include_once 'template/samochody.php'; ?>

                    </div>
                        
                        
                    </div>
                    
                </div>

<?php include_once 'footer.php';