<?php 

namespace App\Controllers;

use App\Controllers\Controller;

use App\Repositories\PurchasesRepository;
use App\Repositories\ReleasesRepository;
use App\Services\PurchasesService;
use App\Services\ReleasesService;

class DashboardController extends Controller
{
    public function getTemplate(): string
    {
        return 'dashboard.twig';
    }

    public function getContent()
    {
        return array_merge(
            (new PurchasesService())->getData(new PurchasesRepository($this->db)),
            (new ReleasesService())->getData(new ReleasesRepository($this->db)),
        );
    }
}
