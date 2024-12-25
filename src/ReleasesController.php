<?php

namespace App;

use App\Controller;

class ReleasesController extends Controller
{
    public function renderContent()
    {
        return '
        <div class="col-12 col-md-12">
        <div>
    Odśwież stronę aby zobaczyć aktualne dane.
</div>
                    <div class="wydania">
                        <h2>Tankowania paliwa</h2>
                        
                        <div class="row filtr filtr-wydanie">
                                <div class="col-3">
                                <form onsubmit="filtrujWydania">
                                    
                                    <p id="wybranySamochod">Filtruj po samochodzie</p>
                                
                                    <input id="samochodFi" name="samochodFiltr" list="samochodF" placeholder="Wybierz z listy">
                                    <datalist id="samochodF">'.$this->getSamochodyWydania().'

                                </datalist>
                                    </div>
                                <div class="col-3">
                                <p>Ustaw początek zakresu</p>
                                <input type="date" id="wydaniePoczatek" name="wydaniePoczatek">
                                </div>
                                <div class="col-3">
                                <p>Ustaw koniec zakresu</p>
                                <input type="date" id="wydanieKoniec" name="wydanieKoniec">
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
                                <span>Samochód</span>
                                <span>Ilość paliwa</span>
                                <span>Ilość adblue</span>
                                <span>Ilość REF</span>
                                 <span>Data</span>
                                 <span>Miejsce wydania</span>
                            </div>
                            
                            <div class="row dodaj-wydanie">
                                
                                <form onsubmit="dodajWydanie(event)">
                                    <input type="submit" value="DODAJ">
                                    <input id="samochod" name="samochod" list="numeryrej" placeholder="Wybierz z listy">
                                    <datalist id="numeryrej">
                                        '. $this->getAllCars() .'
                                    </datalist>
                                    <input type="text" id="w_ilosc_paliwa" name="w_ilosc_paliwa" placeholder="Wpisz ilość paliwa">
                                    <input type="text" id="w_ilosc_adblue" name="w_ilosc_adblue" placeholder="Wpisz ilość adblue">
                                    <input type="text" id="w_ilosc_ref" name="w_ilosc_ref" placeholder="Wpisz ilość REF">
                                    <input type="date" id="data_wydania" name="data_wydania" placeholder="Wybierz datę">
                                    <input type="text" id="rodzaj" name="rodzaj" placeholder="Baza czy trasa" list="rodzaje">
                                    <datalist id="rodzaje">
                                        <option value="baza">baza</option>
                                        <option value="E100">E100</option>
                                        <option value="inne">inne</option>
                                        </datalist>
                                </form>
                                
                                
                                
                            </div>
                            '.$this->getFilteredList().'
                            
                    </div>
                        
                        
                        
                    </div>
                </div>
        ';
    }

    private function getSamochodyWydania()
    {
        $html = '';
        $getSamochodyF = "SELECT DISTINCT id_car FROM fuel_releases";
        $samochodyF = $this->db->query($getSamochodyF); 
        foreach ($samochodyF as $row) : 
            $idFunkcji = $row['id_car'];
            $getNrRej = "SELECT registration_nb FROM cars WHERE id_car='$idFunkcji'";
            $nrRej = $this->db->query($getNrRej);
            foreach ($nrRej as $sub) :
                $html .= "<option value='{$row['id_car']}'>{$sub['registration_nb']}</option>";
            endforeach;
        endforeach;

        return $html;
    }

    private function getAllCars()
    {
        $html = '';
        $getSamochody2 = "SELECT * FROM cars";
        $samochody2 = $this->db->query($getSamochody2);
        foreach ($samochody2 as $row) :
            $html .= "<option data-id='{$row['id']}' value='{$row['id']}'>{$row['registration_nb']}</option>";
        endforeach;

        return $html;
    }

    private function getFilteredList()
    {
        $html = '';
        $samochodFiltr = $_GET['samochodFiltr'] ?? '';
        $wydaniePoczatek = $_GET['wydaniePoczatek'] ?? '';
        $wydanieKoniec = $_GET['wydanieKoniec'] ?? '';

        echo $samochodFiltr;
        echo $wydaniePoczatek;
        echo $wydanieKoniec;
        if ($wydaniePoczatek =='' && $samochodFiltr =='' && $wydanieKoniec =='' ) :
            $getWydania = "SELECT * FROM fuel_releases "
                . "INNER JOIN cars ON fuel_releases.id_car = cars.id "
                . "ORDER BY date DESC;";
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
                    $warunki .= " AND id_car='" . $samochodFiltr . "'";
                else :
                    $warunki .= "id_car='" . $samochodFiltr . "'";
                endif;
        
                $count++;
            endif;

            $getWydania =     "SELECT * FROM fuel_releases "
                . "WHERE $warunki "
                . "ORDER BY date DESC;";
        endif;
                                
        $wydaniaPaliwa = $this->db->query($getWydania);
        $liczbaWydan = 0;
        $wSumieWydanePaliwo = 0;
        $wSumieWydaneAdblue = 0;
        
        if ($wydaniePoczatek =='' && $samochodFiltr =='' && $wydanieKoniec =='' ) :
        else :
            $html .= "<div class='row'>
                <div class='col-4'>
                Aktywne filtry:<br>";
            if ($samochodFiltr !== '') :
                $html .= "Samochód: {$samochodFiltr} <br>";
            endif;
            $html .= "</div>
            <div class='col-4'>";
            if ($wydaniePoczatek !== '') :
                $html .= "Data początkowa: {$wydaniePoczatek} <br>";
            endif;
                $html .= "</div>
            <div class='col-4'>";
            if ($wydanieKoniec !== '') :
                $html .= "Data końcowa: {$wydanieKoniec} <br>";
            endif;
            $html .= "</div>
            </div>";
        endif;
        
        foreach ($wydaniaPaliwa as $row) :
            $html .= "<div class='row'>
                <span>
                    {$row['id_wydanie']}
                </span>
                <span data-field='id_samochod' data-id='{$row['id_wydanie']}' data-tab='wydania_paliwa' onclick='przypisz(`id_samochod`,`{$row['id_wydanie']}`,`wydania_paliwa`)'>";

            $idFunkcji2 = $row['id_car'];
            $getNrRej2 = "SELECT registration_nb FROM cars WHERE id_car='{$idFunkcji2}'";
            $nrRej2 = $this->db->query($getNrRej2);
            foreach ($nrRej2 as $sub2) :
                $html .= $sub2['registration_nb']; 
            endforeach;
            
            $html .= "</span>
                <span data-field='w_ilosc_paliwa' data-id='{$row['id_wydanie']}'
                        onclick='edit(`w_ilosc_paliwa`,`{$row['id_wydanie']}`,`wydania_paliwa`)'
                        >{$row['w_ilosc_paliwa']}</span>
                <span data-field='w_ilosc_adblue' data-id='{$row['id_wydanie']}'
                        onclick='edit(`w_ilosc_adblue`,`{$row['id_wydanie']}`,`wydania_paliwa`)'
                        >{$row['w_ilosc_adblue']}</span>
                <span data-field='w_ilosc_ref' data-id='{$row['id_wydanie']}'
                        onclick='edit(`w_ilosc_ref`,`{$row['id_wydanie']}`,`wydania_paliwa`)'
                        >{$row['w_ilosc_ref']}</span>
                    <span data-field='data_wydania' data-id='{$row['id_wydanie']}'
                        onclick='edit(`data_wydania`,`{$row['id_wydanie']}`,`wydania_paliwa`)'
                        >{$row['date']}</span>
                <span data-field='rodzaj' data-id='{$row['id_wydanie']}'
                        onclick='edit(`rodzaj`,`{$row['id_wydanie']}`,`wydania_paliwa`)'
                        >{$row['rodzaj']}</span>
            </div>";

                $liczbaWydan++;
                $wSumieWydanePaliwo += $row['w_ilosc_paliwa'];
                $wSumieWydaneAdblue += $row['w_ilosc_adblue'];
            endforeach;

            $html .= "<div class='row suma'>
                <span>Liczba wydań: {$liczbaWydan}</span>
                <span>Ilość paliwa w sumie: {$wSumieWydanePaliwo}</span>
                <span>Ilość adBlue w sumie: {$wSumieWydaneAdblue}</span>
            </div>";

        return $html;
    }
}
