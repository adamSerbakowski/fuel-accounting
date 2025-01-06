<?php 

namespace App\Controllers;

use App\Controllers\Controller;
use App\Repositories\DeliveriesRepository;
use App\Repositories\ReleasesRepository;

class DeliveriesController extends Controller
{
    public const URL = '\trasy';

    public function getTemplate(): string
    {
        return 'deliveries.twig';
    }

    public function getContent()
    {
        $repo = new DeliveriesRepository($this->db);
        $deliveries = $repo->getAll();

        return [
            'deliveries' => $this->enhanceDeliveries($deliveries),
            'deliveriesCount' => $this->getCounts($deliveries),
        ];
    }

    private function enhanceDeliveries(array $deliveries): array
    {
        $releasesRepository = new ReleasesRepository($this->db);
        $list = [];
        foreach ($deliveries as $row) {
            $fuelConsumed = $releasesRepository->getDeliveryReleases($row['id_car'], $row['start_date'], $row['end_date']);
            $consumedFuel = $fuelConsumed[0] ?? 0;
            $consumedAdblue = $fuelConsumed[1] ?? 0;

            $routeLength = (int) $row['route_length'] ?? 0;
            $optimalFuelConsumption = (float) $row['optimal_fuel_consumption'] ?? 0;
            $optimalRouteLength = (int) $row['optimal_route_length'] ?? 0;
            $spalanieD100 = $this->calculateFuelConsumedPerDistance($consumedFuel, $routeLength);
            $spalanieP100 = $this->calculateOptimalFuelConsumptionPerDistance($optimalFuelConsumption, $optimalRouteLength);
            $difference = $this->calculateDifference($optimalFuelConsumption, $consumedFuel);

            $list[] = array_merge(
                $row,
                [
                    'consumedFuel' => $consumedFuel,
                    'condumedAdblue' => $consumedAdblue,
                    'difference' => $difference,
                    'spalanieD100' => $spalanieD100,
                    'spalanieP100' => $spalanieP100,
                ]
            );
        }

        return $list;
    }

    private function calculateFuelConsumedPerDistance(float $fuelConsumed, int $routeLength): float|string
    {
        if (!$routeLength || !$fuelConsumed) {
            return 'brak danych';
        }
        return \round(($fuelConsumed / ($routeLength / 100)), 2);
    }

    private function calculateOptimalFuelConsumptionPerDistance(float $optimalFuelConsumption, int $optimalRouteLength): float|string
    {
        if (!$optimalRouteLength || !$optimalFuelConsumption) {
            return 'brak danych';
        }
        return \round(($optimalFuelConsumption / ($optimalRouteLength / 100)), 2);
    }

    private function calculateDifference(float $optimalFuelConsumption, float $consumedFuel): float|string
    {
        if (!$optimalFuelConsumption || !$consumedFuel) {
            return 'brak danych';
        }
        return round($optimalFuelConsumption - $consumedFuel, 2);
    }

    private function getCounts(array $list): int
    {
        $count = 0;
        foreach ($list as $row) {
            $count++;
        }

        return $count;
    }
}
