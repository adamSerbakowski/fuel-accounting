<?php 
    $kierowcy = $db->query("SELECT * FROM truck_drivers;");
    // $kierowcy = $conn->query($getKierowcy);

                        
    foreach ($kierowcy as $row) : 
        if ($row['aktywny'] !== 'archiwalny') :
        
        ?>
                            <div class="row">
                                <span>
                                    <?= $row['id_kierowca']; ?>
                                </span>

                                <span data-field="nazwisko" data-id="<?= $row['id_kierowca']; ?>" onclick="edit('nazwisko','<?= $row['id_kierowca']; ?>','kierowcy')"><?= $row['nazwisko']; ?></span>
                            <span data-field="aktywny" data-id="<?= $row['id_kierowca']; ?>" onclick="edit('aktywny','<?= $row['id_kierowca']; ?>','kierowcy')"><?= $row['aktywny']; ?></span>
                            <span data-field="data_rozliczenia" data-id="<?= $row['id_kierowca']; ?>" onclick="edit('data_rozliczenia','<?= $row['id_kierowca']; ?>','kierowcy')"><?= $row['data_rozliczenia']; ?></span>
                            </div>
                        
                        <?php 
                        endif;
                        endforeach; ?>

<p>Kierowcy archiwalni</p>

 <?php   foreach ($kierowcy as $row) : 
        if ($row['aktywny'] === 'archiwalny') :
        
        ?>
                            <div class="row">
                                <span>
                                    <?= $row['id_kierowca']; ?>
                                </span>

                                <span data-field="nazwisko" data-id="<?= $row['id_kierowca']; ?>" onclick="edit('nazwisko','<?= $row['id_kierowca']; ?>','kierowcy')"><?= $row['nazwisko']; ?></span>
                            <span data-field="aktywny" data-id="<?= $row['aktywny']; ?>" onclick="edit('aktywny','<?= $row['id_kierowca']; ?>','kierowcy')"><?= $row['aktywny']; ?></span>
                            <span data-field="data_rozliczenia" data-id="<?= $row['data_rozliczenia']; ?>" onclick="edit('data_rozliczenia','<?= $row['id_kierowca']; ?>','kierowcy')"><?= $row['data_rozliczenia']; ?></span>
                            </div>
                        
                        <?php 
                        endif;
                        endforeach;