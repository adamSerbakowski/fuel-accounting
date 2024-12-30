<?php

namespace App\Controllers;

use App\Controllers\Controller;

use App\Repositories\ReleasesRepository;
use App\Services\ReleasesService;

class ReleasesController extends Controller
{
    public const URL = '\wydania';

    public function getTemplate(): string
    {
        return 'releases.twig';
    }

    public function getContent()
    {
        return (new ReleasesService())->getData(new ReleasesRepository($this->db));
    }
}
