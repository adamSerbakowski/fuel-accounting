<?php

namespace App\Services;

use App\Repositories\ReleasesRepository;

class ReleasesService
{
    public function getData(ReleasesRepository $releasesRepository): array
    {
        $filters = $this->resolveFilters();
        $list = $releasesRepository->getFiltered($filters);   
        $counts = $this->getCounts($list);
        
        return \array_merge([
            'releaseCars' => $releasesRepository->getAllCarsFromReleases(),
            'releases' => $list,
        ], $filters, $counts);
    }

    private function resolveFilters(): array
    {
        return [
            'carFilter' => $_GET['samochodFiltr'] ?? '',
            'dateStartFilter' => $_GET['wydaniePoczatek'] ?? '',
            'dateEndFilter' => $_GET['wydanieKoniec'] ?? '',
        ];
    }

    private function getCounts($list)
    {
        $liczbaWydan = 0;
        $wSumieWydanePaliwo = 0;
        $wSumieWydaneAdblue = 0;
        foreach ($list as $row) :
            $liczbaWydan++;
            $wSumieWydanePaliwo += \intval($row['released_fuel_qty']);
            $wSumieWydaneAdblue += \intval($row['released_adblue_qty']);
        endforeach;

        return [
            'liczbaWydan' => $liczbaWydan,
            'wSumieWydanePaliwo' => $wSumieWydanePaliwo,
            'wSumieWydaneAdblue' => $wSumieWydaneAdblue,
        ];
    }
}
