<?php

namespace App\Repository\ProfilPerusahaan\Interfaces;

interface ProfilPerusahaanApmInterface {
    
    public function all();

    public function update(array $attributes);

    public function findById($id);

    public function findByPerusahaanApmId($id);

    public function findProfil(array $params);

}