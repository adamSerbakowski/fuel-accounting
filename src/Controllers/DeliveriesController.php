<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class DeliveriesController extends Controller
{
    public const URL = '\trasy';

    public function getTemplate(): string
    {
        return 'deliveries.twig';
    }

    public function getContent()
    {
        $data = $this->getDeliveries();
        return [
            'deliveries' => $data['list'],
            'deliveriesCount' => $data['liczbaTras'],
        ];
    }

    private function getDeliveries()
    {
        $getTrasy = "SELECT d.id, d.id_car, d.id_driver, d.start_date, d.end_date, d.route_length, d.optimal_route_length, d.optimal_fuel_consumption, t.name, c.registration_nb
            FROM deliveries as d
            INNER JOIN truck_drivers as t ON d.id_driver = t.id
            INNER JOIN cars as c ON d.id_car = c.id
            ORDER BY start_date DESC;";
        $trasy = $this->db->query($getTrasy);
        $liczbaTras = 0;
        $list = [];
        foreach ($trasy as $row) : 
            $routeLength = $row['route_length'] ?? 0;
            $optimalFuelConsumption = $row['optimal_fuel_consumption'] ?? 0;
            $optimalRouteLength = $row['optimal_route_length'] ?? 0;
            $fuelConsumed = $this->getDeliveryReleases($row['id_car'], $row['start_date'], $row['end_date']);
            $spalaniep = $fuelConsumed[0] ?? 0;
            $spalaniea = $fuelConsumed[1] ?? 0;
            if ($routeLength) {
                $spalanieD100 = round(
                    ($spalaniep / ($routeLength / 100)), 
                    2
                );
            } else {
                $spalanieD100 = 0;
            }
            if ($optimalRouteLength) {
                $spalanieP100 = round(
                    ($optimalFuelConsumption / ($optimalRouteLength / 100)), 
                    2
                );
                $difference = round($optimalFuelConsumption - $spalaniep, 2);
            } else {
                $spalanieP100 = 0;
                $difference = 'brak danych';
            }

            $list[] = [
                'id' => $row['id'],
                'samochod' => $row['id_car'],
                'registration_nb' => $row['registration_nb'],
                'name' => $row['name'],
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date'],
                'route_length' => $row['route_length'],
                'optimal_route_length' => $row['optimal_route_length'],
                'optimal_fuel_consumption' => $row['optimal_fuel_consumption'],
                'consumedFuel' => $spalaniep,
                'condumedAdblue' => $spalaniea,
                'difference' => $difference,
                'spalanieD100' => $spalanieD100,
                'spalanieP100' => $spalanieP100,
            ];
            $liczbaTras++;
        endforeach;

        return ['list' => $list, 'liczbaTras' => $liczbaTras];
    }

    private function getDeliveryReleases($id_car, $data_poczatek, $data_koniec)
    {
        $spalaniep = 0;
        $spalaniea = 0;
        $pasujaceWydania = $this->db->query("SELECT * FROM fuel_releases WHERE `id_car`='$id_car' AND `date`>='$data_poczatek' AND `date`<='$data_koniec'");
        foreach ($pasujaceWydania as $row2) : 
            $spalaniep += $row2['released_fuel_qty'] ?? 0;
            $spalaniea += $row2['released_adblue_qty'] ?? 0;
        endforeach;

        return [$spalaniep, $spalaniea];
    }
}
