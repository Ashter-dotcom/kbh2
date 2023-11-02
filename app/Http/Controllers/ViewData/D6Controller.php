<?php

namespace App\Http\Controllers\ViewData;


use App\Exports\D6Export;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductionForm\Supplier;
use App\Models\ProductionForm\Purchase;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\MasterData\Interfaces\KomponenInterface;

class D6Controller extends Controller
{
    private $apmRepository;
    private $modelRepository;
    private $periodeRepository;
    private $komponenRepository;
    private $supplierRepository;

    public function __construct(ApmInterface $apmRepository, PeriodeInterface $periodeRepository, ModelInterface $modelRepository, KomponenInterface $komponenRepository, SupplierInterface $supplierRepository)
    {
        $this->apmRepository = $apmRepository;
        $this->modelRepository = $modelRepository;
        $this->periodeRepository = $periodeRepository;
        $this->komponenRepository = $komponenRepository;
        $this->supplierRepository = $supplierRepository;
    }

    public function Index()
    {
        if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->periode)) {
            
            $this->data['no'] = 1;
            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['model'] = $this->modelRepository->findById(request()->model);
            $this->data['periode'] = $this->periodeRepository->findById(request()->periode);
            $this->data['results'] = $this->d6Data($this->apmRepository, $this->komponenRepository, $this->supplierRepository);
        }
        
        return view('ViewData.D6.Index', ['data' => $this->data]);
    }

  
    public function unduh(Request $request)
    {
        if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->periode)) {
            $apm = $this->apmRepository->findById(request()->apm);
            $model = $this->modelRepository->findById(request()->model);
            $periode = $this->periodeRepository->findById(request()->periode);
            $results = $this->d6Data($this->apmRepository, $this->komponenRepository, $this->supplierRepository);

            return Excel::download(new D6Export($results, $apm, $periode, $model), 'DataD6'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }
        
        return  false;
    }

    public function d6Data($apm, $komponen, $supplier)
    {
        $data = [];
        $finalData = [];
        $dataKomponen = [];
        $dataSupplier = [];
        $dataPembelian = [];
        $total_supplier = [];
        $listKeyKategori = [];
        $listKeySupplier = [];
        $listActualComponenName = [];
        
        
        $dataLocalComponent = Purchase::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->where('id', request()->apm);
        })->with('masterDataKategoriKomponen')->where(['model_id' => request()->model, 'periode_id' => request()->periode])->get();

        foreach($dataLocalComponent as $keyDataLocalComponent => $valueDataLocalComponent) {
            $kategoriId = !empty($valueDataLocalComponent->masterDataKategoriKomponen) ? $valueDataLocalComponent->masterDataKategoriKomponen->id : '-';
            $data[$kategoriId] = [
                'kelompok' => !empty($valueDataLocalComponent->masterDataKategoriKomponen) ? $valueDataLocalComponent->masterDataKategoriKomponen->nama_kategori_komponen : '-',
                'pembelian' => json_decode($valueDataLocalComponent['pembelian'], true),
            ];
        }

        foreach($data as $keyKategori => $searchKeyKategori) {
            foreach($searchKeyKategori['pembelian'] as $keySupplier => $valueSupplier) {

                foreach($valueSupplier as $keyKategori => $valueKategori) {
                    $listKeyKategori[] = $keyKategori;
                }

                foreach($valueKategori as $keySupplier => $valueSupplier) {
                    $listKeySupplier[] = $keySupplier;
                }
            }
        }

        $listKomponens = $komponen->findByMultipleId($listKeyKategori);
        $listSuppliersFromApm = $apm->findByMultipleId($listKeySupplier);
        $listSuppliers = $supplier->findByMultipleId($listKeySupplier);


        if(!empty($listKomponens)) {
            foreach($listKomponens as $listKomponen) {
                $dataKomponen[$listKomponen->id] = [
                    'kategori_id' => $listKomponen->kategori_id,
                    'komponen_id' => $listKomponen->id,
                    'komponen_nama' => $listKomponen->nama_komponen
                ];
            }
        }

        if(!empty($listSuppliersFromApm)) {
            foreach($listSuppliersFromApm as $listSupplier) {
                $dataSupplier[$listSupplier->id] = [
                    'komponen_id' => $listSupplier->id,
                    'nama_perusahaan_supplier' => $listSupplier->nama_perusahaan_apm
                ];
            }
        }

        if(!empty($listSuppliers)) {
            foreach($listSuppliers as $listSupplier) {
                $dataSupplier[$listSupplier->id] = [
                    'komponen_id' => $listSupplier->id,
                    'nama_perusahaan_supplier' => $listSupplier->nama_perusahaan_supplier
                ];
            }
        }

        $actualComponentName = Supplier::select('component_id','actual_component_name','model_id', 'supplier_id')->whereIn('component_id', $listKeyKategori)->where('model_id', request()->model)->get();

        foreach($actualComponentName as $keyActualComponentName => $dataActualComponentName) {

            $perusahaan_supplier = !empty($dataSupplier[$dataActualComponentName->supplier_id]['nama_perusahaan_supplier']) ? $dataSupplier[$dataActualComponentName->supplier_id]['nama_perusahaan_supplier'] : '';

            $listActualComponenName[$dataActualComponentName->component_id][] = [
                'supplier' => !empty($dataSupplier[$dataActualComponentName->supplier_id]['nama_perusahaan_supplier']) ? $dataSupplier[$dataActualComponentName->supplier_id]['nama_perusahaan_supplier'] : $dataSupplier[request()->apm]['nama_perusahaan_supplier'],
                'actual_component_name' => $dataActualComponentName->actual_component_name
            ];

            $total_supplier[$perusahaan_supplier] = $perusahaan_supplier;
        }

        foreach($dataKomponen as $keyDataKomponen => $valueDataKomponen) {
            $dataPembelian[$data[$valueDataKomponen['kategori_id']]['kelompok']][$valueDataKomponen['komponen_nama']] = $listActualComponenName[$keyDataKomponen];
        }

        foreach($dataPembelian as $keyKategoriMaster => $valueKategoriMaster) {            

            foreach($valueKategoriMaster as $keyKategori => $valueKategori) {

                foreach($valueKategori as $keySupplierAndActualComponentName => $valueSupplierAndActualComponentName) {

                    $finalData[$keyKategori]['kelompok'] = $keyKategoriMaster;
                    $finalData[$keyKategori]['kategori'] = $keyKategori;
                    $finalData[$keyKategori]['supplier'][] = $valueSupplierAndActualComponentName['supplier'];
                    $finalData[$keyKategori]['actual_component_name'][] = $valueSupplierAndActualComponentName['actual_component_name'];
                }
            } 
        }
        
        return [
            'data' => $finalData,
            'total_supplier' => count(array_values(array_filter($total_supplier)))
        ];
    }

}