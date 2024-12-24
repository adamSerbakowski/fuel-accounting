<?php

namespace App;

use App\Controller;
use App\DriversController;

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
            case '/trasy':
                require __DIR__ . $templates . 'trasy.php';
                break;
        
            case '/samochody':
                return (new DriversController())->renderTemplate();
                break;
        
            case '/wydania':
                require __DIR__ . $templates . 'wydania.php';
                break;
            case '/zakupy':
                require __DIR__ . $templates . 'zakupy.php';
                break;
            case '/dataUpdate/dodaj-kierowca':
                require 'dodaj-kierowca.php';
                break;
            default:
                require __DIR__ . '/template/404.php';
        }
    }
}