<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AccountSeeder extends Seeder
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

                // Superadmin
                $roleSuperadmin = Role::findOrCreate('superadmin', 'web');
                $userSuperadmin = User::create([
                    'name' => 'SuperAdmin',
                    'email' => 'superadmin@dummy.com',
                    'password' => Hash::make('QWEasd!@#123')
                ]);
                $userSuperadmin->syncRoles($roleSuperadmin);

                // Kementerian Perindustrian
                $roleKemenperin = Role::findOrCreate('kemenperin', 'web');
                $userKemenperin = User::create([
                    'name' => 'Kementerian Perindustrian',
                    'email' => 'kemenperin@dummy.com',
                    'password' => Hash::make('lcev2022')
                ]);
                $userKemenperin->syncRoles($roleKemenperin);

                // Admin
                $roleAdmin = Role::findOrCreate('admin', 'web');
                $userAdmin = User::create([
                    'name' => 'Admin',
                    'email' => 'admin@dummy.com',
                    'password' => Hash::make('!@#123qweASD')
                ]);
                $userAdmin->syncRoles($roleAdmin);

                // Operator
                $roleOperator = Role::findOrCreate('operator', 'web');
                $userOperator = User::create([
                    'name' => 'Operator',
                    'email' => 'operator@dummy.com',
                    'password' => Hash::make('123qweasd')
                ]);
                $userOperator->syncRoles($roleOperator);
            });

        } catch (Throwable $e) {
            report($e);
        }
    }
}
