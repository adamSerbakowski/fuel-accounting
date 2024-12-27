<?php

namespace App;

class DriversRepository
{
    protected \PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $drivers = $this->db->query("SELECT * FROM truck_drivers");
        $list = [];
        foreach ($drivers as $row) :
            $list[] = ['id' => $row['id'], 'name' => $row['name']];
        endforeach;

        return $list;
    }

    public function getActive(): array
    {
        $drivers = $this->db->query("SELECT * FROM truck_drivers WHERE active = true;");
        $list = [];
        foreach ($drivers as $row) :
            $list[] = $row;
        endforeach;

        return $list;
    }

    public function getArchived(): array
    {
        $drivers = $this->db->query("SELECT * FROM truck_drivers WHERE active = false;");
        $list = [];
        foreach ($drivers as $row) :
            $list[] = $row;
        endforeach;

        return $list;
    }
}