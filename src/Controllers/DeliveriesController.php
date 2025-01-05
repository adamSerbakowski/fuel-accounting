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

        // solve id mismatch
        $getTrasy = "SELECT * FROM deliveries "
        . "INNER JOIN truck_drivers ON deliveries.id_driver = truck_drivers.id "
        . "INNER JOIN cars ON deliveries.id_car = cars.id "
        . "ORDER BY start_date DESC;";
        $trasy = $this->db->query($getTrasy);
        $liczbaTras = 0;
        $list = [];
        foreach ($trasy as $row) : 
            $fuelConsumed = $this->getDeliveryReleases($row['id_car'], $row['start_date'], $row['end_date']);
            $spalaniep = $fuelConsumed[0];
            $spalaniea = $fuelConsumed[1];
            $spalanieD100 = round($spalaniep / ($row['route_length'] / 100),2);
            $spalanieP100 = round($row['optimal_fuel_consumption'] / ($row['optimal_route_length'] / 100),2);
            $difference = round($row['optimal_fuel_consumption'] - $spalaniep, 2);
            
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
            $spalaniep += $row2['released_fuel_qty'];
            $spalaniea += $row2['released_adblue_qty'];
        endforeach;

        return [$spalaniep, $spalaniea];
    }
}
