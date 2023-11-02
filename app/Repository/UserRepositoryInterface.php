<?php

namespace App\Repository;

interface UserRepositoryInterface {

    public function getdata($id);

    public function store(array $attributes);

    public function update(array $attributes);

    public function update_profile(array $attributes);

    public function delete($id);

    public function findById($id);

}