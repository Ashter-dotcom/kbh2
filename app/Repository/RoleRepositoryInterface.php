<?php

namespace App\Repository;

interface RoleRepositoryInterface {
    
    public function all();

    public function getdata($id);

    public function getPermissionsVieRole($roleName);

    public function store(array $attributes);

    public function update(array $attributes);

    public function delete($id);

    public function findById($id);

}