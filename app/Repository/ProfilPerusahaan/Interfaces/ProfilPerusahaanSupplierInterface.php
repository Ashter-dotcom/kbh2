<?php

namespace App\Repository\ProfilPerusahaan\Interfaces;

interface ProfilPerusahaanSupplierInterface {
    
    public function all();

    public function update(array $attributes);

    public function findById($id);

    public function findByPerusahaanSupplierId($id);

}