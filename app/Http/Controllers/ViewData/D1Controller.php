<?php

namespace App\Http\Controllers\ViewData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;
use App\DataTables\ViewData\D1ADataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\D1AExport;
use App\Exports\D1BExport;
use App\Exports\D1CExport;

class D1Controller extends Controller
{
    private $apmRepository;
    private $modelRepository;
    private $componentSupplier;

    public function __construct(ApmInterface $apmRepository, ModelInterface $modelRepository, SupplierInterface $componentSupplier)
    {
        $this->apmRepository = $apmRepository;
        $this->modelRepository = $modelRepository;
        $this->componentSupplier = $componentSupplier;
    }

    public function d1aIndex()
    {
        return view('ViewData.D1A.Index');
    }

    public function d1aLihat(Request $request, D1ADataTables $dataTable)
    {
        if ($request->apm_id) {
            $apm = $this->apmRepository->findById($request->apm_id);

            // Get all model_id by apm_id
            $model = $this->modelRepository->findByApmId($request->apm_id);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getSupplierByModelId($model);

            return view('ViewData.D1A.Lihat', compact(['apm','supplierComponent']));
        }else{
            return redirect()->route('view-data-d1a-index')->with('danger', 'Pilihan Data Perusahaan APM harus terisi');
        }
    }

    public function d1aUnduh(Request $request)
    {
        if ($request->apm) {
            $apm = $this->apmRepository->findById($request->apm);

            // Get all model_id by apm
            $model = $this->modelRepository->findByApmId($request->apm);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getSupplierByModelId($model);

            return Excel::download(new D1AExport($apm, $supplierComponent), 'Data_D1A_' .$apm->slug. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }

    public function d1bIndex()
    {
        return view('ViewData.D1B.Index');
    }

    public function d1bLihat(Request $request)
    {
        if ($request->apm_id) {
            $apm = $this->apmRepository->findById($request->apm_id);

            // Get all model_id by apm_id
            $model = $this->modelRepository->findByApmId($request->apm_id);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getSubSupplierByModelId($model);

            return view('ViewData.D1B.Lihat', compact(['apm','supplierComponent']));
        }else{
            return redirect()->route('view-data-d1b-index')->with('danger', 'Pilihan Data Perusahaan APM harus terisi');
        }
    }

    public function d1bUnduh(Request $request)
    {
        if ($request->apm) {
            $apm = $this->apmRepository->findById($request->apm);

            // Get all model_id by apm
            $model = $this->modelRepository->findByApmId($request->apm);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getSubSupplierByModelId($model);

            return Excel::download(new D1BExport($apm, $supplierComponent), 'Data_D1B_' .$apm->slug. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }

    public function d1cIndex()
    {
        return view('ViewData.D1C.Index');
    }

    public function d1cLihat(Request $request)
    {
        if ($request->apm_id) {
            $apm = $this->apmRepository->findById($request->apm_id);

            // Get all model_id by apm_id
            $model = $this->modelRepository->findByApmId($request->apm_id);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getInHouseByModelId($model);

            return view('ViewData.D1C.Lihat', compact(['apm','supplierComponent']));
        }else{
            return redirect()->route('view-data-d1c-index')->with('danger', 'Pilihan Data Perusahaan APM harus terisi');
        }
    }

    public function d1cUnduh(Request $request)
    {
        if ($request->apm) {
            $apm = $this->apmRepository->findById($request->apm);

            // Get all model_id by apm
            $model = $this->modelRepository->findByApmId($request->apm);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getInHouseByModelId($model);

            return Excel::download(new D1CExport($apm, $supplierComponent), 'Data_D1C_' .$apm->slug. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }

}
