<?php

namespace App\Repositories;

class ReleasesRepository
{
    protected \PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
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

    public function getFiltered($filters)
    {
        return $this->db->query($this->buildQuery($filters))->fetchAll();
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
        if ($end) :
            $terms .= "date <= '{$end}'";
        endif;
        if ($start) :
            if ($terms) {
                $terms .= ' AND ';
            }
            $terms .= "date >= '{$start}'";
        endif;
        if ($car) :
            if ($terms) {
                $terms .= ' AND ';
            }
            $terms .= "id_car = '{$car}'";
        endif;
              
        return "SELECT r.id, r.id_car, c.registration_nb, r.released_fuel_qty, r.released_adblue_qty, r.released_ref_qty, r.date, r.type 
            FROM fuel_releases r
            INNER JOIN cars c ON r.id_car = c.id 
            WHERE {$terms} 
            ORDER BY date DESC;";
    }
}
