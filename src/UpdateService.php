<?php

namespace App;

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
            case 'addRelease':
                $this->addRelease($data);
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
}
