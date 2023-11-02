<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class OperatorSeeder extends Seeder
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

                $role = Role::create(['name' => 'operator']);

                $permissions = [
                    'Master Data - APM - Index',
                    'Master Data - Komponen - Index',
                    'Master Data - Model - Index',
                    'Master Data - Supplier - Index',
                    'Master Data - Periode - Index',
                    'Master Data - Kapasitas Silinder - Index'
                ]; 

                foreach($permissions as $permission) {
                    Permission::create(['name' => $permission]);
                }

                $role->syncPermissions($permissions);
                
                $user = User::create([
                    'name' => 'Operator',
                    'email' => 'operator@optimap.id',
                    'password' => Hash::make('123qweasd')
                ]);

                $user->syncRoles($role);
            });

        } catch (Throwable $e) {
            report($e);
        }
    }
}
