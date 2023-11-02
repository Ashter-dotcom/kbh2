<?php

namespace App\Repository\MasterData\Interfaces;

interface PeriodeInterface {
    
    public function all();

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function getPeriodeByModelId($modelId);

    public function purchasePeriode(array $params);

    public function productionPeriods();
    
    public function cari($q);

}