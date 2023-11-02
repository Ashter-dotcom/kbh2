<?php

namespace App\Http\Controllers\ViewData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\ProfilPerusahaan\Interfaces\ProfilPerusahaanSupplierInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\D5AExport;
use App\Exports\D5BExport;

class D5Controller extends Controller
{
    private $supplierRepository;
    private $profilPerusahaanSupplier;
    private $attribute;
    private $periodeTahun;

    public function __construct(SupplierInterface $supplierRepository, ProfilPerusahaanSupplierInterface $profilPerusahaanSupplier)
    {
        $this->supplierRepository = $supplierRepository;
        $this->profilPerusahaanSupplier = $profilPerusahaanSupplier;
        $this->attribute = Config('params')['profil']['supplier'];
        $this->periodeTahun = Config('params')['periode-tahun']['pertama'];
    }

    public function d5aIndex()
    {
        return view('ViewData.D5A.Index');
    }

    public function d5aLihat(Request $request)
    {
        if (!empty($request->supplier)) {
            $supplier = $this->supplierRepository->findById($request->supplier);
            $profil = $this->profilPerusahaanSupplier->findByPerusahaanSupplierId($request->supplier);
            $kondisi = 'sebelum';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;
            
            return view('ViewData.D5A.Lihat', compact(["supplier","profil","attribute","kondisi","periodeTahun"]));
        }else{
            return redirect()->route('view-data-d5a-index')->with('danger', 'Pilihan Data Perusahaan Supplier harus terisi');
        }
    }

    public function d5aUnduh(Request $request)
    {
        if (!empty($request->supplier)) {
            $supplier = $this->supplierRepository->findById($request->supplier);
            $profil = $this->profilPerusahaanSupplier->findByPerusahaanSupplierId($request->supplier);
            $kondisi = 'sebelum';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;

            return Excel::download(new D5AExport($supplier, $profil, $attribute, $kondisi, $periodeTahun), 'Data_D5A_' .$supplier->nama_perusahaan_supplier. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }

    public function d5bIndex()
    {
        return view('ViewData.D5B.Index');
    }

    public function d5bLihat(Request $request)
    {
        if (!empty($request->supplier)) {
            $supplier = $this->supplierRepository->findById($request->supplier);
            $profil = $this->profilPerusahaanSupplier->findByPerusahaanSupplierId($request->supplier);
            $kondisi = 'setelah';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;
            
            return view('ViewData.D5B.Lihat', compact(["supplier","profil","attribute","kondisi","periodeTahun"]));
        }else{
            return redirect()->route('view-data-d5b-index')->with('danger', 'Pilihan Data Perusahaan Supplier harus terisi');
        }
    }

    public function d5bUnduh(Request $request)
    {
        if (!empty($request->supplier)) {
            $supplier = $this->supplierRepository->findById($request->supplier);
            $profil = $this->profilPerusahaanSupplier->findByPerusahaanSupplierId($request->supplier);
            $kondisi = 'setelah';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;

            return Excel::download(new D5BExport($supplier, $profil, $attribute, $kondisi, $periodeTahun), 'Data_D5B_' .$supplier->nama_perusahaan_supplier. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }

}
