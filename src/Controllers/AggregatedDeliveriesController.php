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
        return [];
    }
}

