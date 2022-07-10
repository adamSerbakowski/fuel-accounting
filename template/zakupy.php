<?php 

 $dostawcaFiltr = $_GET['dostawcaFiltr'];
//$dostawcaFiltr = 'd3';
$zakupPoczatek = $_GET['zakupPoczatek'];
$zakupKoniec = $_GET['zakupKoniec'];
if ($zakupPoczatek =='' && $dostawcaFiltr =='' && $zakupKoniec =='' ) :
    $getZakupy = "SELECT * FROM zakupy_paliwa ORDER BY data DESC";
else :
$warunki = '';
$count = 0;        
if ($zakupKoniec !== '') :
        $warunki .= "data<'" . $zakupKoniec . "'";
        $count++;
    endif;
    if ($zakupPoczatek !== '') :
        if ($count > 0) :
            $warunki .= " AND data>='" . $zakupPoczatek . "'";
        else :
            $warunki .= "data>='" . $zakupPoczatek . "'";
        endif;
        $count++;
    endif;
    if ($dostawcaFiltr !== '') :
        if ($count > 0) :
            $warunki .= " AND dostawca='" . $dostawcaFiltr . "'";
        else :
            $warunki .= "dostawca='" . $dostawcaFiltr . "'";
        endif;

        $count++;
    endif;


    $getZakupy = "SELECT * FROM zakupy_paliwa WHERE $warunki ORDER BY data DESC";
   // $getZakupy = "SELECT * FROM zakupy_paliwa WHERE dostawca='$dostawcaFiltr' ORDER BY data DESC";
endif;
                        //$getZakupy = "SELECT * FROM zakupy_paliwa WHERE data_zakupu>'$zakupPoczatek' ORDER BY data DESC";
                        $zakupyPaliwa = $conn->query($getZakupy);
$liczbaZakupow = 0;
$wSumieZakupPaliwo = 0;
$wSumieZakupAdblue = 0;
                        
if ($zakupPoczatek =='' && $dostawcaFiltr =='' && $zakupKoniec =='' ) :
else : ?>
<div class="row">
    <div class="col-4">
    Aktywne filtry:<br>
    <?php if ($dostawcaFiltr !== '') : ?>
    Dostawca: <?= $dostawcaFiltr ?> <br>
    <?php endif; ?>
    </div>
    <div class="col-4">
    <?php if ($zakupPoczatek !== '') : ?>
    Data początkowa: <?= $zakupPoczatek ?> <br>
    <?php endif; ?>
    </div>
    <div class="col-4">
    <?php if ($zakupKoniec !== '') : ?>
    Data końcowa: <?= $zakupKoniec ?> <br>
    <?php endif; ?>
    </div>
</div>
                     <?php 
                     endif;
    foreach ($zakupyPaliwa as $row) : ?>
                            <div class="row">
                                <span>
                                    <?= $row['id_zakup']; ?>
                                </span>
                                <span data-field="dostawca" data-id="<?= $row['id_zakup']; ?>"
                                      onclick="edit('dostawca','<?= $row['id_zakup']; ?>','zakupy_paliwa')"><?= $row['dostawca']; ?></span>
                                <span dara-field="nr_dokumenru" dadta-id="<?= $row['id_zakup']; ?>"
                                      onclick="edit('nr_dokumentu','<?= $row['id_zakup']; ?>','zakupy_paliwa')"><?= $row['nr_dokumentu']; ?></span>
                                <span data-field="ilosc_paliwa" data-id="<?= $row['id_zakup']; ?>"
                                      onclick="edit('ilosc_paliwa','<?= $row['id_zakup']; ?>','zakupy_paliwa')"
                                      ><?= $row['ilosc_paliwa']; ?></span>
                                <span data-field="ilosc_adblue" data-id="<?= $row['id_zakup']; ?>"
                                      onclick="edit('ilosc_adblue','<?= $row['id_zakup']; ?>','zakupy_paliwa')"
                                      ><?= $row['ilosc_adblue']; ?></span>
                                <span data-field="data" data-id="<?= $row['id_zakup']; ?>"
                                      onclick="edit('data','<?= $row['id_zakup']; ?>','zakupy_paliwa')"
                                      ><?= $row['data']; ?></span>
                            </div>
                        
                        <?php 
                        $liczbaZakupow++;
                        $wSumieZakupPaliwo += $row['ilosc_paliwa'];
                        $wSumieZakupAdblue += $row['ilosc_adblue'];
                        
                        endforeach; ?>
                            <div class="row suma">
                                <span>Liczba zakupów: <?= $liczbaZakupow; ?></span>
                                <span>Ilość paliwa w sumie: <?= $wSumieZakupPaliwo; ?></span>
                                <span>Ilość adBlue w sumie: <?= $wSumieZakupAdblue; ?></span>

                            </div>

