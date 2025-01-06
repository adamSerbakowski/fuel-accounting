<?php

namespace App\Repositories;

class PurchasesRepository
{
    protected \PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllSuppliers(): array
    {
        $suppliers = $this->db->query("SELECT DISTINCT supplier FROM fuel_purchases"); 
        $list = [];
        foreach ($suppliers as $row) :
            $list[] = $row['supplier'];
        endforeach;

        return $list;
    }

    public function getFiltered(array $filters): array 
    {
        return $this->db->query($this->buildQuery($filters))->fetchAll();
    }

    private function buildQuery(array $filters): string
    {
        $supplier = $filters['supplierFilter'];
        $start = $filters['dateStartFilter'];
        $end = $filters['dateEndFilter'];
        
        if (!$start && !$supplier && !$end) {
            return "SELECT * FROM fuel_purchases ORDER BY date DESC";
        }
        
        $terms = '';
        if ($end) :
            $terms .= "date <= '{$end}'";
        endif;
        if ($start) {
            if ($terms) {
                $terms .= ' AND ';
            }
            $terms .= "date >= '{$start}'";
        }
        if ($supplier) {
            if ($terms) {
                $terms .= ' AND ';
            }
            $terms .= "supplier = '{$supplier}'";
        }

        return "SELECT * FROM fuel_purchases WHERE {$terms} ORDER BY date DESC";
    }
}
