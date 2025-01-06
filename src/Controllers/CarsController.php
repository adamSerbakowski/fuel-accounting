<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class CarsController extends Controller
{
    public function getTemplate(): string
    {
        return 'cars.twig';
    }

    public function getContent()
    {
        return [
            'cars' => $this->carsRepository->getAll(),
        ];
    }
}
