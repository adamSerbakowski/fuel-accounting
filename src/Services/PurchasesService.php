<?php

namespace App\Services;

use App\Repositories\PurchasesRepository;

class PurchasesService
{
    public function getData(PurchasesRepository $purchasesRepository): array
    {
        $filters = $this->resolveFilters();
        $list = $purchasesRepository->getFiltered($filters);
        $counts = $this->getCounts($list);        
        
        return \array_merge([
            'suppliers' => $purchasesRepository->getAllSuppliers(),
            'purchases' => $list,
        ], $filters, $counts);
    }

    private function resolveFilters(): array
    {
        return [
            'supplierFilter' => $_GET['dostawcaFiltr'] ?? '',
            'dateStartFilter' => $_GET['zakupPoczatek'] ?? '',
            'dateEndFilter' => $_GET['zakupKoniec'] ?? '',
        ];
    }

    private function getCounts($list)
    {
        $liczbaZakupow = 0;
        $wSumieZakupPaliwo = 0;
        $wSumieZakupAdblue = 0;
        foreach ($list as $row) {
            $liczbaZakupow++;

            $wSumieZakupPaliwo += intval($row['fuel_qty']) ?? 0;
            $wSumieZakupAdblue += intval($row['adblue_qty']) ?? 0;
        }

        return [
            'purchasesCount' => $liczbaZakupow,
            'fuelCount' => $wSumieZakupPaliwo,
            'adblueCount' => $wSumieZakupAdblue,
        ];
    }
}