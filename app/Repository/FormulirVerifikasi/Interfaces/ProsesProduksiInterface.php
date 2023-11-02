<?php

namespace App\Repository\FormulirVerifikasi\Interfaces;

interface ProsesProduksiInterface {
    
    public function all();

    public function getdata(array $params);

    public function store(array $attributes);

    public function getDataComponentSupplier(array $params);

}