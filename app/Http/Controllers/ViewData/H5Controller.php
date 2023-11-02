<?php

namespace App\Http\Controllers\ViewData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;
use App\DataTables\ViewData\H5DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\H5Export;

class H5Controller extends Controller
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

    public function h5Index()
    {
        return view('ViewData.H5.Index');
    }

    public function h5Lihat(Request $request, H5DataTables $dataTable)
    {
        if ($request->apm_id) {
            $apm = $this->apmRepository->findById($request->apm_id);

            // Get all model_id by apm_id
            $model = $this->modelRepository->findByApmId($request->apm_id);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getSupplierByModelId($model);

            return view('ViewData.H5.Lihat', compact(['apm','supplierComponent']));
        }else{
            return redirect()->route('view-data-h5-index')->with('danger', 'Pilihan Data Perusahaan APM harus terisi');
        }
    }

    public function h5Unduh(Request $request)
    {
        if ($request->apm) {
            $apm = $this->apmRepository->findById($request->apm);

            // Get all model_id by apm
            $model = $this->modelRepository->findByApmId($request->apm);

            // Get all supplier by model_id
            $supplierComponent = $this->componentSupplier->getSupplierByModelId($model);

            return Excel::download(new H5Export($apm, $supplierComponent), 'Data_H5_' .$apm->slug. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }
}
