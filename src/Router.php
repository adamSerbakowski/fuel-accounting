<?php

namespace App;

use App\Controller;
use App\DriversController;
use App\UpdateService;

class Router
{
    public function resolveRequest(string $request)
    {
        $templates = '/src/';
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
                require __DIR__ . $templates . 'zakupy.php';
                break;
            case '/trasy':
                require __DIR__ . $templates . 'trasy.php';
                break;
            case '/dataUpdate';
                return (new UpdateService())->add($_POST);
                break;
            default:
                require __DIR__ . '/template/404.php';
        }
    }
}