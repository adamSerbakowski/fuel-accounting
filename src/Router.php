<?php

namespace App;

use App\Controllers\CarsController;
use App\Controllers\DashboardController;
use App\Controllers\DeliveriesController;
use App\Controllers\DriversController;
use App\Controllers\PurchasesController;
use App\Controllers\ReleasesController;
use App\Services\UpdateService;

class Router
{
    public function resolveRequest(string $request)
    {
        $request = \str_replace('/', '', $this->stripParams($request));
        switch ($request) {
            case '':
                return (new DashboardController())->renderTemplate();
            case 'kierowcy':
                return (new DriversController())->renderTemplate();
            case 'samochody':
                return (new CarsController())->renderTemplate();
            case 'wydania':
                return (new ReleasesController())->renderTemplate();
            case 'zakupy':
                return (new PurchasesController())->renderTemplate();
            case 'trasy':
                return (new DeliveriesController())->renderTemplate();
            case 'dataUpdate':
                return (new UpdateService())->add($_POST);
            default:
                require __DIR__ . '/404.php';
        }
    }

    private function stripParams(string $request): string
    {
        $uri = explode('?', $request, 2);

        return $uri[0];
    }


}
