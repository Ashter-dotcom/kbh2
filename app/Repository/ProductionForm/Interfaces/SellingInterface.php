<?php

namespace App\Repository\ProductionForm\Interfaces;

interface SellingInterface {
    
    public function all();

    public function getdata(array $params);
    
    public function getdataByMonth(array $params);

    public function store(array $attributes);
    
    public function excel($attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function report_penjualan_model();

    public function report_rencana_produksi_dan_penjualan();

    public function report_realisasi_produksi_dan_penjualan();

}