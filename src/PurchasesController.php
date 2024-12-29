<?php

namespace App;

use App\Controller;

class PurchasesController extends Controller
{
    public const URL = '\zakupy';

    public function getTemplate(): string
    {
        return 'purchases.twig';
    }

    public function getContent()
    {  
        $dostawcaFiltr = $_GET['dostawcaFiltr'] ?? '';
        $zakupPoczatek = $_GET['zakupPoczatek'] ?? '';
        $zakupKoniec = $_GET['zakupKoniec'] ?? '';
        
        $filteredList = $this->getFilters($dostawcaFiltr, $zakupPoczatek, $zakupKoniec);        
        
        return [
            'suppliers' => $this->getSuppliers(),
            'dostawcaFiltr' => $dostawcaFiltr,
            'zakupPoczatek' => $zakupPoczatek,
            'zakupKoniec' => $zakupKoniec,
            'purchases' => $filteredList['list'],
            'purchasesCount' => $filteredList['purchasesCount'],
            'fuelCount' => $filteredList['fuelCount'],
            'adblueCount' => $filteredList['adblueCount'],
        ];
    }

    private function getSuppliers()
    {
        $getDostawcy = "SELECT DISTINCT supplier FROM fuel_purchases";
        $dostawcy = $this->db->query($getDostawcy); 
        $list = [];
        foreach ($dostawcy as $row) :
            $list[] = $row['supplier'];
        endforeach;

        return $list;
    }

    private function getFilters($dostawcaFiltr, $zakupPoczatek, $zakupKoniec)
    {
        if ($zakupPoczatek =='' && $dostawcaFiltr =='' && $zakupKoniec =='' ) :
            $getZakupy = "SELECT * FROM fuel_purchases ORDER BY date DESC";
        else :
            $warunki = '';
            $count = 0;        
            if ($zakupKoniec !== '') :
                $warunki .= "date<'" . $zakupKoniec . "'";
                $count++;
            endif;

            if ($zakupPoczatek !== '') :
                if ($count > 0) :
                    $warunki .= " AND date>='" . $zakupPoczatek . "'";
                else :
                    $warunki .= "date>='" . $zakupPoczatek . "'";
                endif;
                $count++;
            endif;

            if ($dostawcaFiltr !== '') :
                if ($count > 0) :
                    $warunki .= " AND supplier='" . $dostawcaFiltr . "'";
                else :
                    $warunki .= "supplier='" . $dostawcaFiltr . "'";
                endif;
                $count++;
            endif;

        $getZakupy = "SELECT * FROM fuel_purchases WHERE $warunki ORDER BY date DESC";
        endif;

        $zakupyPaliwa = $this->db->query($getZakupy);
        $list = [];
        $liczbaZakupow = 0;
        $wSumieZakupPaliwo = 0;
        $wSumieZakupAdblue = 0;
        foreach ($zakupyPaliwa as $row) {
            $list[] = $row;
            $liczbaZakupow++;
            $wSumieZakupPaliwo += $row['fuel_qty'];
            $wSumieZakupAdblue += $row['adblue_qty'];
        }
        return [
            'list' => $list,
            'purchasesCount' => $liczbaZakupow,
            'fuelCount' => $wSumieZakupPaliwo,
            'adblueCount' => $wSumieZakupAdblue,
        ];
    }
}
