<?php

namespace App\Services;

use App\DB;

class UpdateService
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function add($data)
    {
        switch ($data['type']) {
            case 'addCar':
                $this->addCar($data);
                break;
            case 'addDriver':
                $this->addDriver($data);
                break;
            case 'addPurchase':
                $this->addPurchase($data);
                break;
            case 'addDelivery':
                $this->addDelivery($data);
                break;
            case 'addAggregatedDelivery':
                $this->addAggregatedDelivery($data);
                break;
            case 'addRelease':
                $this->addRelease($data);
                break;
            case 'updateField':
                $this->updateField($data);
                break;
            default:
                // add exception
                return;
        }
    }

    private function addDriver($data) {
        if ($data['nazwisko'] && is_string($data['nazwisko'])) {
            $qry = $this->db->prepare("INSERT INTO truck_drivers (name) VALUES (?)");
            $qry->execute(array($data['nazwisko']));
        }
    }

    private function addCar($data) {
        $registration_nb = $data['nr_rejestracyjny'];
        $fuel_tank = $data['bak_paliwo'];
        $adblue_tank = $data['bak_adblue'];

        if ($registration_nb) {
            $qry = $this->db->prepare("INSERT INTO cars (registration_nb, fuel_tank, adblue_tank) VALUES (?,?,?)");
            $qry->execute(array($registration_nb, $fuel_tank, $adblue_tank));
        }
    }

    private function addPurchase($data) {
        $dostawca = $data['dostawca'];
        $nr_dokumentu = $data['nr_dokumentu'];
        $ilosc_paliwa = $data['ilosc_paliwa'];
        $ilosc_adblue = $data['ilosc_adblue'];
        $data_zakupu = $data['data_zakupu'];

        $qry = $this->db->prepare("INSERT INTO fuel_purchases (supplier, document_number, fuel_qty, adblue_qty, date) VALUES (?,?,?,?,?)");
        $qry->execute(array($dostawca, $nr_dokumentu, $ilosc_paliwa, $ilosc_adblue, $data_zakupu));
    }

    private function addRelease($data) {
        $samochod = $data['samochod'];
        $w_ilosc_paliwa = $data['w_ilosc_paliwa'];
        $w_ilosc_adblue = $data['w_ilosc_adblue'];
        $w_ilosc_ref = $data['w_ilosc_ref'];
        $data_wydania = $data['data_wydania'];
        $rodzaj = $data['rodzaj'];

        $qry = $this->db->prepare("INSERT INTO fuel_releases (id_car, released_fuel_qty, released_adblue_qty, released_ref_qty, date, type) VALUES (?,?,?,?,?,?)");
        $qry->execute(array($samochod, $w_ilosc_paliwa, $w_ilosc_adblue,$w_ilosc_ref, $data_wydania, $rodzaj));
    }

    private function addDelivery($data) {
        $samochod = $data['samochod'];
        $kierowca = $data['kierowca'];
        $data_poczatek = $data['data_poczatek'];
        $data_koniec = $data['data_koniec'];
        $przejechane_kilometry = $data['przejechane_kilometry'];
        $poprawne_kilometry = $data['poprawne_kilometry'];
        $poprawne_spalanie = $data['poprawne_spalanie'];

        $qry = $this->db->prepare("INSERT INTO deliveries (id_car, id_driver, start_date, end_date, route_length, optimal_route_length, optimal_fuel_consumption) VALUES (?,?,?,?,?,?,?)");
        $qry->execute(array($samochod, $kierowca, $data_poczatek, $data_koniec, $przejechane_kilometry, $poprawne_kilometry, $poprawne_spalanie));
    }

    private function addAggregatedDelivery($data) {
        $this->addDelivery($data);
        foreach ($data['purchases'] as $purchase) {

            // temporary soft validation

            if ($purchase['w_ilosc_paliwa']) {
                $purchaseData = array_merge($purchase, ['samochod' => $data['samochod']]);
                $this->addRelease($purchaseData);
            }
        }
    }

    private function updateField($data) {
        if (!$data['field']) {
            return;
        }
        $tabela = $data['table'];
        $value = $data['value']; 
        $field = $data['field'];
        $id = $data['id'];

        $qry = $this->db->prepare("UPDATE {$tabela} SET {$field}=? WHERE id=?");
        $qry->execute(array($value,$id));

        // if ($tabela === 'kierowcy') :
        //    $query = "UPDATE $tabela SET $field='$value' WHERE id=$id";
        // elseif ($tabela === 'wydania_paliwa') :
        // $query = "UPDATE $tabela SET $field='$value' WHERE id_wydanie=$id";
        // elseif ($tabela === 'zakupy_paliwa') :
        // $query = "UPDATE $tabela SET $field='$value' WHERE id_zakup=$id";
        // elseif ($tabela === 'trasy') :
        // $query = "UPDATE $tabela SET $field='$value' WHERE id_trasa=$id";
        // else :
        //     $query = "UPDATE $tabela SET $field='$value' WHERE id_samochod=$id";
        

    }
}
