<?php

namespace App\Http\Controllers\ViewData;

use Carbon\CarbonPeriod;
use App\Exports\H4Export;
use Illuminate\Http\Request;
use App\Models\MasterData\Periode;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductionForm\Selling;
use App\Models\ProductionForm\Purchase;
use App\Models\MasterData\KomponenModel;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MasterDataKategoriKomponen;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Repository\MasterData\Interfaces\KomponenInterface;

class H4Controller extends Controller
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

            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['model'] = $this->modelRepository->findById(request()->model);
            $this->data['periode'] = $this->periodeRepository->findById(request()->periode);
            $this->data['results'] = $this->h4data($this->apmRepository, $this->periodeRepository, $this->komponenRepository, $this->supplierRepository);
        }

        return view('ViewData.H4.Index', ['data' => $this->data]);
    }

    public function unduh(Request $request)
    {
        if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->periode)) {

            $apm = $this->apmRepository->findById(request()->apm);
            $model = $this->modelRepository->findById(request()->model);
            $periode = $this->periodeRepository->findById(request()->periode);
            $results = $this->h4data($this->apmRepository, $this->periodeRepository, $this->komponenRepository, $this->supplierRepository);

            return Excel::download(new H4Export($results, $apm, $periode, $model), 'DataH4'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }

        return  false;
    }

    public function h4data($apm, $periode, $komponen, $supplier)
    {

        $data = [];
        $finalData = [];
        $dataKomponen = [];
        $dataSupplier = [];
        $listKeyKategori = [];
        $listKeySupplier = [];
        $dataKebutuhanDanPembelian = [];

        $dataApmById = $apm->findById(request()->apm);
        $dataPeriodeByPeriodeId = $periode->findById(request()->periode);

        $ranges = $periode->purchasePeriode($params = ['mulai' => $dataPeriodeByPeriodeId->mulai, 'selesai' => $dataPeriodeByPeriodeId->selesai]);

        $componentPurchases = Purchase::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                $queryApm->where('id', request()->apm);
            })->with('masterDataKategoriKomponen')->where(['model_id' => request()->model, 'periode_id' => request()->periode])->get();



        foreach($componentPurchases as $componentPurchase) {
            $kategoriId = !empty($componentPurchase->masterDataKategoriKomponen) ? $componentPurchase->masterDataKategoriKomponen->id : '-';
            $data[$kategoriId][] = [
                'kelompok' => !empty($componentPurchase->masterDataKategoriKomponen) ? $componentPurchase->masterDataKategoriKomponen->nama_kategori_komponen : '-',
                'kebutuhan' => $this->merge_array_kebutuhan(json_decode($componentPurchase['kebutuhan'], true)),
                'pembelian' => $this->merge_array_pembelian(array_values(json_decode($componentPurchase['pembelian'], true)))
            ];
        }

        foreach($data as $keyKategori => $searchKeyKategori) {

            foreach($searchKeyKategori[0]['pembelian'] as $keyKategori => $valueKategori) {

                $listKeyKategori[] = $keyKategori;

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
                    'nama_komponen' => $listKomponen->nama_komponen,
                    'unit' => !empty($listKomponen->unit) ? $listKomponen->unit : ''
                ];
            }
        }

        if(!empty($listSuppliersFromApm)) {
            foreach($listSuppliersFromApm as $listSupplier) {
                $dataSupplier[$listSupplier->id] = [
                    'supplier_id' => $listSupplier->id,
                    'nama_perusahaan_supplier' => $listSupplier->nama_perusahaan_apm
                ];
            }
        }

        if(!empty($listSuppliers)) {
            foreach($listSuppliers as $listSupplier) {
                $dataSupplier[$listSupplier->id] = [
                    'supplier_id' => $listSupplier->id,
                    'nama_perusahaan_supplier' => $listSupplier->nama_perusahaan_supplier
                ];
            }
        }

        foreach($dataKomponen as $keyDataKomponen => $valueDataKomponen) {
            $dataKebutuhanDanPembelian[$data[$valueDataKomponen['kategori_id']][0]['kelompok']][$valueDataKomponen['nama_komponen']] = [

                'unit' => $valueDataKomponen['unit'],
                'kebutuhan' => !empty($data[$valueDataKomponen['kategori_id']][0]['kebutuhan'][$keyDataKomponen]) ? $data[$valueDataKomponen['kategori_id']][0]['kebutuhan'][$keyDataKomponen] : [],
                'pembelian' => !empty($data[$valueDataKomponen['kategori_id']][0]['pembelian'][$keyDataKomponen]) ? $data[$valueDataKomponen['kategori_id']][0]['pembelian'][$keyDataKomponen] : [],
            ];
        }

        foreach($dataKebutuhanDanPembelian as $keyDataKebutuhanDanPembelian => $valueDataKebutuhanDanPembelian) {

            foreach($valueDataKebutuhanDanPembelian as $keyDataKomponen => $valueDataKomponen) {
                $finalData[] = [
                    'kelompok' => $keyDataKebutuhanDanPembelian,
                    'kategori' => $keyDataKomponen,
                    'satuan' => $valueDataKomponen['unit'],
                    'data' => $valueDataKomponen
                ];
            }
        }

        return [
            'no' => 1,
            'ranges' => [
                'data' => $ranges,
                'total' => count($ranges)
            ],
            'data' => $finalData,
            'dataSupplier' => $dataSupplier
        ];
    }

    public function merge_array_kebutuhan($params)
    {


        $results = [];
        $data_komponen = [];
        $data_kategori = [];
        $data_produksi = [];

        $periode = Periode::select('mulai','selesai')->where('id', request()->periode)->first();

        $komponen_model = KomponenModel::select('jumlah','komponen_id')
                        ->where('model_id', request()->model)
                        ->where('menggunakan', 1)
                        ->get();


        if($komponen_model->isNotEmpty()) {

            foreach($komponen_model as $key_komponen_model => $value_komponen_model) {
                $data_komponen[$value_komponen_model->komponen_id] = !empty($value_komponen_model->jumlah) ? $value_komponen_model->jumlah : 0;
            }
        }

        if(!empty($periode)) {
            $selling = Selling::selectRaw("count(nik) as total_produksi, tanggal_produksi")->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\") BETWEEN DATE_FORMAT('".$periode->mulai."', \"%Y-%m\") AND DATE_FORMAT('".$periode->selesai."', \"%Y-%m\")")
                    ->where('model_id', request()->model)
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
                        $data[$keyKomponen][$keySupplier]['month'][$keyMonth][] = $valueSupplier[$keyMonth][0];

                    }

                }

            }
        }

        return $data;
    }
}
