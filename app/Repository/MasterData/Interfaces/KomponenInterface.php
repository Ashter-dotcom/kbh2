<?php

namespace App\Repository\MasterData\Interfaces;

interface KomponenInterface {

    public function all();

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

    public function findByMasterKategoriKomponen($id);

    public function findByMultipleId(array $id);

    public function cari($q);

    public function kategori();

}
