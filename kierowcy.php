<?php include_once 'header.php'; ?>

<div class="kierowcy">
        <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                        <h2>Kierowcy</h2>
                    
                    
                    
                    <div class="tabela col-12">
                            <div class="row table-head">
                                <span>ID</span>
                                <span>Nazwisko</span>
                                <span>Aktywny (wpisz archiwalny)</span>
                                <span>Data ostatniego rozliczenia</span>
                            </div>
                        <div class="row dodaj-kierowca">
                                <form onsubmit="dodajKierowca(event)">
                                    <input type="submit" value="DODAJ">
                                    <input type="text" id="nazwisko" name="nazwisko">
                                </form>
                                
                                
                                
                            </div>
                        <?php include_once 'template/kierowcy.php'; ?>

                    </div>
                    
                    </div>

<?php include_once 'footer.php';