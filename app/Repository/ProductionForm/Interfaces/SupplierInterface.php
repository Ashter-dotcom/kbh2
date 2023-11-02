<?php

namespace App\Repository\ProductionForm\Interfaces;

interface SupplierInterface {
    
    public function all();

    public function getdata(array $params);

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function getDataSupplier(array $params);

    public function findByMultipleId(array $id);

    public function getDataComponentSupplier(array $params);

    public function getSupplierByModelId(array $id);

    public function getSubSupplierByModelId(array $id);

    public function getInHouseByModelId(array $id);

    public function report_supplier_apm_kelompok_komponen();

    public function report_supplier_komponen_apm();

    public function report_pohon_industri();

    public function report_pohon_industri_kategori_komponen($master_kategori_name);

    public function report_pohon_industri_supplier($kategori_id);
}