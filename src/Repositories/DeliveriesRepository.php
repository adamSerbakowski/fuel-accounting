<?php

namespace App\Repositories;

class DeliveriesRepository
{
    protected \PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $qry = "SELECT d.id, d.id_car, d.id_driver, d.start_date, d.end_date, d.route_length, d.optimal_route_length, d.optimal_fuel_consumption, t.name, c.registration_nb
            FROM deliveries as d
            INNER JOIN truck_drivers as t ON d.id_driver = t.id
            INNER JOIN cars as c ON d.id_car = c.id
            ORDER BY start_date DESC;";

        return $this->db->query($qry)->fetchAll();
    }
}
