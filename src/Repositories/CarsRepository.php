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
        return $this->db->query("SELECT * FROM cars")->fetchAll();
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

    public function getRegistrationById(int $id): string
    {
        $regNumber = $this->db->query(
            "SELECT registration_nb FROM cars WHERE id={$id}"
        )->fetch();

        // remove after validation is added
        return $regNumber[0] ?? '';
    }
}
