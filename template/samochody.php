<?php
 
                        $getSamochody3 = "SELECT * FROM samochody";
                        $samochody3 = $conn->query($getSamochody3);

                        
    foreach ($samochody3 as $row) : ?>
                            <div class="row">
                                <span>
                                    <?= $row['id_samochod']; ?>
                                </span>
                                     <span data-field="nr_rejestracyjny" data-id="<?= $row['id_samochod']; ?>" 
                                           onclick="edit('nr_rejestracyjny','<?= $row['id_samochod']; ?>','samochody')"
                                           ><?= $row['nr_rejestracyjny']; ?></span>

                                <span data-field="bak_paliwo" data-id="<?= $row['id_samochod']; ?>" 
                                           onclick="edit('bak_paliwo','<?= $row['id_samochod']; ?>','samochody')"
                                    ><?= $row['bak_paliwo']; ?></span>
                                <span data-field="bak_adblue" data-id="<?= $row['id_samochod']; ?>" 
                                           onclick="edit('bak_adblue','<?= $row['id_samochod']; ?>','samochody')"
                                    ><?= $row['bak_adblue']; ?></span>
                            </div>
                        
                        <?php 
                        
                        endforeach; ?>