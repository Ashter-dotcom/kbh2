<?php

namespace App\Repository\MasterData\Interfaces;

interface KomponenModelInterface {
    
    public function all();

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function findByModelId($id);
    
    public function findByKomponenId($id);

    public function getDataKomponentModel(array $params);

    public function syncComponent($id);
}
