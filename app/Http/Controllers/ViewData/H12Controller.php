<?php

namespace App\Http\Controllers\ViewData;


use App\Exports\H12Export;
use Illuminate\Http\Request;
use App\Models\MasterData\Periode;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductionForm\Purchase;
use App\Models\ProductionForm\Supplier;
use App\Models\ProductionForm\Production;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Models\ProfilPerusahaan\ProfilPerusahaanSupplier;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\ProductionForm\Interfaces\SupplierInterface as ComponentSupplierInterface;

class H12Controller extends Controller
{
    private $apmRepository;
    private $modelRepository;
    private $supplierRepository;
    private $periodeInterface;
    private $componentSupplierInterface;

    public function __construct(ApmInterface $apmRepository, ModelInterface $modelRepository, SupplierInterface $supplierRepository, ComponentSupplierInterface $componentSupplierInterface, PeriodeInterface $periodeInterface)
    {
        $this->apmRepository = $apmRepository;
        $this->modelRepository = $modelRepository;
        $this->supplierRepository = $supplierRepository;
        $this->periodeInterface = $periodeInterface;
        $this->componentSupplierInterface = $componentSupplierInterface;
    }

    public function Index()
    {
        if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->supplier)) {

            $this->data['no'] = 1;
            $this->data['bulan'] = $this->month();
            $this->data['dataKaryawan'] = $this->jumlahKaryawan();
            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['model'] = $this->modelRepository->findById(request()->model);
            $this->data['supplier'] = $this->supplierRepository->findById(request()->supplier);
            $this->data['results'] = $this->h12Data($this->modelRepository, $this->supplierRepository, $this->componentSupplierInterface, $this->periodeInterface);
        }
        return view('ViewData.H12.Index', ['data' => $this->data]);
    }

    public function uhduh(Request $request)
    {
        $apm = $this->apmRepository->findById($request->id);

        return view('ViewData.H12.Lihat', compact("apm"));
    }

    public function h12data($model, $supplier, $componentSuppliers, $periode)
    {
        $totals = 1;
        $dataProductionsAndDelivery = [];

        $productions = $this->getDataProducstions();
        $deliveries = $this->getDataDeliveries($componentSuppliers, $periode);

        foreach($productions as $production) {

            $componentId = !empty($production->componentSupplier) ? $production->componentSupplier->component_id : '';
            $komponentSupplierId = !empty($production->komponen_supplier_id) ? $production->komponen_supplier_id : '';


            $stock = !empty($production->stock) ? $production->stock : 0;

            $delivery = !empty($deliveries[$komponentSupplierId][$componentId]) ? $deliveries[$komponentSupplierId][$componentId] : '';
            $produksi = !empty($production->produksi) ? $this->merge_array_recursive_from_json(json_decode($production->produksi, true)) : '';

            $dataProductionsAndDelivery['totals'] = $totals++;
            $dataProductionsAndDelivery['productionsanddevlivery'][$componentId]['component_name'] = !empty($production->componentSupplier->masterDataKomponen) ? $production->componentSupplier->masterDataKomponen->nama_komponen : '';

            $dataProductionsAndDelivery['productionsanddevlivery'][$componentId]['data'][] = [
                'stock' => $stock,
                'actual_component_name' => !empty($production->componentSupplier->actual_component_name) ? $production->componentSupplier->actual_component_name : '',
                'produksi' => [
                    'month' => $produksi,
                    'total' => !empty($production->produksi) ? number_format(array_sum(json_decode($production->produksi, true)),0,'.','.') : '',
                ],
                'delivery' => [
                    'month' => $delivery,
                    'total' => !empty($deliveries[$komponentSupplierId][$componentId]) ? number_format($this->sumDelivery($deliveries[$komponentSupplierId][$componentId]), 0,'.','.') : ''
                ],
                'dataStock' => $this->getDataStock($stock, $produksi, $delivery)

            ];
        }

        return $dataProductionsAndDelivery;
    }


    public function unduh()
    {

        if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->supplier)) {

            $bulan = $this->month();
            $dataKaryawan = $this->jumlahKaryawan();
            $apm = $this->apmRepository->findById(request()->apm);
            $model = $this->modelRepository->findById(request()->model);
            $supplier = $this->supplierRepository->findById(request()->supplier);
            $results = $this->h12Data($this->modelRepository, $this->supplierRepository, $this->componentSupplierInterface, $this->periodeInterface);

            return Excel::download(new H12Export($results, $bulan, $dataKaryawan, $apm, $model, $supplier), 'DataH12'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }

        return false;
    }

    public function getDataProducstions()
    {
        return Production::with('componentSupplier.masterDataKomponen')->with('componentSupplier')->whereHas('componentSupplier', function(Builder $query) {
            $query->where(['supplier_id' => request()->supplier,'model_id' => request()->model]);
        })
        ->get();

    }

    public function getDataDeliveries($componentSuppliers, $periode)
    {

        $results = [];
        $purchases = [];
        $dataSupplier = [];
        $komponenPurchaseid = [];

        $month = $this->month();
        $periode = $this->periode($periode->getPeriodeByModelId(request()->model));

        $dataPurchase = Purchase::whereIn('periode_id', $periode)->where('model_id', request()->model)->get();

        foreach($dataPurchase as $key => $value) {
            $purchases[] = !empty($value->pembelian) ? json_decode($value->pembelian, true) : '';
        }

        foreach($purchases as $key => $value) {
            foreach($value as $keyKomponenSupplierId => $valueKomponenSupplier) {
                foreach($valueKomponenSupplier as $keyKomponenId => $valueKomponen) {
                    foreach($valueKomponen as $keySupplierId => $valueSupplier) {
                        if($keySupplierId == request()->supplier) {
                            $komponenPurchaseid[] = $keyKomponenSupplierId;
                            $results[$keyKomponenSupplierId][] = array_map(function($x){
                                return !empty($x[0]) ? $x[0] : 0;
                            }, $valueSupplier);
                        }
                   }
                }
            }
        }

        $suppliers = $componentSuppliers->findByMultipleId($komponenPurchaseid);

        foreach($suppliers as $keySupplier => $valueSupplier) {


            $komponenSupplierId = !empty($valueSupplier->id) ? $valueSupplier->id : '';
            $komponenId = !empty($valueSupplier->component_id) ? $valueSupplier->component_id : '';
            $dataSupplier[$komponenSupplierId][$komponenId] = $this->merge_array_recursive($results[$komponenSupplierId]);
        }

        return $dataSupplier;
    }

    public function jumlahKaryawan()
    {
        $data = [];
        $dataEmploye = [];
        $employes = ProfilPerusahaanSupplier::where(['supplier_id' => request()->supplier])->get();

        $month = $this->month();
        $month = array_merge($month['2021'],$month['2022']);

        foreach($employes as $keyEmmploeys => $valueEmployes) {

            $tahun = !empty($valueEmployes->tahun) ? $valueEmployes->tahun : '';
            $bulan = !empty($valueEmployes->bulan) ? $valueEmployes->bulan : '';

            $data[$tahun.'-'.$bulan] = !empty($valueEmployes->jumlah_tenaga_kerja) ? $valueEmployes->jumlah_tenaga_kerja : '';
        }

        foreach($month as $keyMonth => $valueMonth) {
            $year = date('Y', strtotime($keyMonth));
            $dataEmploye[$year][$valueMonth] = !empty($data[$keyMonth]) ? $data[$keyMonth] : '';

        }

        return $dataEmploye;
    }

    public function month()
    {
        $month['2021'] = [
            '2021-1' => 'Januari',
            '2021-2' => 'Februari',
            '2021-3' => 'Maret',
            '2021-4' => 'April',
            '2021-5' => 'Mei',
            '2021-6' => 'Juni',
            '2021-7' => 'Juli',
            '2021-8' => 'Agustus',
            '2021-9' => 'September',
            '2021-10' => 'Oktober',
            '2021-11' => 'November',
            '2021-12' => 'Desember',

        ];

        $month['2022'] = [
            '2022-1' => 'Januari',
            '2022-2' => 'Februari',
            '2022-3' => 'Maret',
            '2022-4' => 'April',
            '2022-5' => 'Mei',
            '2022-6' => 'Juni',
            '2022-7' => 'Juli',
            '2022-8' => 'Agustus',
            '2022-9' => 'September',
            '2022-10' => 'Oktober',
            '2022-11' => 'November',
            '2022-12' => 'Desember',

        ];

        return $month;
    }

    public function merge_array_recursive($params)
    {
        $dataDelivery = [];
        $results = [];
        $month = $this->month();

        $month = array_merge($month['2021'],$month['2022']);

        foreach($params as $keyParams => $valueParams) {
            foreach($valueParams as $keyMonth => $valueMonth) {
                $dataDelivery[$keyMonth] = $valueMonth;
            }
        }

        foreach($month as $keyMonth => $valueMonth) {
            $year = date('Y', strtotime($keyMonth));
            $results[$valueMonth][$year] = !empty($dataDelivery[$valueMonth]) ? $dataDelivery[$valueMonth] : 0;
        }

        return $results;
    }

    public function merge_array_recursive_from_json($params)
    {
        $results = [];

        $month = $this->month();

        unset($month['2021']['2021-1']);

        $month = array_merge($month['2021'],$month['2022']);

        foreach($month as $keyMonth => $valueMonth) {

            $year = date('Y', strtotime($keyMonth));
            $results[$valueMonth][$year] = !empty($params[$valueMonth]) ? $params[$valueMonth] : 0;
        }

        return $results;
    }

    public function getDataStock($stock, $produksi, $delivery)
    {
        $data = [];
        $month = $this->month();
        $stockFebruari = $stock;

        unset($month['2021']['2021-1']);
        $month = array_merge($month['2021'],$month['2022']);

        foreach($month as $keyMonth => $valueMonth) {

            $year = date('Y', strtotime($keyMonth));

            $dataProduksi = !empty($produksi[$valueMonth][$year]) ? $produksi[$valueMonth][$year] : 0;

            $dataDelivery = !empty($delivery[$valueMonth][$year]) ? $delivery[$valueMonth][$year] : 0;

            $stock = ($dataProduksi - $dataDelivery) + $stock;
            $data[$valueMonth][$year] = number_format($stock,0,'.','.');
        }


        $data['Januari']['2021'] = $stockFebruari;

        return $data;
    }

    public function periode($periode)
    {
        $data = [];
        if($periode->isNotEmpty()) {

            foreach($periode as $key => $value) {
                $data[] = !empty($value->id) ? $value->id : '';
            }
        }

        return  $data;
    }

    public function sumDelivery($deliveries)
    {
        $data = [];

        foreach($deliveries as $key => $delivery) {

            foreach($delivery as $key => $value) {
                $data[] = $value;
            }
        }
        return array_sum($data);
    }

}
