<?php

namespace App\Repositories;

class CarsRepository
{
    protected \PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $drivers = $this->db->query("SELECT * FROM cars");
        $list = [];
        foreach ($drivers as $row) :
            $list[] = $row;
        endforeach;

        return $list;
    }

    public function getAllShortened(): array
    {
    $samochody = $this->db->query("SELECT id, registration_nb FROM cars");
    $list = [];
    foreach ($samochody as $row) :
        $list[] = ['id' => $row['id'], 'nb' => $row['registration_nb']];
    endforeach;

    return $list;
    }
}
