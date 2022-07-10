<?php include_once 'header.php'; ?>
<?php 


 $samochodFiltr = $_GET['samochodFiltr'];
//$dostawcaFiltr = 'd3';
$wydaniePoczatek = $_GET['wydaniePoczatek'];
$wydanieKoniec = $_GET['wydanieKoniec'];
if ($wydaniePoczatek =='' && $samochodFiltr =='' && $wydanieKoniec =='' ) :
    $getWydania = "SELECT * FROM wydania_paliwa "
                                        . "INNER JOIN samochody ON wydania_paliwa.id_samochod = samochody.id_samochod "
                                        . "ORDER BY data_wydania DESC;";
else :
$warunki = '';
$count = 0;        
if ($wydanieKoniec !== '') :
        $warunki .= "data_wydania<'" . $wydanieKoniec . "'";
        $count++;
    endif;
    if ($wydaniePoczatek !== '') :
        if ($count > 0) :
            $warunki .= " AND data_wydania>='" . $wydaniePoczatek . "'";
        else :
            $warunki .= "data_wydania>='" . $wydaniePoczatek . "'";
        endif;
        $count++;
    endif;
    if ($samochodFiltr !== '') :
        if ($count > 0) :
            $warunki .= " AND id_samochod='" . $samochodFiltr . "'";
        else :
            $warunki .= "id_samochod='" . $samochodFiltr . "'";
        endif;

        $count++;
    endif;




                        $getWydania =     "SELECT * FROM wydania_paliwa "
                                        . "WHERE $warunki "
                                        . "ORDER BY data_wydania DESC;";
                        endif;
                        
                        $wydaniaPaliwa = $conn->query($getWydania);
                        
                        
$liczbaWydan = 0;
$wSumieWydanePaliwo = 0;
$wSumieWydaneAdblue = 0;
                      //  echo $getWydania;


if ($wydaniePoczatek =='' && $samochodFiltr =='' && $wydanieKoniec =='' ) :
else : ?>
<div class="row">
    <div class="col-4">
    Aktywne filtry:<br>
    <?php if ($samochodFiltr !== '') : ?>
    Samochód: <?= $samochodFiltr ?> <br>
    <?php endif; ?>
    </div>
    <div class="col-4">
    <?php if ($wydaniePoczatek !== '') : ?>
    Data początkowa: <?= $wydaniePoczatek ?> <br>
    <?php endif; ?>
    </div>
    <div class="col-4">
    <?php if ($wydanieKoniec !== '') : ?>
    Data końcowa: <?= $wydanieKoniec ?> <br>
    <?php endif; ?>
    </div>
</div>
                     <?php 
                     endif;


    foreach ($wydaniaPaliwa as $row) : ?>
                            <div class="row">
                                <span>
                                    <?= $row['id_wydanie']; ?>
                                </span>
                                
                                <span data-field="id_samochod" data-id="<?= $row['id_wydanie']; ?>" data-tab="wydania_paliwa" onclick="przypisz('id_samochod','<?= $row['id_wydanie']; ?>','wydania_paliwa')"><?php  
                               $idFunkcji2 = $row['id_samochod'];
                               $getNrRej2 = "SELECT nr_rejestracyjny FROM samochody WHERE id_samochod='$idFunkcji2'";
        $nrRej2 = $conn->query($getNrRej2);
                            foreach ($nrRej2 as $sub2) :
                            ?><?= $sub2['nr_rejestracyjny']; ?><?php 
endforeach;
                                ?></span>

                                <span data-field="w_ilosc_paliwa" data-id="<?= $row['id_wydanie']; ?>"
                                      onclick="edit('w_ilosc_paliwa','<?= $row['id_wydanie']; ?>','wydania_paliwa')"
                                      ><?= $row['w_ilosc_paliwa']; ?></span>
                                <span data-field="w_ilosc_adblue" data-id="<?= $row['id_wydanie']; ?>"
                                      onclick="edit('w_ilosc_adblue','<?= $row['id_wydanie']; ?>','wydania_paliwa')"
                                      ><?= $row['w_ilosc_adblue']; ?></span>
                                <span data-field="w_ilosc_ref" data-id="<?= $row['id_wydanie']; ?>"
                                      onclick="edit('w_ilosc_ref','<?= $row['id_wydanie']; ?>','wydania_paliwa')"
                                      ><?= $row['w_ilosc_ref']; ?></span>
                                    <span data-field="data_wydania" data-id="<?= $row['id_wydanie']; ?>"
                                      onclick="edit('data_wydania','<?= $row['id_wydanie']; ?>','wydania_paliwa')"
                                      ><?= $row['data_wydania']; ?></span>
                                <span data-field="rodzaj" data-id="<?= $row['id_wydanie']; ?>"
                                      onclick="edit('rodzaj','<?= $row['id_wydanie']; ?>','wydania_paliwa')"
                                      ><?= $row['rodzaj']; ?></span>
                                
                            </div>
                        
                        <?php 
                        $liczbaWydan++;
                        $wSumieWydanePaliwo += $row['w_ilosc_paliwa'];
                        $wSumieWydaneAdblue += $row['w_ilosc_adblue'];
                        
                        endforeach; ?>
                            <div class="row suma">
                                <span>Liczba wydań: <?= $liczbaWydan; ?></span>
                                <span>Ilość paliwa w sumie: <?= $wSumieWydanePaliwo; ?></span>
                                <span>Ilość adBlue w sumie: <?= $wSumieWydaneAdblue; ?></span>

                            </div>