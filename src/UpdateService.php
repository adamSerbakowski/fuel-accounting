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
}