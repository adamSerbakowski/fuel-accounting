<?php

namespace App\Repositories;

class ReleasesRepository
{
    protected \PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getFiltered($filters): array
    {
        return $this->db->query($this->buildQuery($filters))->fetchAll();
    }

    public function getDeliveryReleases(int $id_car, string $data_poczatek, string $data_koniec): array
    {
        $consumedFuel = 0;
        $consumedAdblue = 0;
        $deliveryReleases = $this->db->query("SELECT * FROM fuel_releases WHERE `id_car`='$id_car' AND `date`>='$data_poczatek' AND `date`<='$data_koniec'");
        foreach ($deliveryReleases as $row) : 
            $consumedFuel += (float) $row['released_fuel_qty'] ?? 0;
            $consumedAdblue += (float) $row['released_adblue_qty'] ?? 0;
        endforeach;

        return [$consumedFuel, $consumedAdblue];
    }

    public function getAllCarsFromReleases(): array
    {
        $samochodyF = $this->db->query("SELECT DISTINCT id_car FROM fuel_releases");
        $carsRepo = new CarsRepository($this->db);
        $list = [];
        foreach ($samochodyF as $row) {
            if (!$row['id_car']) {
                continue;
            } 
            $regNumber = $carsRepo->getRegistrationById($row['id_car']);
            $list[] = [
                'carId' => $row['id_car'],
                'registrationNb' => $regNumber,
            ];
        }

        return $list;
    }

    private function buildQuery(array $filters): string
    {
        $car = $filters['carFilter'];
        $start = $filters['dateStartFilter'];
        $end = $filters['dateEndFilter'];

        if (!$start && !$car && !$end) {
            return "SELECT r.id, r.id_car, c.registration_nb, r.released_fuel_qty, r.released_adblue_qty, r.released_ref_qty, r.date, r.type 
                FROM fuel_releases r 
                INNER JOIN cars c ON r.id_car = c.id 
                ORDER BY date DESC;";
        }

        $terms = '';    
        if ($end) {
            $terms .= "date <= '{$end}'";
        }
        if ($start) {
            if ($terms) {
                $terms .= ' AND ';
            }
            $terms .= "date >= '{$start}'";
        }
        if ($car) {
            if ($terms) {
                $terms .= ' AND ';
            }
            $terms .= "id_car = '{$car}'";
        }
              
        return "SELECT r.id, r.id_car, c.registration_nb, r.released_fuel_qty, r.released_adblue_qty, r.released_ref_qty, r.date, r.type 
            FROM fuel_releases r
            INNER JOIN cars c ON r.id_car = c.id 
            WHERE {$terms} 
            ORDER BY date DESC;";
    }
}
