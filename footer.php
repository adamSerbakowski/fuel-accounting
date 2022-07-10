<div class="stopka">
    
</div>


<div id="editPopUp">
    <div class="popUp__inner">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <p class="popup__header"></p>
        <div>
            <form onsubmit="submitEdit(event)">
                <input type="text" name="var" id="var" />
                <input onclick="sendEditForm()" type="submit" class="form-control mt-3" value="Zapisz" />
                <input type="button" onclick="exitEditForm()" class="form-control mt-3" value="Anuluj" />
            </form>
        </div>
    </div>
</div>

<div id="przypiszPopUp">
    <div class="popUp__inner">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <p class="popup__header"></p>
        <div>
            <form onsubmit="submitPrzypisz(event)">
                <input type="text" name="var" id="varP" list="numeryrejEdit"/>
                <datalist id="numeryrejEdit">
                                                             <?php $getSamochody = "SELECT * FROM samochody";
                        $samochody = $conn->query($getSamochody);
 foreach ($samochody as $row) : ?>
                                          <option data-id="<?= $row['id_samochod']; ?>" value="<?= $row['id_samochod']; ?>"><?= $row['nr_rejestracyjny']; ?></option>
                                          <?php endforeach; ?>
                                    </datalist>
                <input onclick="sendPrzypiszForm()" type="submit" class="form-control mt-3" value="Zapisz"/>
                
                <input type="button" onclick="exitPrzypiszForm()" class="form-control mt-3" value="Anuluj" />
            </form>
        </div>
    </div>
</div>


<div id="przypiszKierPopUp">
    <div class="popUp__inner">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <p class="popup__header"></p>
        <div>
            <form onsubmit="submitPrzypisz(event)">
                <input type="text" name="var" id="varK" list="nazwiskoEdit"/>
                <datalist id="nazwiskoEdit">
                                                             <?php $getKierowcy = "SELECT * FROM kierowcy";
                        $kierowcy = $conn->query($getKierowcy);
 foreach ($kierowcy as $row) : ?>
                                          <option data-id="<?= $row['id_kierowca']; ?>" value="<?= $row['id_kierowca']; ?>"><?= $row['nazwisko']; ?></option>
                                          <?php endforeach; ?>
                                    </datalist>
                <input onclick="sendPrzypiszFormKier()" type="submit" class="form-control mt-3" value="Zapisz"/>
                
                <input type="button" onclick="exitPrzypiszForm()" class="form-control mt-3" value="Anuluj" />
            </form>
        </div>
    </div>
</div>


    </body>
    
    
</html>