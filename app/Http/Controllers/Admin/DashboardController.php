<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\MasterData\Interfaces\KomponenInterface;
use App\Repository\ProductionForm\Interfaces\SellingInterface;
use App\Repository\ProductionForm\Interfaces\PurchaseInterface;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;

class DashboardController extends Controller
{
    public function index(ApmInterface $apm, KomponenInterface $komponen_kategori)
    {
        $this->data['apm'] = $apm->all();

        if(!empty(request()->apm)) {   
            $this->data['detail_apm'] = $apm->findById(request()->apm);
        }

        if(!empty(request()->komponen_kategori)) {
            $this->data['komponen_kategori'] = $komponen_kategori->findByMasterKategoriKomponen(request()->komponen_kategori);
        }

        return view('admin.dashboard.index', ['data' => $this->data]);
    }

    public function report_apm(ModelInterface $modeInterface)
    {
        return $modeInterface->report_apm();
    }

    public function report_pohon_industri(SupplierInterface $supplierInterface)
    {
        return $supplierInterface->report_pohon_industri();
    }

    public function report_pohon_industri_kategori_komponen(SupplierInterface $supplierInterface, Request $request)
    {
        return $supplierInterface->report_pohon_industri_kategori_komponen($request->nama_kategori_komponen);
    }

    public function report_pohon_industri_supplier(SupplierInterface $supplierInterface, Request $request)
    {
        return $supplierInterface->report_pohon_industri_supplier($request->kategori_Id);
    }

    public function report_rencana_produksi_dan_penjualan(SellingInterface $sellingInterface)
    {
        return $sellingInterface->report_rencana_produksi_dan_penjualan();
    }

    public function report_realisasi_produksi_dan_penjualan(SellingInterface $sellingInterface)
    {
        return $sellingInterface->report_realisasi_produksi_dan_penjualan();
    }

    public function report_realisasi_komponen_lokal_apm(PurchaseInterface $purchaseInterface)
    {
        return $purchaseInterface->report_realisasi_komponen_lokal_apm();
    }

    public function report_realisasi_komponen_lokal_model(PurchaseInterface $purchaseInterface)
    {
        return $purchaseInterface->report_realisasi_komponen_lokal_model();
    }

    public function report_penjualan_model(SellingInterface $sellingInterface)
    {
        return $sellingInterface->report_penjualan_model();
    }

    public function report_supplier_apm_kelompok_komponen(SupplierInterface $supplieInterface)
    {
        return $supplieInterface->report_supplier_apm_kelompok_komponen();
    }

    public function report_supplier_komponen_apm(SupplierInterface $supplieInterface)
    {
        return $supplieInterface->report_supplier_komponen_apm();
    }
}
