<?php

namespace App\Repository\FormulirVerifikasi\Interfaces;

interface JamKerjaInterface {

    public function all();

    public function store(array $attributes);

    public function getdata(array $params);

    public function getDataComponentSupplier(array $params);

    // public function update(array $attributes);

    // public function delete($id);

    // public function findById($id);

    public function cari($q,$apmId);

}
