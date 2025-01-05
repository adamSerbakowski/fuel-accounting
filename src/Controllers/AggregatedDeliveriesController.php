<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class AggregatedDeliveriesController extends Controller
{
    public function getTemplate(): string
    {
        return 'aggregated_deliveries.twig';
    }

    public function getContent()
    {
        //$data = $this->getDeliveries();
        return [
            // 'cars' => $this->carsRepository->getAll(),
            // 'deliveries' => $data['list'],
            // 'deliveriesCount' => $data['liczbaTras'],
        ];
    }
}

