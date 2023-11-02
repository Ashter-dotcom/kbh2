<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    public function getdata($id)
    {
        return User::select('id','name','email','status')->where('id', $id)->first();
    }

    public function store(array $attributes)
    {

        try {
            $attributes['password'] = Hash::make(request()->input('password'));

            $user = User::create($attributes);
            return $user->assignRole($attributes['role']);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

    public function update(array $attributes)
    {

        try {
            $user = $this->findById(encrypt_decrypt(request()->user_id, 2));

            $roles = isset($attributes['role']) ? $attributes['role'] : [];;

            $attributes = request()->except(['_token','password_confirmation','password', 'role']);

            if(!empty(request()->input('password'))) {
                $attributes['password'] = Hash::make(request()->input('password'));
            }

            User::where('id', $user->id)->update($attributes);

            return $user->syncRoles($roles);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update_profile(array $attributes)
    {
        try {
            $user = $this->findById(encrypt_decrypt(request()->user_id, 2));

            $attributes = request()->except(['_token','password_confirmation','password']);

            if(!empty(request()->input('password'))) {
                $attributes['password'] = Hash::make(request()->input('password'));
            }

            return User::where('id', $user->id)->update($attributes);
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
        return User::find($id);
    }

}
