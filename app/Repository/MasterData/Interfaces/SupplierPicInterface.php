<?php

namespace App\Repository\MasterData\Interfaces;

interface SupplierPicInterface {
    
    public function all();

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function findByApmId($id);
    
    public function findBySupplierId($id);
}
