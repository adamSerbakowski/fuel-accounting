<?php 

namespace App;

use App\Controller;

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
