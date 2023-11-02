<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');

Route::group(['middleware' => 'guest', 'namespace' => 'Auth'], function () {
    Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('/authenticate', ['as' => 'authenticate', 'uses' => 'AuthController@authenticate']);
    Route::get('/forgot-password', ['as' => 'forgotpassword-form', 'uses' => 'AuthController@forgot_password_form']);
    Route::post('/forgot-password', ['as' => 'forgotpassword', 'uses' => 'AuthController@forgot_password']);
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Auth'], function () {
    Route::post('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
});

Route::group(['middleware' => ['auth', 'role:superadmin|kemenperin|admin|operator|ta'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/report/{tipe_report?}', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'overview'], function () {
        Route::get('/report-apm', ['as' => 'report_apm', 'uses' => 'DashboardController@report_apm']);
        Route::get('/report-rencana-produksi-dan-penjualan', ['as' => 'report_rencana_produksi_dan_penjualan', 'uses' => 'DashboardController@report_rencana_produksi_dan_penjualan']);
        Route::get('/report-realisasi-produksi-dan-penjualan', ['as' => 'report_realisasi_produksi_dan_penjualan', 'uses' => 'DashboardController@report_realisasi_produksi_dan_penjualan']);
    });

    Route::group(['prefix' => 'pohon-industri'], function () {
        Route::get('/report-pohon-industri', ['as' => 'report-pohon-industri', 'uses' => 'DashboardController@report_pohon_industri']);
        Route::get('/report-pohon-industri/kategori', ['as' => 'report-pohon-industri-kategori-komponen', 'uses' => 'DashboardController@report_pohon_industri_kategori_komponen']);
        Route::get('/report-pohon-industri/supplier', ['as' => 'report-pohon-industri-supplier', 'uses' => 'DashboardController@report_pohon_industri_supplier']);
    });

    Route::group(['prefix' => 'statistik-apm'], function () {
        Route::get('/report-penjualan-model', ['as' => 'report_penjualan_model', 'uses' => 'DashboardController@report_penjualan_model']);
        Route::get('/report-realisasi-komponen-lokal-apm', ['as' => 'report_realisasi_komponen_lokal_apm', 'uses' => 'DashboardController@report_realisasi_komponen_lokal_apm']);
        Route::get('/report-realisasi-komponen-lokal-model', ['as' => 'report_realisasi_komponen_lokal_model', 'uses' => 'DashboardController@report_realisasi_komponen_lokal_model']);
    });

    Route::group(['prefix' => 'statistik-supplier'], function () {
        Route::get('/report-supplier-apm-kelompok-komponen', ['as' => 'report_supplier_apm_kelompok_komponen', 'uses' => 'DashboardController@report_supplier_apm_kelompok_komponen']);
        Route::get('/report-supplier-komponen-apm', ['as' => 'report_supplier_komponen_apm', 'uses' => 'DashboardController@report_supplier_komponen_apm']);
    });
});

Route::group(['middleware' => ['auth', 'role:superadmin|admin|operator'], 'as' => 'form_produksi.', 'namespace' => 'ProductionForm'], function () {
    Route::group(['prefix' => 'pemasok', 'as' => 'supplier.'], function () {
        Route::get('/{model_id}', ['as' => 'index-supplier', 'uses' => 'SupplierController@index']);
        Route::get('/{model_id}/create/{component_category?}', ['as' => 'create-supplier', 'uses' => 'SupplierController@create']);
        Route::post('/{model_id}/store/{component_category?}', ['as' => 'store-supplier', 'uses' => 'SupplierController@store']);
        Route::post('/{model_id}/update/{component_category?}', ['as' => 'update-supplier', 'uses' => 'SupplierController@update']);
        Route::post('/{model_id}/delete/{id}', ['as' => 'delete-supplier', 'uses' => 'SupplierController@delete']);
    });

    Route::group(['prefix' => 'penjualan', 'as' => 'selling.'], function () {
        Route::get('/{model_id}', ['as' => 'index-selling', 'uses' => 'SellingController@index']);
        Route::get('/{model_id}/periode', ['as' => 'period-selling', 'uses' => 'SellingController@periode']);
        Route::get('/{model_id}/create', ['as' => 'create-selling', 'uses' => 'SellingController@create']);
        Route::post('/{model_id}/store', ['as' => 'store-selling', 'uses' => 'SellingController@store']);
        Route::get('/{model_id}/edit/{selling_id}', ['as' => 'edit-selling', 'uses' => 'SellingController@edit']);
        Route::post('/{model_id}/update/{selling_id}', ['as' => 'update-selling', 'uses' => 'SellingController@update']);
        Route::post('/{model_id}/import', ['as' => 'import', 'uses' => 'SellingController@import']);
        Route::post('/{model_id}/delete/{selling_id}', ['as' => 'delete-selling', 'uses' => 'SellingController@delete']);
    });

    Route::group(['prefix' => 'pembelian', 'as' => 'purchase.'], function () {
        Route::get('/{model_id}/periode/{period_id}', ['as' => 'index-purchase', 'uses' => 'PurchaseController@index']);
        Route::get('/{model_id}/periode', ['as' => 'period-purchase', 'uses' => 'PurchaseController@period']);
        Route::get('/{model_id}/periode/{period_id}/create/{component_category?}', ['as' => 'create-purchase', 'uses' => 'PurchaseController@create']);
        Route::post('/{model_id}/periode/{period_id}/create/{component_category?}', ['as' => 'store-purchase', 'uses' => 'PurchaseController@store']);
    });

    Route::group(['prefix' => 'produksi', 'as' => 'production.'], function () {
        Route::get('/{model_id}/periode/{period_id}', ['as' => 'index-production', 'uses' => 'ProductionController@index']);
        Route::get('/{model_id}/periode', ['as' => 'period-production', 'uses' => 'ProductionController@period']);
        // Route::get('/{model_id}/periode/{period_id}/create', ['as' => 'create-production', 'uses' => 'ProductionController@create']);
        // Route::post('/{model_id}/periode/{period_id}/store', ['as' => 'store-production', 'uses' => 'ProductionController@store']);
        Route::get('/{model_id}/create', ['as' => 'create-production', 'uses' => 'ProductionController@create']);
        Route::post('/{model_id}/store', ['as' => 'store-production', 'uses' => 'ProductionController@store']);
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'profil-perusahaan', 'namespace' => 'ProfilPerusahaan'], function () {
    Route::group(['middleware' => 'role:superadmin|admin|operator', 'as' => 'profil-perusahaan-'], function () {
        Route::group(['prefix' => 'apm', 'as' => 'apm-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ProfilAPMController@index']);
            Route::group(['prefix' => 'sebelum-insentif', 'as' => 'sebelum-insentif-'], function () {
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ProfilApmController@editSebelum']);
                Route::post('{id}/update', ['as' => 'update', 'uses' => 'ProfilApmController@updateSebelum']);
            });
            Route::group(['prefix' => 'setelah-insentif', 'as' => 'setelah-insentif-'], function () {
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ProfilApmController@editSetelah']);
                Route::post('{id}/update', ['as' => 'update', 'uses' => 'ProfilApmController@updateSetelah']);
            });
        });
        Route::group(['prefix' => 'supplier', 'as' => 'supplier-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ProfilSupplierController@index']);
            Route::group(['prefix' => 'sebelum-insentif', 'as' => 'sebelum-insentif-'], function () {
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ProfilSupplierController@editSebelum']);
                Route::post('{id}/update', ['as' => 'update', 'uses' => 'ProfilSupplierController@updateSebelum']);
            });
            Route::group(['prefix' => 'setelah-insentif', 'as' => 'setelah-insentif-'], function () {
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ProfilSupplierController@editSetelah']);
                Route::post('{id}/update', ['as' => 'update', 'uses' => 'ProfilSupplierController@updateSetelah']);
            });
        });
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'formulir-verifikasi', 'namespace' => 'FormulirVerifikasi'], function () {
    Route::group(['middleware' => 'role:superadmin|admin|operator|ta', 'as' => 'formulir-verifikasi-'], function () {
        Route::group(['prefix' => 'prosesproduksi', 'as' => 'prosesproduksi-'], function () {
            Route::get('create', ['as' => 'create', 'uses' => 'ProsesProduksiController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ProsesProduksiController@store']);
        });
    });
    Route::group(['middleware' => 'role:superadmin|admin|operator|ta', 'as' => 'formulir-verifikasi-'], function () {
        Route::group(['prefix' => 'jamkerja', 'as' => 'jamkerja-'], function () {
            Route::get('create', ['as' => 'create', 'uses' => 'JamKerjaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'JamKerjaController@store']);
        });
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'view-data', 'namespace' => 'ViewData'], function () {
    Route::group(['middleware' => 'role:superadmin|admin|operator|ta', 'as' => 'view-data-'], function () {
        Route::group(['prefix' => 'd1a', 'as' => 'd1a-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D1Controller@d1aIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D1Controller@d1aLihat']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'D1Controller@d1aUnduh']);
        });
        Route::group(['prefix' => 'd1b', 'as' => 'd1b-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D1Controller@d1bIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D1Controller@d1bLihat']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'D1Controller@d1bUnduh']);
        });
        Route::group(['prefix' => 'd1c', 'as' => 'd1c-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D1Controller@d1cIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D1Controller@d1cLihat']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'D1Controller@d1cUnduh']);
        });
        Route::group(['prefix' => 'd2', 'as' => 'd2-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D2Controller@index']);
            Route::get('unduh/{apm}/{periode}', ['as' => 'unduh', 'uses' => 'D2Controller@unduh']);
        });
        Route::group(['prefix' => 'd3', 'as' => 'd3-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D3Controller@index']);
            Route::get('unduh/{apm}/{model}/{periode}', ['as' => 'unduh', 'uses' => 'D3Controller@unduh']);
        });
        Route::group(['prefix' => 'd4a', 'as' => 'd4a-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D4Controller@d4aIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D4Controller@d4aLihat']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'D4Controller@d4aUnduh']);
        });
        Route::group(['prefix' => 'd4b', 'as' => 'd4b-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D4Controller@d4bIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D4Controller@d4bLihat']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'D4Controller@d4bUnduh']);
        });
        Route::group(['prefix' => 'd5a', 'as' => 'd5a-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D5Controller@d5aIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D5Controller@d5aLihat']);
            Route::get('unduh/{supplier}', ['as' => 'unduh', 'uses' => 'D5Controller@d5aUnduh']);
        });
        Route::group(['prefix' => 'd5b', 'as' => 'd5b-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D5Controller@d5bIndex']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'D5Controller@d5bLihat']);
            Route::get('unduh/{supplier}', ['as' => 'unduh', 'uses' => 'D5Controller@d5bUnduh']);
        });
        Route::group(['prefix' => 'd6', 'as' => 'd6-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D6Controller@index']);
            Route::get('unduh/{apm}/{model}/{periode}', ['as' => 'unduh', 'uses' => 'D6Controller@unduh']);
        });
        Route::group(['prefix' => 'd7a', 'as' => 'd7a-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D7Controller@d7aIndex']);
            Route::get('unduh/{apm}/{periode}', ['as' => 'd7aunduh', 'uses' => 'D7Controller@d7aunduh']);
        });
        Route::group(['prefix' => 'd7b', 'as' => 'd7b-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D7Controller@d7bIndex']);
            Route::get('unduh/{apm}/{periode}', ['as' => 'd7bunduh', 'uses' => 'D7Controller@d7bunduh']);
        });
        Route::group(['prefix' => 'd7c', 'as' => 'd7c-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D7Controller@d7cIndex']);
            Route::get('unduh/{apm}/{periode}', ['as' => 'd7cunduh', 'uses' => 'D7Controller@d7cunduh']);
        });
        Route::group(['prefix' => 'd8', 'as' => 'd8-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'D8Controller@index']);
            Route::get('unduh/{apm}/{model}/{supplier}', ['as' => 'd8unduh', 'uses' => 'D8Controller@unduh']);
        });
        Route::group(['prefix' => 'h3', 'as' => 'h3-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'H3Controller@h3Index']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'H3Controller@h3unduh']);
        });
        Route::group(['prefix' => 'h4', 'as' => 'h4-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'H4Controller@index']);
            Route::get('unduh/{apm}/{model}/{periode}', ['as' => 'unduh', 'uses' => 'H4Controller@unduh']);
        });
        Route::group(['prefix' => 'h5', 'as' => 'h5-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'H5Controller@index']);
            Route::get('lihat', ['as' => 'lihat', 'uses' => 'H5Controller@lihat']);
            Route::get('unduh/{apm}', ['as' => 'unduh', 'uses' => 'H5Controller@unduh']);
        });
        Route::group(['prefix' => 'h11', 'as' => 'h11-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'H11Controller@index']);
            Route::get('unduh/{apm}/{model}/{periode}', ['as' => 'unduh', 'uses' => 'H11Controller@unduh']);
        });
        Route::group(['prefix' => 'h12', 'as' => 'h12-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'H12Controller@index']);
            Route::get('unduh/{apm}/{model}/{supplier}', ['as' => 'h12unduh', 'uses' => 'H12Controller@unduh']);
        });
        Route::group(['prefix' => 'lap1', 'as' => 'lap1-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'LAP1Controller@index']);
            Route::get('unduh/{apm}/{model}/{supplier}', ['as' => 'lap1unduh', 'uses' => 'LAP1Controller@unduh']);
        });
        Route::group(['prefix' => 'lap2', 'as' => 'lap2-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'LAP2Controller@index']);
            Route::get('unduh/{apm}/{model}/{supplier}', ['as' => 'lap2unduh', 'uses' => 'LAP2Controller@unduh']);
        });
        Route::group(['prefix' => 'lap3', 'as' => 'lap3-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'LAP3Controller@index']);
            Route::get('unduh/{apm}/{model}/{supplier}', ['as' => 'lap3unduh', 'uses' => 'LAP3Controller@unduh']);
        });
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'skvi', 'namespace' => 'SKVI', 'as' => 'skvi-'], function () {
    Route::get('/', ['middleware' => 'role:superadmin|kemenperin|admin|operator|ta', 'as' => 'index', 'uses' => 'SkviController@index']);
    Route::get('{apm}/unduh/{periode?}', ['middleware' => 'role:superadmin|kemenperin|admin|operator|ta', 'as' => 'unduh', 'uses' => 'SkviController@unduh']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'master-data', 'namespace' => 'MasterData'], function () {
    Route::group(['middleware' => 'role:superadmin|admin', 'as' => 'master-data-'], function () {
        Route::group(['prefix' => 'apm', 'as' => 'apm-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ApmController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'ApmController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ApmController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ApmController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'ApmController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'ApmController@delete']);
        });
        Route::group(['prefix' => 'merek', 'as' => 'merek-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'MerekController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'MerekController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'MerekController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'MerekController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'MerekController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'MerekController@delete']);
        });
        Route::group(['prefix' => 'komponen', 'as' => 'komponen-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'KomponenController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'KomponenController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'KomponenController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'KomponenController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'KomponenController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'KomponenController@delete']);
        });
        Route::group(['prefix' => 'model', 'as' => 'model-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ModelController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'ModelController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ModelController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ModelController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'ModelController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'ModelController@delete']);
        });
        Route::group(['prefix' => 'supplier', 'as' => 'supplier-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'SupplierController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'SupplierController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'SupplierController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'SupplierController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'SupplierController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'SupplierController@delete']);
        });
        Route::group(['prefix' => 'kapasitas-silinder', 'as' => 'kapasitas-silinder-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'KapasitasSilinderController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'KapasitasSilinderController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'KapasitasSilinderController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'KapasitasSilinderController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'KapasitasSilinderController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'KapasitasSilinderController@delete']);
        });
        Route::group(['prefix' => 'periode', 'as' => 'periode-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'PeriodeController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'PeriodeController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'PeriodeController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'PeriodeController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'PeriodeController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'PeriodeController@delete']);
        });
        Route::group(['prefix' => 'manufakturing', 'as' => 'manufakturing-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ManufakturingController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'ManufakturingController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ManufakturingController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ManufakturingController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'ManufakturingController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'ManufakturingController@delete']);
        });
        Route::group(['prefix' => 'investasi-apm', 'as' => 'investasi-apm-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'InvestasiApmController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'InvestasiApmController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'InvestasiApmController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'InvestasiApmController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'InvestasiApmController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'InvestasiApmController@delete']);
        });
        Route::group(['prefix' => 'produksi-terpasang', 'as' => 'produksi-terpasang-'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ProduksiTerpasangController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'ProduksiTerpasangController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ProduksiTerpasangController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ProduksiTerpasangController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'ProduksiTerpasangController@update']);
            Route::post('{id}/delete', ['as' => 'delete', 'uses' => 'ProduksiTerpasangController@delete']);
        });
    });

    Route::group(['middleware' => 'role:superadmin|kemenperin|admin|operator|ta', 'as' => 'master-data-'], function () {
        Route::group(['prefix' => 'apm', 'as' => 'apm-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'ApmController@cari']);
        });

        Route::group(['prefix' => 'merek', 'as' => 'merek-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'MerekController@cari']);
        });

        Route::group(['prefix' => 'komponen', 'as' => 'komponen-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'KomponenController@cari']);
        });

        Route::group(['prefix' => 'model', 'as' => 'model-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'ModelController@cari']);
        });

        Route::group(['prefix' => 'supplier', 'as' => 'supplier-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'SupplierController@cari']);
        });

        Route::group(['prefix' => 'kapasitas-silinder', 'as' => 'kapasitas-silinder-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'KapasitasSilinderController@cari']);
        });

        Route::group(['prefix' => 'periode', 'as' => 'periode-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'PeriodeController@cari']);
        });
        Route::group(['prefix' => 'manufakturing', 'as' => 'manufakturing-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'ManufakturingController@cari']);
        });
        Route::group(['prefix' => 'investasi-apm', 'as' => 'apm-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'InvestasiApmController@cari']);
        });
        Route::group(['prefix' => 'produksi-terpasang', 'as' => 'produksi-terpasang-'], function () {
            Route::get('cari', ['as' => 'cari', 'uses' => 'ProduksiTerpasangController@cari']);
        });
    });
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'user'], function () {
    Route::group(['middleware' => 'role:superadmin|admin'], function () {
        Route::group(['as' => 'user.'], function () {
            Route::get('/', ['as' => 'indexuser', 'uses' => 'UserController@index']);
            Route::get('create', ['as' => 'createuser', 'uses' => 'UserController@create']);
            Route::post('store', ['as' => 'storeuser', 'uses' => 'UserController@store']);
            Route::get('{user_id}/view', ['as' => 'viewuser', 'uses' => 'UserController@view']);
            Route::get('{user_id}/edit', ['as' => 'edituser', 'uses' => 'UserController@edit']);
            Route::post('{user_id}/update', ['as' => 'updateuser', 'uses' => 'UserController@update']);
            Route::post('{user_id}/delete', ['as' => 'deleteuser', 'uses' => 'UserController@delete']);
        });
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('/', ['as' => 'indexrole', 'uses' => 'RoleController@index']);
            Route::get('create', ['as' => 'createrole', 'uses' => 'RoleController@create']);
            Route::post('store', ['as' => 'storerole', 'uses' => 'RoleController@store']);
            Route::get('{role_id}/edit', ['as' => 'editrole', 'uses' => 'RoleController@edit']);
            Route::post('{role_id}/update', ['as' => 'updaterole', 'uses' => 'RoleController@update']);
            Route::post('{role_id}/delete', ['as' => 'deleterole', 'uses' => 'RoleController@delete']);
        });
        Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
            Route::get('/', ['as' => 'indexpermission', 'uses' => 'PermissionController@index']);
            Route::get('create', ['as' => 'createpermission', 'uses' => 'PermissionController@create']);
            Route::post('store', ['as' => 'storepermission', 'uses' => 'PermissionController@store']);
            Route::get('{permission_id}/edit', ['as' => 'editpermission', 'uses' => 'PermissionController@edit']);
            Route::post('{permission_id}/update', ['as' => 'updatepermission', 'uses' => 'PermissionController@update']);
            Route::post('{permission_id}/delete', ['as' => 'deletepermission', 'uses' => 'PermissionController@delete']);
        });
    });
    Route::group(['middleware' => 'permission:Update Profile'], function () {
        Route::get('/profile/{user_id}', ['as' => 'profile', 'uses' => 'UserController@profile']);
        Route::post('/profile/{user_id}/update', ['as' => 'profileupdate', 'uses' => 'UserController@update_profile']);
    });
});
