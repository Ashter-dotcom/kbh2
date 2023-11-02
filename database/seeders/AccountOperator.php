<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AccountOperator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleOperator = Role::findOrCreate('operator', 'web');

        // Andri Martono	andrimartono10@gmail.com
        $userOperator = User::create([
            'name' => 'Andri Martono',
            'email' => 'andrimartono10@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Don Piter	don_metallurgy@yahoo.co.id
        // $userOperator = User::create([
        //     'name' => 'Don Piter',
        //     'email' => 'don_metallurgy@yahoo.co.id',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Aji Sudarmaji	ajiand512@gmail.com
        $userOperator = User::create([
            'name' => 'Aji Sudarmaji',
            'email' => 'ajiand512@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Alif Muski Adibah	alifmuski@gmail.com 
        // $userOperator = User::create([
        //     'name' => 'Alif Muski Adibah',
        //     'email' => 'alifmuski@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Atika Dewi Fatmaningrum	atikadfatmaningrum@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Atika Dewi Fatmaningrum',
        //     'email' => 'atikadfatmaningrum@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Bagus Bawana	bagusbawana9@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Bagus Bawana',
        //     'email' => 'bagusbawana9@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Dimas Andre	dimasandreagustian187@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Dimas Andre',
        //     'email' => 'dimasandreagustian187@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Doni Syafar	donisyafarpramudya@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Doni Syafar',
        //     'email' => 'donisyafarpramudya@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Eva Safitri	eva.safitri0395@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Eva Safitri',
        //     'email' => 'eva.safitri0395@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Fikriansyah	Kikiqbe@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Fikriansyah',
        //     'email' => 'kikiqbe@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Nila Gandhi Aprilia	gandhidana@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Nila Gandhi Aprilia',
        //     'email' => 'gandhidana@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Jacka Satria Pidu	Jackasatriapidu@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Jacka Satria Pidu',
        //     'email' => 'jackasatriapidu@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Reza Agasi	widqor@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Reza Agasi',
        //     'email' => 'widqor@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // M. Rafli Ramadhan	Raflimhmmd@gmail.com
        // $userOperator = User::create([
        //     'name' => 'M. Rafli Ramadhan',
        //     'email' => 'raflimhmmd@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Shavira Julianti	shavirajulianti@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Shavira Julianti',
        //     'email' => 'shavirajulianti@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Slamet Pamuji	slametpamuji610@gmail.com 
        $userOperator = User::create([
            'name' => 'Slamet Pamuji',
            'email' => 'slametpamuji610@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Wahyu Richard 	wahyurichard49@gmail.com 
        $userOperator = User::create([
            'name' => 'Wahyu Richard',
            'email' => 'wahyurichard49@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Yudhi Satrio Santoso	yudhisatrios@gmail.com
        // $userOperator = User::create([
        //     'name' => 'Yudhi Satrio Santoso',
        //     'email' => 'yudhisatrios@gmail.com',
        //     'password' => Hash::make('lcev2022')
        // ]);
        // $userOperator->syncRoles($roleOperator);

        // Bunga Pitaka	bungapramesti@gmail.com
        $userOperator = User::create([
            'name' => 'Bunga Pitaka',
            'email' => 'bungapramesti@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Dhea Asyifa	dhea.asyifa11@gmail.com
        $userOperator = User::create([
            'name' => 'Dhea Asyifa',
            'email' => 'dhea.asyifa11@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Karishma Artamevia Krisga	karishmakrisga2003@gmail.com
        $userOperator = User::create([
            'name' => 'Karishma Artamevia Krisga',
            'email' => 'karishmakrisga2003@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Mohammad Hasan Sidiq	    mohammadhasan.sidiq11@gmail.co.id
        $userOperator = User::create([
            'name' => 'Mohammad Hasan Sidiq',
            'email' => 'mohammadhasan.sidiq11@gmail.co.id',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);

        // Yulian Hanif	    yulian.hanif20@gmail.com
        $userOperator = User::create([
            'name' => 'Yulian Hanif',
            'email' => 'yulian.hanif20@gmail.com',
            'password' => Hash::make('lcev2022')
        ]);
        $userOperator->syncRoles($roleOperator);
    }
}
