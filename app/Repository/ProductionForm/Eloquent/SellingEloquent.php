<?php

namespace App\Repository\ProductionForm\Eloquent;

use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductionForm\Selling;
use App\Models\MasterData\ModelProduct;
use Illuminate\Database\Eloquent\Builder;
use App\Imports\ProductionForm\SellingImport;
use App\Repository\ProductionForm\Interfaces\SellingInterface;

class SellingEloquent implements SellingInterface
{

    public function all()
    {

    }

    public function getdata(array $params)
    {

    }

    public function getdataByMonth($params)
    {
        $data = [];
        $lists = [];
        $dates = Selling::whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\") BETWEEN DATE_FORMAT('".$params['mulai']."', \"%Y-%m\") AND DATE_FORMAT('".$params['selesai']."', \"%Y-%m\")")->where('model_id', request()->model_id)->get();

        foreach($dates as $key => $date) {
            $periode = trim(date_bahasa($date->tanggal_produksi, ['display_hari' => false, 'display_tahun' => false]));
            $lists[$periode][] = $date->tanggal_produksi;


            foreach($lists as $key => $list) {
                $data[$key] = count($list);
            }
        }

        return $data;
        
    }

    public function store(array $attributes)
    {
        try {
            $attributes['model_id'] = request()->model_id;
            $attributes['tanggal_produksi'] = date('Y-m-d', strtotime($attributes['tanggal_produksi']));
            $attributes['tanggal_penjualan'] = !empty($attributes['tanggal_penjualan']) ? date('Y-m-d', strtotime($attributes['tanggal_penjualan'])) : null;
 
            Selling::create($attributes);

            return true;
        } catch (\Throwable $e) {
            echo $e;
            return false;
        }
    }

    public function excel($attributes)
    {
        return Excel::import(new SellingImport, $attributes);
    }

    public function update(array $attributes)
    {
        unset($attributes['_token']);

        try {

            $attributes['tanggal_produksi'] = date('Y-m-d', strtotime($attributes['tanggal_produksi']));
            $attributes['tanggal_penjualan'] = !empty($attributes['tanggal_penjualan']) ? date('Y-m-d', strtotime($attributes['tanggal_penjualan'])) : null;
            
            Selling::where(['id' => request()->selling_id])->update($attributes);

            return true;
        } catch (\Throwable $e) {
            echo $e;
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return Selling::find($id)->delete();
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    public function findById($id)
    {
        $selling = Selling::find($id);

        return [
            'id' => !empty($selling->id) ? $selling->id : '',
            'nik' => !empty($selling->nik) ? $selling->nik : '',
            'tanggal_produksi' => !empty($selling->tanggal_produksi) ? date('d-m-Y', strtotime($selling->tanggal_produksi)) : '',
            'tanggal_penjualan' => !empty($selling->tanggal_penjualan) ? date('d-m-Y', strtotime($selling->tanggal_penjualan)) : '',
            'penjualan' => !empty($selling->penjualan) ? $selling->penjualan : '',
            'harga' => !empty($selling->harga) ? $selling->harga : '',
            'konsumen' => !empty($selling->konsumen) ? $selling->konsumen : '',
            'keterangan' => !empty($selling->keterangan) ? $selling->keterangan : '',
        ];
    }

    public function report_rencana_produksi_dan_penjualan()
    {
        $data = [];
        $results = [];
        $data_month = [];
        $finalResults = [];
        $dataRencanaProduksi = [];
        $dataProduksiDanPenjualan = [];


        $ranges = CarbonPeriod::create('2021-02-01', '2022-02-01');
        foreach($ranges as $key => $range) {
            $date = $range->format('Y-m');
            $month[$date] = trim(date_bahasa($date, ['display_hari' => false, 'display_tahun' => true]));
        }

        $rencanaProduksi = ModelProduct::select('id','rencana_produksi_2021', 'rencana_produksi_2022')->get();

        foreach($rencanaProduksi as $keyRencanaProduksi => $valueRencanaProduksi) {
            $dataRencanaProduksi[$valueRencanaProduksi->id] = [
                '2021' => !empty($valueRencanaProduksi->rencana_produksi_2021) ? ($valueRencanaProduksi->rencana_produksi_2021 / 12) : 0,
                '2022' => !empty($valueRencanaProduksi->rencana_produksi_2022) ? ($valueRencanaProduksi->rencana_produksi_2022 / 12) : 0,
            ];
        }

        $productionandselling = Selling::selectRaw('count(tanggal_produksi) as total_produksi, count(tanggal_penjualan) as total_penjualan, model_id, tanggal_produksi')->with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                                    $queryApm->when(request()->apm, function($query, $apm) {
                                        return $query->where('id', $apm);
                                    });
                                })
                                ->groupByRaw('model_id, tanggal_produksi')
                                ->get();

        if(!empty($productionandselling)) {
            foreach($productionandselling as $keyProductionandselling => $valueProductionandselling) {
                $tanggal = date('Y-m', strtotime($valueProductionandselling->tanggal_produksi));
                
                $data[$valueProductionandselling->model_id][$tanggal]['produksi'][] = $valueProductionandselling->total_produksi;
                $data[$valueProductionandselling->model_id][$tanggal]['penjualan'][] = $valueProductionandselling->total_penjualan;                
                $data[$valueProductionandselling->model_id][$tanggal]['rencana_produksi'] = !empty($dataRencanaProduksi[$valueProductionandselling->model_id]) ? $dataRencanaProduksi[$valueProductionandselling->model_id] : 0;
            }

            foreach($data as $keyModel => $valueModel) {

                foreach($valueModel as $keyTanggal => $valueTanggal) {

                    $year = date('Y', strtotime($keyTanggal));
                    
                    $results[$keyTanggal]['produksi'][] = !empty($valueModel[$keyTanggal]['produksi']) ? array_sum($valueModel[$keyTanggal]['produksi']) : 0;
                    $results[$keyTanggal]['penjualan'][] = !empty($valueModel[$keyTanggal]['penjualan']) ? array_sum($valueModel[$keyTanggal]['penjualan']) : 0;
                    $results[$keyTanggal]['rencana_produksi'][] = !empty($valueModel[$keyTanggal]['rencana_produksi'][$year]) ? $valueModel[$keyTanggal]['rencana_produksi'][$year] : 0;
                }   
            }
            
            foreach($month as $keyMonth => $valueMonth) {
                $finalResults['rencana_produksi'][] = !empty($results[$keyMonth]) ? ceil(array_sum($results[$keyMonth]['rencana_produksi'])) : 0;
                $finalResults['produksi'][] = !empty($results[$keyMonth]) ? array_sum($results[$keyMonth]['produksi']) : 0;
                $finalResults['penjualan'][] = !empty($results[$keyMonth]) ? array_sum($results[$keyMonth]['penjualan']) : 0;
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => [
                    'data' => $finalResults,
                    'month' => array_values($month)
                ]
            ]);
        }
        
        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found',
            'data' => []
        ]);

    }

    public function report_realisasi_produksi_dan_penjualan()
    {
        if(!empty(request()->apm)) {
            $data = [];
            $results = [];
            $productionandselling = Selling::selectRaw('count(tanggal_produksi) as total_produksi, count(tanggal_penjualan) as total_penjualan, model_id')->with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                $queryApm->when(request()->apm, function($query, $apm) {
                    return $query->where('id', $apm);
                });
            })
            ->groupByRaw('model_id')
            ->get();


            if(!empty($productionandselling)) {
                foreach($productionandselling as $keyProductionandselling => $valueProductionandselling) {

                    $data['model'][] = !empty($valueProductionandselling->masterDataModel) ? $valueProductionandselling->masterDataModel->nama_model.' '.$valueProductionandselling->masterDataModel->nama_tipe.' '.$valueProductionandselling->masterDataModel->nama_kapasitas_silinder : '';
                    $data['produksi'][] = $valueProductionandselling->total_produksi;
                    $data['penjualan'][] = $valueProductionandselling->total_penjualan;
                    
                }

                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $data
                ]);
            }

            return response()->json([
                'code' => 404,
                'message' => 'Data Not Found',
                'data' => []
            ], 404);
        }
        
        
        return response()->json([
            'code' => 404,
            'message' => 'Pilih Data APM',
            'data' => []
        ], 404);
    }

    public function report_penjualan_model()
    {
        $selling = Selling::selectRaw('count(tanggal_penjualan) as total_penjualan,tanggal_penjualan, model_id')->with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->when(request()->apm, function($query, $apm) {
                return $query->where('id', $apm);
            });
        })
        ->whereNotNull('tanggal_penjualan')
        ->groupByRaw('model_id, tanggal_penjualan')
        ->get();
        
        if($selling->isNotEmpty()) {
            
            $data = [];
            $results = [];
            $dataTahun = [];

            foreach($selling as $keySelling => $valueSelling) {
                $tahun = date('Y-m', strtotime($valueSelling->tanggal_penjualan));

                $model_id = !empty($valueSelling->masterDataModel) ? $valueSelling->masterDataModel->id : '';

                $dataTahun[$tahun] = 0;
                
                $data[$model_id]['penjualan']['model'] = !empty($valueSelling->masterDataModel) ? $valueSelling->masterDataModel->nama_model : '';
                $data[$model_id]['penjualan']['nama_kapasitas_silinder'] = !empty($valueSelling->masterDataModel) ? $valueSelling->masterDataModel->nama_kapasitas_silinder : '';
                $data[$model_id]['penjualan']['nama_tipe'] = !empty($valueSelling->masterDataModel) ? $valueSelling->masterDataModel->nama_tipe : '';
                $data[$model_id]['penjualan']['tahun'][$tahun][] = !empty($valueSelling->total_penjualan) ? $valueSelling->total_penjualan : 0;

            }

            foreach($data as $keyData => $valueData) {

                $model = $valueData['penjualan']['model'].' '.$valueData['penjualan']['nama_tipe'].' '.$valueData['penjualan']['nama_kapasitas_silinder'];

                foreach($valueData['penjualan']['tahun'] as $keyTahun => $valueTahun) {

                    $results['month'][$keyTahun] = trim(date_bahasa($keyTahun, ['display_hari' => false, 'display_tahun' => true]));                
                    $results['data'][$model][$keyTahun][] = !empty($valueData['penjualan']['tahun'][$keyTahun]) ? count($valueData['penjualan']['tahun'][$keyTahun]) : 0;
                    $totals[$model][$keyTahun] = !empty($valueData['penjualan']['tahun'][$keyTahun]) ? array_sum($valueData['penjualan']['tahun'][$keyTahun]) : $dataTahun;

                }

                $results['final'][] = [
                    'name' => $model,
                    'data' => array_values(array_merge($dataTahun, $totals[$model]))
                ];
            }

            ksort($results['month']);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => [
                    'month' => array_values($results['month']),
                    'data' => $results['final']
                ]
            ]);       
        }

        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found',
            'data' => []
        ], 404);
    }
}