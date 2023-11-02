<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repository\UserRepositoryInterface::class, \App\Repository\Eloquent\UserRepository::class);
        $this->app->bind(\App\Repository\RoleRepositoryInterface::class, \App\Repository\Eloquent\RoleRepository::class);
        $this->app->bind(\App\Repository\PermissionRepositoryInterface::class, \App\Repository\Eloquent\PermissionRepository::class);

        $this->app->bind(\App\Repository\ProductionForm\Interfaces\SupplierInterface::class, \App\Repository\ProductionForm\Eloquent\SupplierEloquent::class);
        $this->app->bind(\App\Repository\ProductionForm\Interfaces\SellingInterface::class, \App\Repository\ProductionForm\Eloquent\SellingEloquent::class);
        $this->app->bind(\App\Repository\ProductionForm\Interfaces\PurchaseInterface::class, \App\Repository\ProductionForm\Eloquent\PurchaseEloquent::class);
        $this->app->bind(\App\Repository\ProductionForm\Interfaces\ProductionInterface::class, \App\Repository\ProductionForm\Eloquent\ProductionEloquent::class);

        $this->app->bind(\App\Repository\MasterData\Interfaces\ApmInterface::class, \App\Repository\MasterData\Eloquent\ApmEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\KomponenModelInterface::class, \App\Repository\MasterData\Eloquent\KomponenModelEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\KapasitasSilinderInterface::class, \App\Repository\MasterData\Eloquent\KapasitasSilinderEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\KomponenInterface::class, \App\Repository\MasterData\Eloquent\KomponenEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\ModelInterface::class, \App\Repository\MasterData\Eloquent\ModelEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\PeriodeInterface::class, \App\Repository\MasterData\Eloquent\PeriodeEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\SupplierInterface::class, \App\Repository\MasterData\Eloquent\SupplierEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\MerekInterface::class, \App\Repository\MasterData\Eloquent\MerekEloquent::class);
        $this->app->bind(\App\Repository\MasterData\Interfaces\ManufakturingInterface::class, \App\Repository\MasterData\Eloquent\ManufakturingEloquent::class);

        $this->app->bind(\App\Repository\ProfilPerusahaan\Interfaces\ProfilPerusahaanApmInterface::class, \App\Repository\ProfilPerusahaan\Eloquent\ProfilPerusahaanApmEloquent::class);
        $this->app->bind(\App\Repository\ProfilPerusahaan\Interfaces\ProfilPerusahaanSupplierInterface::class, \App\Repository\ProfilPerusahaan\Eloquent\ProfilPerusahaanSupplierEloquent::class);

        $this->app->bind(\App\Repository\FormulirVerifikasi\Interfaces\ProsesProduksiInterface::class, \App\Repository\FormulirVerifikasi\Eloquent\ProsesProduksiEloquent::class);
        $this->app->bind(\App\Repository\FormulirVerifikasi\Interfaces\JamKerjaInterface::class, \App\Repository\FormulirVerifikasi\Eloquent\JamKerjaEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
