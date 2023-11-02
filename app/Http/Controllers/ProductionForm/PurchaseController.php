<?php

namespace App\Http\Controllers\ProductionForm;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductionForm\Supplier;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\ProductionForm\Interfaces\SellingInterface;
use App\Repository\ProductionForm\Interfaces\PurchaseInterface;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;
use App\Repository\MasterData\Interfaces\KomponenModelInterface;

class PurchaseController extends Controller
{
    private $purchaseInterface;

    public function __construct(PurchaseInterface $purchaseInterface)
    {
        $this->data['title'] = 'Delivery Komponen';
        $this->data['breadcrumb'] = $this->breadcrumb($this->data['title']);

        $this->purchaseInterface = $purchaseInterface;
    }

    public function index()
    {
        return view('admin.production_form.purchase.index', ['data' => $this->data]);
    }
    
    public function create(Request $request, PeriodeInterface $periode, KomponenModelInterface $componentModel, SellingInterface $selling, SupplierInterface $supplier)
    {

        // get data periode from periode table master periode 
        $this->data['period'] = $periode->findById($request->period_id);
        
        $this->data['suppliers'] = $supplier->getDataSupplier(['model_id' => request()->model_id, 'supplier_id' => request()->supplier]);

        // get data month range from table master_periode
        $this->data['ranges'] = $periode->purchasePeriode(['mulai' => $this->data['period']->mulai, 'selesai' => $this->data['period']->selesai]);

        // get data penjualan from table production_selling
        $this->data['selling'] = $selling->getdataByMonth(['mulai' => $this->data['period']->mulai, 'selesai' => $this->data['period']->selesai]);

        // get data component from table komponen_model_master
        $this->data['components'] = $componentModel->getDataKomponentModel(['model_id' => request()->model_id, 'component_category' => request()->component_category]);

        // get data supplier component from table component_supplier
        $this->data['componentSuppliers'] = $supplier->getDataComponentSupplier(['model_id' => request()->model_id, 'component_category' => request()->component_category]);

        // get data purchase from component_purchase
        $this->data['componentPurchase'] = $this->purchaseInterface->getDataComponentPurchase(['model_id' => request()->model_id, 'period_id' => request()->period_id, 'component_category' => request()->component_category]);

    
        return view('admin.production_form.purchase.create', ['data' => $this->data]);
    }

    public function store(Request $request)
    {
        if($this->purchaseInterface->store($request->all())) {
            return redirect()->route('form_produksi.purchase.create-purchase', [
                'model_id' => $request->model_id, 
                'period_id' => $request->period_id,
                'component_category' => $request->component_category
            ])->with('success', 'Data Delivery Komponen berhasil disimpan');
        }   
    }

    public function period(PeriodeInterface $periode)
    {
        $this->data['periods'] = $periode->getPeriodeByModelId(request()->model_id);
        
        return view('admin.production_form.purchase.periode', ['data' => $this->data]);
    }

}
