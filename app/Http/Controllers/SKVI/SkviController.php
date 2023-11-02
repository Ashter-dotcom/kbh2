<?php

namespace App\Http\Controllers\SKVI;


use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Exports\SkviExport;
use Illuminate\Http\Request;
use App\Models\MasterData\Periode;
use App\Models\MasterData\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\ProductionForm\Selling;
use App\Models\ProductionForm\Purchase;
use App\Models\MasterData\ModelProduct;
use App\Models\MasterData\KomponenModel;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\MasterData\Interfaces\KomponenInterface;
use App\Repository\MasterData\Interfaces\KapasitasSilinderInterface;

class SkviController extends Controller
{


    private $model;
    private $periode;
    private $apmRepository;
    private $komponenRepository;
    private $supplierRepository;
    private $kapasitasSilinderInterface;

    public function __construct(ApmInterface $apmRepository, KapasitasSilinderInterface $kapasitasSilinderInterface, KomponenInterface $komponenRepository, PeriodeInterface $periodeInterface, SupplierInterface $supplierRepository)
    {
        $this->periode = $periodeInterface;
        $this->apmRepository = $apmRepository;
        $this->komponenRepository = $komponenRepository;
        $this->supplierRepository = $supplierRepository;
        $this->kapasitasSilinderInterface = $kapasitasSilinderInterface;
    }

    public function index(Request $request)
    {

        if(!empty($request->apm)) {
            $this->data['no'] = 1;
            $this->data['apmInformation'] = $this->apmRepository->findById($request->apm);
            $this->data['kapasitas_silinder'] = $this->kapasitasSilinderInterface->findById($request->kapasitas_silinder);
            $this->data['results'] = $this->skvidata($this->apmRepository, $this->data['kapasitas_silinder'], $this->periode, $this->komponenRepository, $this->supplierRepository);

        }
        
        return view('SKVI.Index', ['data' => $this->data]);
    }

    public function unduh()
    {
        if(!empty(request()->apm)) {
            $apm = $this->apmRepository->findById(request()->apm);
            $apmInformation = $this->apmRepository->findById(request()->apm);
            $kapasitasSilinder = $this->kapasitasSilinderInterface->findById(request()->kapasitas_silinder);
            $results = $this->skvidata($this->apmRepository, $kapasitasSilinder, $this->periode, $this->komponenRepository, $this->supplierRepository);

            return Excel::download(new SkviExport($results, $apm, $apmInformation, $kapasitasSilinder), 'SKVI'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }
        
        return  false;

    }

    public function skvidata($apm, $kapasitas_silinder, $periode, $komponen, $supplier)
    {
        $periode = $periode->findById(request()->periode);


        $dataPenjualan = $this->dataPenjualan($periode, $kapasitas_silinder);
        $dataPresentasePembelianLokal = $this->presentasePembelianLokal($apm, $periode, $komponen, $supplier);


        return [
            'penjualan' => $dataPenjualan,
            'dataPresentasePembelianLokal' => $dataPresentasePembelianLokal
        ];
    }

    public function presentasePembelianLokal($apm, $periode, $komponen, $supplier)
    {

        $finalPresentae = [];

        $data_model_id = $this->data_penjualan($periode);

        $dataModel = Purchase::select('model_id')
                    ->with('masterDataModel')
                    ->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                        $queryApm->where('id', request()->apm);
                    })
                    ->where('periode_id', request()->periode)
                    ->groupBy('model_id')
                    ->get()
                    ->toArray();

        for($model_id = 0; $model_id < count($dataModel); $model_id++) {
        
            $componentPurchases = Purchase::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                    $queryApm->where('id', request()->apm);
                })->with('masterDataKategoriKomponen')
                ->where(['periode_id' => request()->periode])
                ->where('model_id', $dataModel[$model_id]['model_id'])
                ->orderBy('model_id')
                ->get();

            $finalPresentae[$dataModel[$model_id]['master_data_model']['nama_model']][] = $this->kelolaData($apm, $komponen, $supplier, $componentPurchases);
            
        }

        return $finalPresentae;
    }

    public function kelolaData($apm, $komponen, $supplier, $componentPurchases)
    {
        $data = [];
        $finalData = [];
        $statusData = true;
        $dataKomponen = [];
        $dataPembelian = 0;
        $listKeyKategori = [];
        $totalPresentae = [];
        $dataKebutuhanDanPembelian = [];

        $supplier_tidak_digunakan = Supplier::select('id')
                                    ->where('nama_perusahaan_supplier', 'like', '%tidak digunakan%')
                                    ->orWhere('nama_perusahaan_supplier', 'like', '%tidakdigunakan%')
                                    ->first();

        $supplier_tidak_digunakan = !empty($supplier_tidak_digunakan->id) ? $supplier_tidak_digunakan->id : 'f4306005-7ab2-4344-81b3-b30609b58f8e';

        if($componentPurchases->isNotEmpty()) {

            foreach($componentPurchases as $componentPurchase) {
                $kategoriId = !empty($componentPurchase->masterDataKategoriKomponen) ? $componentPurchase->masterDataKategoriKomponen->id : '-';
                
                $data[$kategoriId][] = [
                    'kelompok' => !empty($componentPurchase->masterDataKategoriKomponen) ? $componentPurchase->masterDataKategoriKomponen->nama_kategori_komponen : '-',
                    'kebutuhan' => $this->merge_array_kebutuhan($componentPurchase->model_id),
                    'pembelian' => $this->merge_array_pembelian(array_values(json_decode($componentPurchase['pembelian'], true)))
                ];
            }

    
            foreach($data as $keyKategori => $searchKeyKategori) {
                foreach($searchKeyKategori[0]['pembelian'] as $keyKategori => $valueKategori) {
                    $listKeyKategori[] = $keyKategori;
                }
            }
            
    
            $listKomponens = $komponen->findByMultipleId($listKeyKategori);
    
            
            if(!empty($listKomponens)) {
                foreach($listKomponens as $listKomponen) {
    
                    $dataKomponen[$listKomponen->id] = [
                        'kategori_id' => $listKomponen->kategori_id,
                        'komponen_id' => $listKomponen->id,
                        'nama_komponen' => $listKomponen->nama_komponen,
                    ];
                }
            }
            
            foreach($dataKomponen as $keyDataKomponen => $valueDataKomponen) {
                $dataKebutuhanDanPembelian[$data[$valueDataKomponen['kategori_id']][0]['kelompok']][$valueDataKomponen['nama_komponen']] = [
                    'kebutuhan' => !empty($data[$valueDataKomponen['kategori_id']][0]['kebutuhan'][$keyDataKomponen]) ? $data[$valueDataKomponen['kategori_id']][0]['kebutuhan'][$keyDataKomponen] : [],
                    'pembelian' => !empty($data[$valueDataKomponen['kategori_id']][0]['pembelian'][$keyDataKomponen]) ? $data[$valueDataKomponen['kategori_id']][0]['pembelian'][$keyDataKomponen] : [],
                ];
            }
        
            foreach($dataKebutuhanDanPembelian as $keyDataKebutuhanDanPembelian => $valueDataKebutuhanDanPembelian) {            
                foreach($valueDataKebutuhanDanPembelian as $keyDataKomponen => $valueDataKomponen) {
                    $finalData[] = $valueDataKomponen;
                }
            }

            foreach($finalData as $key_final_data => $value_final_data) {

                if(!isset($value_final_data['pembelian'][$supplier_tidak_digunakan]) && !isset($value_final_data['pembelian']['f4306005-7ab2-4344-81b3-b30609b58f8e'])) {
                    $totalPresentase[] = !empty(array_sum($value_final_data['kebutuhan'])) ? ($this->kelola_data_pembelian($value_final_data['pembelian']) / array_sum($value_final_data['kebutuhan'])) * 100 > 100 ? 100 : ($this->kelola_data_pembelian($value_final_data['pembelian']) / array_sum($value_final_data['kebutuhan'])) * 100 : 0;
                }   
            }
            
            return number_format(array_sum($totalPresentase) / count($totalPresentase),2,'.','.');
        }


    }

    public function kelola_data_pembelian($pembelian)
    {
        $data = 0;

        foreach($pembelian as $key_pembelian => $value_pembelian) {
            $data += array_sum($value_pembelian['total']);            
        }

        return $data;

    }

    public function dataPenjualan($periode, $kapasitas_silinder)
    {
        $no = 1;
        $index = 0;
        $data = [];
        $template = '';
        $penjualan = [];

        $dataPenjualan = Selling::selectRaw('count(nik) as total_nik, model_id')->with('masterDataModel')->whereHas('masterDataModel', function(Builder $queryModel) use($kapasitas_silinder) {
            $queryModel->where('nama_kapasitas_silinder', '>=', $kapasitas_silinder->minimal)->where('nama_kapasitas_silinder', '<=', $kapasitas_silinder->maksimal);
        })->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->where('id', request()->apm);
        })
        
        ->whereRaw("DATE_FORMAT(tanggal_penjualan, \"%Y-%m\") BETWEEN DATE_FORMAT(\"$periode->mulai\", \"%Y-%m\") AND DATE_FORMAT(\"$periode->selesai\", \"%Y-%m\")")
        ->whereNotNull('tanggal_penjualan')
        ->groupBy('model_id')
        ->get();
            
        if($dataPenjualan->isNotEmpty()) {
            foreach($dataPenjualan as $keyDataPenjualan => $valueDataPenjualan) {

                $model_id = !empty($valueDataPenjualan->masterDataModel) ? $valueDataPenjualan->masterDataModel->id : '';
                $penjualan[$model_id] = $valueDataPenjualan['total_nik'];
            }
        }


        $dataModel = Purchase::select('model_id')
            ->with('masterDataModel')
            ->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                $queryApm->where('id', request()->apm);
            })->whereHas('masterDataModel', function(Builder $queryModel) use($kapasitas_silinder) {
                $queryModel->where('nama_kapasitas_silinder', '>=', $kapasitas_silinder->minimal)->where('nama_kapasitas_silinder', '<=', $kapasitas_silinder->maksimal);
            })
            ->where('periode_id', request()->periode)
            ->groupBy('model_id')
            ->get();

        if($dataModel->isNotEmpty()) {
            foreach($dataModel as $key => $value) {

                $model_id = !empty($value->masterDataModel) ? $value->masterDataModel->id : '';
                $nama_model = !empty($value->masterDataModel) ? $value->masterDataModel->nama_model : '';
                $nama_merek = !empty($value->masterDataModel->masterDataMerek) ? $value->masterDataModel->masterDataMerek->merek : '';
                $jenis_kbm = !empty($value->masterDataModel) ? $value->masterDataModel->jenis_kbm : '';
                $nama_tipe = !empty($value->masterDataModel) ? $value->masterDataModel->nama_tipe.'-'.$index++ : '';
                $kapasitas_silinder = !empty($value->masterDataModel) ? $value->masterDataModel->nama_kapasitas_silinder : '';
    
                $data[$jenis_kbm][$nama_merek][$nama_model][$nama_tipe]['tipe'] = !empty($value->masterDataModel) ? $value->masterDataModel->nama_tipe : '';
                $data[$jenis_kbm][$nama_merek][$nama_model][$nama_tipe]['kapasitas_silinder'] = !empty($value->masterDataModel) ? $value->masterDataModel->nama_kapasitas_silinder : '';
                $data[$jenis_kbm][$nama_merek][$nama_model][$nama_tipe]['totals'] = !empty($penjualan[$model_id]) ? $penjualan[$model_id] : 0;
            }

            return $data;
        }
        
        return $data;
    }

    public function merge_array_kebutuhan($model_id)
    {
        $results = [];
        $data_komponen = [];
        $data_kategori = [];
        $data_produksi = [];

        $periode = Periode::select('mulai','selesai')->where('id', request()->periode)->first();

        $komponen_model = KomponenModel::select('jumlah','komponen_id')
                        ->where('model_id', $model_id)
                        ->where('menggunakan', 1)
                        ->get();


        if($komponen_model->isNotEmpty()) {

            foreach($komponen_model as $key_komponen_model => $value_komponen_model) {
                $data_komponen[$value_komponen_model->komponen_id] = !empty($value_komponen_model->jumlah) ? $value_komponen_model->jumlah : 0;
            }
        }

        if(!empty($periode)) {
            $selling = Selling::selectRaw("count(nik) as total_produksi, tanggal_produksi")->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\") BETWEEN DATE_FORMAT('".$periode->mulai."', \"%Y-%m\") AND DATE_FORMAT('".$periode->selesai."', \"%Y-%m\")")
                    ->where('model_id', $model_id)
                    ->groupByRaw('model_id, tanggal_produksi')
                    ->get();

            if($selling->isNotEmpty()) {
                foreach($selling as $key => $value) {
                    $tanggal = str_replace(' ', '',date_bahasa($value->tanggal_produksi, ['display_hari' => false, 'display_tahun' => false]));
    
                    $data_produksi[$tanggal][] = !empty($value->total_produksi) ? $value->total_produksi : 0;   
                }

                foreach($data_produksi as $key_data_produksi => $value_data_produksi) {

                    foreach($data_komponen as $key_data_komponen => $value_data_komponen) {
                        $results[$key_data_komponen][$key_data_produksi] = !empty($value_data_produksi) ? array_sum($value_data_produksi) * $value_data_komponen : 0;
                    }
                    
                }
            }   else {
                
                
                $bulan = [];
                $ranges = CarbonPeriod::create($periode->mulai, '1 month', $periode->selesai)->toArray();

                

                foreach($ranges as $range) {

                    $tanggal = str_replace(' ', '',date_bahasa($range->format('Y-m'), ['display_tahun' => false, 'display_hari' => false]));

                    $bulan[$tanggal] =  0;
                }

                foreach($bulan as $key => $value) {

                    foreach($data_komponen as $key_data_komponen => $value_data_komponen) {
                        $results[$key_data_komponen][$key] = $value_data_komponen;
                    }
                }
            }      
        }
        
        return $results;
    }

    public function merge_array_pembelian($params)
    {

        $data = [];
        $results = [];
        $total = count($params);

        for($x = 0; $x < count($params); $x++) {

            foreach($params[$x] as $keyKomponen => $valueKomponen) {

                foreach($valueKomponen as $keySupplier => $valueSupplier) {

                    foreach($valueSupplier as $keyMonth => $valueMonth) {
                        $data[$keyKomponen][$keySupplier]['total'][] = $valueSupplier[$keyMonth][0];
                        
                    }

                }
                
            }
        }
        
        return $data;
    }

    public function data_penjualan($periode)
    {
        return Selling::selectRaw('model_id')->with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->where('id', request()->apm);
        })
        
        ->whereRaw("DATE_FORMAT(tanggal_penjualan, \"%Y-%m\") BETWEEN DATE_FORMAT(\"$periode->mulai\", \"%Y-%m\") AND DATE_FORMAT(\"$periode->selesai\", \"%Y-%m\")")
        ->whereNotNull('tanggal_penjualan')
        ->groupBy('model_id')
        ->pluck('model_id')
        ->toArray();

    }
}
