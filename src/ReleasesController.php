<?php

namespace App;

use App\Controller;

class ReleasesController extends Controller
{
    public const URL = '\wydania';

    public function getTemplate(): string
    {
        return 'releases.twig';
    }

    public function getContent()
    {
        $samochodFiltr = $_GET['samochodFiltr'] ?? '';
        $wydaniePoczatek = $_GET['wydaniePoczatek'] ?? '';
        $wydanieKoniec = $_GET['wydanieKoniec'] ?? '';
        
        $filteredList = $this->getFilteredList($samochodFiltr, $wydaniePoczatek, $wydanieKoniec);   

        return [
            'releaseCars' => $this->getSamochodyWydania(),
            'samochodFiltr' => $samochodFiltr,
            'wydaniePoczatek' => $wydaniePoczatek,
            'wydanieKoniec' => $wydanieKoniec,
            'releases' => $filteredList['list'],
            'liczbaWydan' => $filteredList['liczbaWydan'],
            'wSumieWydanePaliwo' => $filteredList['wSumieWydanePaliwo'],
            'wSumieWydaneAdblue' => $filteredList['wSumieWydaneAdblue'],
        ];
    }

    private function getSamochodyWydania()
    {
        $list = [];
        $getSamochodyF = "SELECT DISTINCT id_car FROM fuel_releases";
        $samochodyF = $this->db->query($getSamochodyF); 
        foreach ($samochodyF as $row) : 
            $idFunkcji = $row['id_car'];
            $getNrRej = "SELECT registration_nb FROM cars WHERE id='$idFunkcji'";
            $nrRej = $this->db->query($getNrRej);
            foreach ($nrRej as $sub) :
                $list[] = [
                    'carId' => $row['id_car'],
                    'registrationNb' => $sub['registration_nb'],
                ];
            endforeach;
        endforeach;

        return $list;
    }

    private function getFilteredList($samochodFiltr, $wydaniePoczatek, $wydanieKoniec)
    {
        if ($wydaniePoczatek =='' && $samochodFiltr =='' && $wydanieKoniec =='' ) :
            $getWydania = "SELECT * FROM fuel_releases "
                . "INNER JOIN cars ON fuel_releases.id_car = cars.id "
                . "ORDER BY date DESC;";
        else :
            $warunki = '';
            $count = 0;        
            if ($wydanieKoniec !== '') :
                $warunki .= "date<'" . $wydanieKoniec . "'";
                $count++;
            endif;
            if ($wydaniePoczatek !== '') :
                if ($count > 0) :
                    $warunki .= " AND date>='" . $wydaniePoczatek . "'";
                else :
                    $warunki .= "date>='" . $wydaniePoczatek . "'";
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
        $list = [];
        foreach ($wydaniaPaliwa as $row) :
            $list[] = $row;
            $liczbaWydan++;
            $wSumieWydanePaliwo += $row['released_fuel_qty'];
            $wSumieWydaneAdblue += $row['released_adblue_qty'];
        endforeach;

        return [
            'list' => $list,
            'liczbaWydan' => $liczbaWydan,
            'wSumieWydanePaliwo' => $wSumieWydanePaliwo,
            'wSumieWydaneAdblue' => $wSumieWydaneAdblue,
        ];
    }
}
