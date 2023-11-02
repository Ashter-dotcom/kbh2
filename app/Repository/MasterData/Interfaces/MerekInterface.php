<?php

namespace App\Repository\MasterData\Interfaces;

interface MerekInterface {
    
    public function all();

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function cari($q,$apmId);

}