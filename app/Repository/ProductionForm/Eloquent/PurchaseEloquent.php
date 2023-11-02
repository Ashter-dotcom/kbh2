<?php

namespace App\Repository\ProductionForm\Eloquent;


use Carbon\CarbonPeriod;
use App\Models\MasterData\Periode;
use App\Models\ProductionForm\Purchase;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\ProductionForm\Interfaces\PurchaseInterface;

class PurchaseEloquent implements PurchaseInterface
{

    public function all()
    {

    }

    public function getdata(array $params)
    {

    }

    public function store(array $attributes)
    {
        try {
            $purchase_id = !empty($attributes['purchase_id']) ? $attributes['purchase_id'] : '';

            Purchase::updateOrCreate(
                ['id' => $purchase_id, 'periode_id' => request()->period_id],
                ['model_id' => request()->model_id, 'periode_id' => request()->period_id, 'komponen_kategori_id' => request()->component_category, 'kebutuhan' => json_encode($attributes['kebutuhan']), 'pembelian' => json_encode($attributes['pembelian_lokal'])]
            );

            return true;

        } catch (\Throwable $e) {
            report($e);
            return false;
        }

    }

    public function update(array $attributes)
    {

    }

    public function delete($id)
    {

    }

    public function findById($id)
    {

    }

    public function getDataComponentPurchase($params)
    {
        $purchase = Purchase::where(['model_id' => $params['model_id'], 'periode_id' => $params['period_id'], 'komponen_kategori_id' => $params['component_category']])->first();

        return array_filter([
            'purchase_id' => !empty($purchase->id) ? $purchase->id : 0,
            'pembelian_lokal' => !empty($purchase->pembelian) ? json_decode($purchase->pembelian, true) : '',
        ]);   
    }

    public function report_realisasi_komponen_lokal_apm()
    {

        $month = $this->data_month();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'month' => $month['data_month'],
                'data' => array_values($this->data_report_realisasi_komponen_lokal_apm($month['mapping_month']))
            ]
        ], 200);
    }

    public function report_realisasi_komponen_lokal_model()
    {
        $month = $this->data_month();
    
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'month' => $month['data_month'],
                'data' => array_values($this->data_report_realisasi_komponen_lokal_model($month['mapping_month']))
            ]
        ], 200);
    }

    public function data_report_realisasi_komponen_lokal_apm($month)
    {
        $data = [];
        $results = [];
        $data_mapping = [];
        $final_results = [];

        $dataPembelianKomponen = Purchase::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->when(request()->apm, function($query, $apm) {
                return $query->where('id', $apm);
            });
        })
        ->get();


        if($dataPembelianKomponen->isNotEmpty()) {

            foreach($dataPembelianKomponen as $keyDataPembeianKomponen => $valueDataPembelianKomponen){

                $nama_apm = !empty($valueDataPembelianKomponen->masterDataModel->masterDataApm) ? $valueDataPembelianKomponen->masterDataModel->masterDataApm->slug : '';
                $apm_id = !empty($valueDataPembelianKomponen->masterDataModel) ? $valueDataPembelianKomponen->masterDataModel->apm_id : '';
                

                $data['nama_apm'][$apm_id] = $nama_apm;
                $data['kebutuhan'][$apm_id][$valueDataPembelianKomponen->model_id][] = !empty($valueDataPembelianKomponen->kebutuhan) ? json_decode($valueDataPembelianKomponen->kebutuhan, true) : '';
                $data['pembelian'][$apm_id][$valueDataPembelianKomponen->model_id][] = !empty($valueDataPembelianKomponen->pembelian) ? json_decode($valueDataPembelianKomponen->pembelian, true) : '';
            }
            
            
            foreach($data['kebutuhan'] as $keyApm => $valueApm) {
                foreach($valueApm as $keyModel => $valueModel) {                
                    foreach($valueModel as $key => $value) {
                        foreach($value as $keyKomponenId => $valueKomponenId) {
                            foreach($valueKomponenId as $keyMonth => $valueMonth) {
                                $dataKebutuhan[$keyMonth][$keyApm][$keyModel]['kebutuhan'][] = $valueMonth[0] > 0 ? $valueMonth[0] : 0;
                            }
                        }
                    }
                }
            }

            foreach($data['pembelian'] as $keyApm => $valueApm) {
                foreach($valueApm as $keyModel => $valueModel) {
                    foreach($valueModel as $key => $value) {
                        foreach($value as $keyKomponenSuplierId => $valueKomponenSuplierId) {
                            foreach($valueKomponenSuplierId as $keyKomponenId => $valueKomponenId) {
                                
                                foreach($valueKomponenId as $keySupplier => $valueSupplier) {
                                    foreach($valueSupplier as $keyMonth => $valueMonth){
                                        $dataPembelian[$keyMonth][$keyApm][$keyModel]['pembelian'][] = $valueMonth[0] > 0 ? $valueMonth[0] : 0;
                                    }    
                                }
                            }
                            
                        }
                    }
                }
            }

            $data_merge = array_merge_recursive($dataPembelian, $dataKebutuhan);

            foreach($data_merge as $keyMonth => $valueMonth) {
                foreach($valueMonth as $keyApm => $valueApm) {
                    
                    foreach($valueApm as $keyModel => $valueModel) {
                        
                        $results[$keyApm]['nama_apm'] = $data['nama_apm'][$keyApm];
                        $results[$keyApm]['total_model'][$keyModel] = $keyModel;
                        $results[$keyApm]['data'][$keyMonth][] = !empty(array_sum($valueMonth[$keyApm][$keyModel]['pembelian'])) && !empty(array_sum($valueMonth[$keyApm][$keyModel]['kebutuhan'])) ? (array_sum($valueMonth[$keyApm][$keyModel]['pembelian']) / array_sum($valueMonth[$keyApm][$keyModel]['kebutuhan'])) * 100 : 0;
                    } 
                }  
            }

            foreach($results as $keyApm => $valueApm) {
                foreach($valueApm['data'] as $keyMonth => $valueMonth) {

                    $total_model = count($valueApm['total_model']);
                
                    $data_mapping[$keyApm]['nama_apm'] = $valueApm['nama_apm'];
                    $data_mapping[$keyApm]['data'][$keyMonth] = !empty($total_model) ? ceil(array_sum($valueMonth) / $total_model) > 100 ? 100 : ceil(array_sum($valueMonth) / $total_model)  : 0;
                }   
            }
            
            foreach($data_mapping as $keyApm => $valueApm) {

                $final_results[$keyApm] = [
                    'name' => $valueApm['nama_apm'],
                    'data' => array_values(array_merge($month, $valueApm['data']))
                ];    
                    
            }
            
            return $final_results;
        }
            
    }

    public function data_report_realisasi_komponen_lokal_model($month)
    {
        $data = [];
        $results = [];
        $final_results = [];

        $dataPembelianKomponen = Purchase::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->when(request()->apm, function($query, $apm) {
                return $query->where('id', $apm);
            });
        })
        ->get();

        if($dataPembelianKomponen->isNotEmpty()) {

            foreach($dataPembelianKomponen as $keyDataPembeianKomponen => $valueDataPembelianKomponen){

                $data['model'][$valueDataPembelianKomponen->model_id] = [
                    'nama_model' => !empty($valueDataPembelianKomponen->masterDataModel) ? $valueDataPembelianKomponen->masterDataModel->nama_model : '',
                    'nama_tipe' => !empty($valueDataPembelianKomponen->masterDataModel) ? $valueDataPembelianKomponen->masterDataModel->nama_tipe : '',
                    'nama_kapasitas_silinder' => !empty($valueDataPembelianKomponen->masterDataModel) ? $valueDataPembelianKomponen->masterDataModel->nama_kapasitas_silinder : '',
                ];

                $data['kebutuhan'][$valueDataPembelianKomponen->model_id][] = !empty($valueDataPembelianKomponen->kebutuhan) ? json_decode($valueDataPembelianKomponen->kebutuhan, true) : '';
                $data['pembelian'][$valueDataPembelianKomponen->model_id][] = !empty($valueDataPembelianKomponen->pembelian) ? json_decode($valueDataPembelianKomponen->pembelian, true) : '';
            }
            
            foreach($data['kebutuhan'] as $keyModel => $valueModel) {                
                foreach($valueModel as $key => $value) {
                    foreach($value as $keyKomponenId => $valueKomponenId) {
                        foreach($valueKomponenId as $keyMonth => $valueMonth) {
                            if($valueMonth[0] > 0)  {
                                $dataKebutuhan[$keyMonth][$keyModel]['kebutuhan'][] = $valueMonth[0];
                            }
                        }
                    }
                }
            }
            
            foreach($data['pembelian'] as $keyModel => $valueModel) {
                foreach($valueModel as $key => $value) {
                    foreach($value as $keyKomponenSuplierId => $valueKomponenSuplierId) {
                        foreach($valueKomponenSuplierId as $keyKomponenId => $valueKomponenId) {
                            
                            foreach($valueKomponenId as $keySupplier => $valueSupplier) {
                                foreach($valueSupplier as $keyMonth => $valueMonth)
                                if($valueMonth[0] > 0)  {
                                    $dataPembelian[$keyMonth][$keyModel]['pembelian'][] = $valueMonth[0];
                                }
                            }
                        }
                        
                    }
                }
            }

            $data_merge = array_merge_recursive($dataPembelian, $dataKebutuhan);

            foreach($data_merge as $keyMonth => $valueMonth) {

                foreach($valueMonth as $keyModel => $valueModel) {
                    $results[$keyModel]['name'] = $data['model'][$keyModel]['nama_model'] .' '. $data['model'][$keyModel]['nama_tipe'] . ' '. $data['model'][$keyModel]['nama_kapasitas_silinder'];
                    $results[$keyModel]['data'][$keyMonth] = !empty($valueMonth[$keyModel]['pembelian']) && !empty($valueMonth[$keyModel]['kebutuhan']) ? (ceil((array_sum($valueMonth[$keyModel]['pembelian']) / array_sum($valueMonth[$keyModel]['kebutuhan']))) * 100) > 100 ?  100 : ceil((array_sum($valueMonth[$keyModel]['pembelian']) / array_sum($valueMonth[$keyModel]['kebutuhan']))) * 100  : 0;
                }   
            }

            foreach($results as $key => $result) {
                $final_results[$key] = [
                    'name' => $result['name'],
                    'data' => array_values(array_merge($month, $result['data']))
                ];
            }
            
            return $final_results;
        }
            
    }

    public function data_month()
    {
        $data_month = [];
        $mapping_month = [];

        $ranges = Config('params')['periode-tahun']['pertama']['setelah'];
        
        foreach($ranges as $key => $range) {
            $date = date('Y-m', strtotime($range['tahun'].'-'.$range['bulan']));

            
            $data_month[] = trim(date_bahasa($date, ['display_hari' => false, 'display_tahun' => true]));
            $mapping_month[trim(date_bahasa($date, ['display_hari' => false, 'display_tahun' => false]))] = 0;
        }

        return [
            'data_month' => $data_month,
            'mapping_month' => $mapping_month
        ];
    }
}