<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Services\PurchasesService;
use App\Repositories\PurchasesRepository;

class PurchasesController extends Controller
{
    public const URL = '\zakupy';

    public function getTemplate(): string
    {
        return 'purchases.twig';
    }

    public function getContent()
    {
        return (new PurchasesService())->getData(new PurchasesRepository($this->db));
    }
}
