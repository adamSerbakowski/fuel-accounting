<?php 
                        $getTrasy = "SELECT * FROM trasy "
                                . "INNER JOIN kierowcy ON trasy.id_kierowca = kierowcy.id_kierowca "
                                . "INNER JOIN samochody ON trasy.id_samochod = samochody.id_samochod "
                                . "ORDER BY data_poczatek DESC;";
                        $trasy = $conn->query($getTrasy);
$liczbaTras = 0;
                        
    foreach ($trasy as $row) : 
        $samochod = $row['id_samochod'];
    $data_poczatek = $row['data_poczatek'];
    $data_koniec = $row['data_koniec'];
        ?>

                            <div class="row">
                                <span>
                                    <?= $row['id_trasa']; ?>
                                </span>
                                <span data-field="id_samochod" data-id="<?= $row['id_trasa']; ?>" data-tab="trasy" onclick="przypisz('id_samochod','<?= $row['id_trasa']; ?>','trasy')"><?= $row['nr_rejestracyjny']; ?></span>
                                <span data-field="id_kierowca" data-id="<?= $row['id_trasa']; ?>" data-tab="trasy" 
                                      onclick="przypiszKier('id_kierowca','<?= $row['id_trasa']; ?>','trasy')"><?= $row['nazwisko']; ?></span>
                                <span data-field="data_poczatek" data-id="<?= $row['id_trasa']; ?>"
                                      onclick="edit('data_poczatek','<?= $row['id_trasa']; ?>','trasy')"
                                      ><?= $data_poczatek; ?></span>
                                <span data-field="data_koniec" data-id="<?= $row['id_trasa']; ?>"
                                      onclick="edit('data_koniec','<?= $row['id_trasa']; ?>','trasy')"
                                      ><?= $data_koniec; ?></span>
                                <span data-field="przejechane_kilometry" data-id="<?= $row['id_trasa']; ?>"
                                      onclick="edit('przejechane_kilometry','<?= $row['id_trasa']; ?>','trasy')"
                                      ><?= $row['przejechane_kilometry']; ?></span>
                                    <?php 
                                    $spalaniep = 0;
                                    $spalaniea = 0;
                                    $getPasujaceWydania = "SELECT * FROM wydania_paliwa WHERE id_samochod='$samochod' AND data_wydania>='$data_poczatek' AND data_wydania<='$data_koniec'";
                                    $pasujaceWydania = $conn->query($getPasujaceWydania);
                                    foreach ($pasujaceWydania as $row2) : 
                                       
                                    $spalaniep += $row2['w_ilosc_paliwa'];
                                    $spalaniea += $row2['w_ilosc_adblue'];
                                        
                                    endforeach;
                                    
                                    ?>
                                <span>
                                    <?= $spalaniep; ?>
                                </span>
<!--                                <span>
                                    <?php // $spalaniea; ?>
                                </span>-->
                                <span data-field="poprawne_kilometry" data-id="<?= $row['id_trasa']; ?>"
                                      onclick="edit('poprawne_kilometry','<?= $row['id_trasa']; ?>','trasy')"
                                      ><?= $row['poprawne_kilometry']; ?></span>
                                <span data-field="poprawne_spalanie" data-id="<?= $row['id_trasa']; ?>"
                                      onclick="edit('poprawne_spalanie','<?= $row['id_trasa']; ?>','trasy')"
                                      ><?= $row['poprawne_spalanie']; ?></span>
                                <span>
                                    <?php 
                                    $spalanieD100 = $spalaniep / ($row['przejechane_kilometry'] / 100);
                                    ?>
                                    <?= round($spalanieD100,2); ?>
                                </span>
                                <span>
                                    <?php 
                                    $spalanieP100 = $row['poprawne_spalanie'] / ($row['poprawne_kilometry'] / 100);
                                    ?>
                                    <?= round($spalanieP100,2); ?>
                                </span>
                                <span>
                                    <?= round($row['poprawne_spalanie'] - $spalaniep,2); ?>
<?php //($spalaniep - $row['poprawne_spalanie'])/$row['poprawne_spalanie']*100 .'%'; ?>
                                </span>
                            </div>
                        
                        <?php 
                        $liczbaTras++;
                        
                        endforeach; ?>
                            <div class="row suma">
                                <span>Liczba tras: <?= $liczbaTras; ?></span>

                            </div>