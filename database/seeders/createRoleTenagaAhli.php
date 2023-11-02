<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class createRoleTenagaAhli extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleTenagaAhli = Role::findOrCreate('ta', 'web');

        // Tenaga Ahli	ta@dummy.com
        $userTenagaAhli = User::create([
            'name' => 'Tenaga Ahli',
            'email' => 'ta@dummy.com',
            'password' => Hash::make('tappnbm')
        ]);
        $userTenagaAhli->syncRoles($roleTenagaAhli);
    }
}
