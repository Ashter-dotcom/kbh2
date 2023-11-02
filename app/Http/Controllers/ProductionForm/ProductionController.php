<?php

namespace App\Http\Controllers\ProductionForm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductionForm\Supplier;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;
use App\Repository\ProductionForm\Interfaces\ProductionInterface;


class ProductionController extends Controller
{
    private $productionInterface;

    public function __construct(ProductionInterface $productionInterface)
    {
        $this->data['title'] = 'Produksi Supplier';
        $this->data['breadcrumb'] = $this->breadcrumb($this->data['title']);

        $this->productionInterface = $productionInterface;

    }

    public function index()
    {
        return view('admin.production_form.production.index', ['data' => $this->data]);
    }

    public function create(Request $request, SupplierInterface $supplierInterface, PeriodeInterface $periode)
    {
        $this->data['period'] = $periode->findById($request->period_id);
        // $this->data['ranges'] = $periode->productionPeriode(['mulai' => $this->data['period']->mulai, 'selesai' => $this->data['period']->selesai]);
        $this->data['suppliers'] = $supplierInterface->getDataSupplier(['model_id' => request()->model_id, 'supplier_id' => request()->supplier]);
        $this->data['periods'] = $periode->productionPeriods();
        $this->data['productionSuppliers'] = $this->productionInterface->getDataProductionSuppliers(['model_id' => request()->model_id]);

        return view('admin.production_form.production.create', ['data' => $this->data]);
    }

    public function store(Request $request)
    {
        if($this->productionInterface->store($request->all())) {
            return redirect()->route('form_produksi.production.create-production', ['model_id' => $request->model_id, 'supplier' => $request->supplier, 'page' => $request->page])->with('success', 'Data Produksi Supplier berhasil disimpan');
        }

    }
    public function period(PeriodeInterface $periode)
    {
        $this->data['periods'] = $periode->getPeriodeByModelId(request()->model_id);
        
        return view('admin.production_form.production.periode', ['data' => $this->data]);
    }
}
