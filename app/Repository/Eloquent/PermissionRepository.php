<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Repository\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all()
    {
        return Permission::select('id','name')->orderBy('name')->get();
    }

    public function getdata($id)
    {
        return Permission::select('id','name')->where('id', $id)->first();
    }

    public function store(array $attributes)
    {

        try {
            $attributes['guard_name'] = 'web';
            return Permission::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

    public function update(array $attributes)
    {

        try {
            $permission = $this->findById(encrypt_decrypt(request()->permission_id, 2));
            $attributes = request()->except(['_token']);

            return Permission::where('id', $permission->id)->update($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->findById($id)->delete();
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function findById($id)
    {
        return Permission::find($id);
    }

}
