<?php

namespace App\Http\Controllers\ProductionForm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductionForm\SupplierRequest;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;
use App\Repository\MasterData\Interfaces\KomponenModelInterface;


class SupplierController extends Controller
{

    private $supplierInterface;

    public function __construct(SupplierInterface $supplierInterface)
    {
        $this->data['title'] = 'Supplier Component';
        $this->data['breadcrumb'] = $this->breadcrumb($this->data['title']);

        $this->supplierInterface = $supplierInterface;
    }

    public function index()
    {
        return view('admin.production_form.supplier.index', ['data' => $this->data]);
    }

    public function create(KomponenModelInterface $componentModel)
    {
        $this->data['lists'] = $this->supplierInterface->getData(['model_id' => request()->model_id,'component_category' => request()->component_category]);
        $this->data['components'] = $componentModel->getDataKomponentModel(['model_id' => request()->model_id, 'component_category' => request()->component_category]);

        return view('admin.production_form.supplier.create', ['data' => $this->data]);
    }

    public function store(Request $request)
    {
        if($this->supplierInterface->store($request->all())){
            return redirect()->route('form_produksi.supplier.create-supplier', ['model_id' => request()->model_id, 'component_category' => request()->component_category])->with('success', 'Data Supplier berhasil disimpan');
        }
    }

    public function update(Request $request)
    {
        if($this->supplierInterface->update($request->all())){
            return redirect()->route('form_produksi.supplier.create-supplier', ['model_id' => request()->model_id, 'component_category' => request()->component_category])->with('success', 'Data Supplier berhasil disimpan');
        }

    }

    public function delete(Request $request)
    {
        if($this->supplierInterface->delete($request->id)) {
            return response()->json([
                'code' => 200,
                'message' => 'Data supplier berhasil dihapus'
            ], 200);
        }
    }
}
