<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\SupplierDataTable;
use App\Http\Requests\MasterData\SupplierRequest;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\MasterData\Eloquent\ApmEloquent;
use App\Repository\MasterData\Eloquent\SupplierPicEloquent;

class SupplierController extends Controller
{
    private $supplierRepository;
    private $apmRepository;
    private $supplierPicRepository;

    public function __construct(SupplierInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->apmRepository = new ApmEloquent();
        $this->supplierPicRepository = new SupplierPicEloquent();
    }

    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('MasterData.Supplier.Index');
    }

    public function create()
    {
        $apm = $this->apmRepository->all();

        return view('MasterData.Supplier.Create')->with('apm', $apm);
    }

    public function store(SupplierRequest $request)
    {
        $this->supplierRepository->store($request->all());

        return redirect()->route('master-data-supplier-index')->with('success', 'Data Supplier berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $supplier = $this->supplierRepository->findById($request->id);
        $apm = $this->apmRepository->supplierPic($request->id);
        $pic = $this->supplierPicRepository->findBySupplierId($request->id);

        return view('MasterData.Supplier.Edit', compact(["supplier","apm","pic"]));
    }

    public function update(SupplierRequest $request)
    {
        $this->supplierRepository->update($request->all());

        return redirect()->route('master-data-supplier-index')->with('success', 'Data Supplier berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->supplierRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->supplierRepository->cari($request->q);
    }
}
