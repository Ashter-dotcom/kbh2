<?php

namespace App\Repository;

interface PermissionRepositoryInterface {
    
    public function all();
    
    public function getdata($id);

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

}