<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Repository\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{

    public function all()
    {
        return Role::all()->pluck('name');
    }

    public function getdata($id)
    {
        return Role::select('id','name')->where('id', $id)->first();
    }

    public function getPermissionsVieRole($roleName)
    {
        $data = [];
        $role = Role::findByName($roleName);

        if(!empty($role->permissions)) {
            foreach($role->permissions as $list) {
                $data[] = $list->name;
            }
        }

        return $data;
    }

    public function store(array $attributes)
    {

        try {

            $attributes['name'] = Str::slug(Str::lower($attributes['name']), '-');
            $attributes['guard_name'] = 'web';
            $role = Role::create($attributes);

            return $role->syncPermissions($attributes['permission']);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

    public function update(array $attributes)
    {
        try {

            $attributes['name'] = Str::slug(Str::lower($attributes['name']), '-');

            $permissions  = isset($attributes['permission']) ? $attributes['permission'] : [];

            $attributes = request()->except(['_token','permission']);

            $roleId = $this->findById(encrypt_decrypt(request()->role_id, 2));

            if(Role::where('id', $roleId->id)->update($attributes)) {

                $role = Role::findByName($attributes['name']);

                return $role->syncPermissions($permissions);
            }

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
        return Role::find($id);
    }

}
