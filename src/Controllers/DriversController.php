<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class DriversController extends Controller
{
    public function getTemplate(): string
    {
        return 'drivers.twig';
    }

    public function getContent()
    {
        return [
            'activeDrivers' => $this->driversRepository->getActive(),
            'archivedDrivers' => $this->driversRepository->getArchived(),
        ];
    }
}
