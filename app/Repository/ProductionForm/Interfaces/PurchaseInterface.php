<?php

namespace App\Repository\ProductionForm\Interfaces;

interface PurchaseInterface {
    
    public function all();

    public function getdata(array $params);

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function getDataComponentPurchase(array $params);

    public function report_realisasi_komponen_lokal_apm();

    public function report_realisasi_komponen_lokal_model();

}