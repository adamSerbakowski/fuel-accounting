<?php

namespace App;

use App\DriversController;
use App\UpdateService;

class Router
{
    public function resolveRequest(string $request)
    {
        switch ($request) {
            case '':
            case '/':
                require __DIR__ . $templates . 'template/dashboard.php';
                break;
            case '/kierowcy':
                return (new DriversController())->renderTemplate();
            case '/samochody':
                return (new CarsController())->renderTemplate();
            case '/wydania':
                // ADD GET PARAMS HANDLING or replace function
                return (new ReleasesController())->renderTemplate();
            case '/zakupy':
                // ADD GET PARAMS HANDLING or replace function
                return (new PurchasesController())->renderTemplate();
            case '/trasy':
                return (new DeliveriesController())->renderTemplate();
            case '/dataUpdate':
                return (new UpdateService())->add($_POST);
            default:
                require __DIR__ . '/404.php';
        }
    }
}