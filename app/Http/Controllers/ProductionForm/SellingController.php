<?php

namespace App\Http\Controllers\ProductionForm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductionForm\SellingDataTable;
use App\Http\Requests\ProductionForm\SellingRequest;
use App\Repository\ProductionForm\Interfaces\SellingInterface;

class SellingController extends Controller
{

    private $sellingInterface;

    public function __construct(SellingInterface $sellingInterface)
    {
        $this->data['title'] = 'Produksi & Penjualan';
        $this->data['breadcrumb'] = $this->breadcrumb($this->data['title']);
        
        $this->sellingInterface = $sellingInterface;
    }

    public function index(SellingDataTable $dataTable)
    {
        return $dataTable->render('admin.production_form.selling.index', ['data' => $this->data]);
    }

    public function create(Request $request)
    {
        return view('admin.production_form.selling.create', ['data' => $this->data]);
    }

    public function store(SellingRequest $request) 
    {
        if($this->sellingInterface->store($request->all())) {
            return redirect()->route('form_produksi.selling.index-selling', ['model_id' => request()->model_id])->with('success', 'Data Produksi & Penjualan behasil disimpan');
        }
    }

    public function edit(Request $request)
    {
        $this->data['selling'] = $this->sellingInterface->findById($request->selling_id);

        return view('admin.production_form.selling.edit', ['data' => $this->data]);
    }

    public function update(SellingRequest $request)
    {
        if($this->sellingInterface->update($request->all())) {
            return redirect()->route('form_produksi.selling.index-selling', ['model_id' => request()->model_id])->with('success', 'Data Produksi & Penjualan behasil disimpan');
        }

    }

    public function import(Request $request)
    {
        if($this->sellingInterface->excel($request->file('selling'))) {
            return redirect()->route('form_produksi.selling.index-selling', ['model_id' => request()->model_id])->with('success', 'Data Produksi & Penjualan behasil disimpan');
        }
    }

    public function delete(Request $request)
    {
        return $this->sellingInterface->delete($request->selling_id);
    }
}
