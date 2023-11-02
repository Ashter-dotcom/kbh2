<?php

namespace App\Http\Controllers\ProfilPerusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\ProfilPerusahaan\PerusahaanSupplierDataTable;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\ProfilPerusahaan\Eloquent\ProfilPerusahaanSupplierEloquent;

class ProfilSupplierController extends Controller
{
    private $supplierRepository;
    private $profilPerusahaanSupplierInterface;

    public function __construct(SupplierInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->profilPerusahaanSupplierInterface = new ProfilPerusahaanSupplierEloquent();
    }

    public function index(PerusahaanSupplierDataTable $dataTable)
    {
        return $dataTable->render('ProfilPerusahaan.Supplier.Index');
    }

    public function editSebelum(Request $request)
    {
        $supplier = $this->supplierRepository->findById($request->id);
        $periodeTahun = Config('params')['periode-tahun']['pertama']['sebelum'];
        $data = $this->profilPerusahaanSupplierInterface->findByPerusahaanSupplierId($request->id);

        return view('ProfilPerusahaan.Supplier.EditSebelum', compact(["supplier","periodeTahun","data"]));
    }

    public function updateSebelum(Request $request)
    {
        $this->profilPerusahaanSupplierInterface->update($request->all());

        return redirect()->route('profil-perusahaan-supplier-index')->with('success', 'Data Profil Perusahaan Supplier Sebelum Insentif berhasil disimpan');
    }

    public function editSetelah(Request $request)
    {
        $supplier = $this->supplierRepository->findById($request->id);
        $periodeTahun = Config('params')['periode-tahun']['pertama']['setelah'];
        $data = $this->profilPerusahaanSupplierInterface->findByPerusahaanSupplierId($request->id);

        return view('ProfilPerusahaan.Supplier.EditSetelah', compact(["supplier","periodeTahun","data"]));
    }

    public function updateSetelah(Request $request)
    {
        $this->profilPerusahaanSupplierInterface->update($request->all());

        return redirect()->route('profil-perusahaan-supplier-index')->with('success', 'Data Profil Perusahaan Supplier Setelah Insentif berhasil disimpan');
    }
}
