<?php

namespace App\Repository\ProductionForm\Interfaces;

interface ProductionInterface {
    
    public function all();

    public function getdata(array $params);

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function getDataProductionSuppliers(array $params);
}