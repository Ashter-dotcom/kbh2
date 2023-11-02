<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            DB::transaction(function () {

                $role = Role::create(['name' => 'superadmin']);

                $permissions = ['Create User', 'Update User', 'Delete User', 'Create Role', 'Update Role', 'Delete Role', 'Create Permission', 'Update Permission', 'Delete Permission', 'Update Profile', 'Dashboard']; 


                foreach($permissions as $permission) {
                    Permission::create(['name' => $permission]);
                }

                $role->syncPermissions($permissions);
                
                $user = User::create([
                    'name' => 'Super Admin',
                    'email' => 'superadmin@optimap.id',
                    'password' => Hash::make('12345678')
                ]);

                $user->syncRoles($role);
            });

        } catch (Throwable $e) {
            report($e);
        }
    }
}
