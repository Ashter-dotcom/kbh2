<?php

namespace App\Repository\MasterData\Eloquent;


use App\Models\MasterData\Apm;
use Illuminate\Support\Facades\Hash;
use App\Models\MasterData\ModelProduct;
use App\Models\MasterData\KomponenModel;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\MasterData\Eloquent\KomponenEloquent;
use Throwable;

class ModelEloquent implements ModelInterface
{
    public function all()
    {
        return ModelProduct::select('*')->orderBy('nama_model')->get();
    }

    public function store(array $attributes)
    {
        try {
            $komponen = $attributes['komponen'];
            $attributes = request()->except(['_token','komponen']);
            $model = ModelProduct::create($attributes);
            $modelData = ModelProduct::find($model->id);
            $komponenModel = [];

            // create relation attribute
            foreach ($komponen as $k => $v) {
                array_push($komponenModel, [
                    'komponen_id' => $k,
                    'model_id' => $model->id,
                    'menggunakan' => filter_var($v['menggunakan'], FILTER_VALIDATE_BOOLEAN),
                    'jumlah' => (int) $v['jumlah']
                ]);
            }
            $modelData->masterDataKomponenModels()->createMany($komponenModel);
            return $model;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $model = $this->findById(request()->id);
            $komponen = $attributes['komponen'];
            $attributes = request()->except(['_token','komponen']);
            $modelData = ModelProduct::find($model->id);

            // update relation attribute
            foreach ($komponen as $k => $v) {
                $modelData->masterDataKomponenModels()->updateOrCreate(
                    [
                        'id' => $k
                    ],
                    [
                        'model_id' => $model->id,
                        'menggunakan' => filter_var($v['menggunakan'], FILTER_VALIDATE_BOOLEAN),
                        'jumlah' => (int) $v['jumlah']
                    ]
                );
            }

            return ModelProduct::where('id', $model->id)->update($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->findById($id)->delete();
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function findById($id)
    {
        return ModelProduct::findOrFail($id);
    }

    public function findByApm($apmId)
    {
        $data = [];
        $model = ModelProduct::select('id','rencana_produksi_2022','rencana_produksi_2023')->where('apm_id',$apmId)->get();

        foreach($model as $keyModel => $valueModel) {
            $data[$valueModel->id] = [
                'rencana_produksi_2022' => !empty($valueModel->rencana_produksi_2022) ? $valueModel->rencana_produksi_2022 : 0,
                'rencana_produksi_2023' => !empty($valueModel->rencana_produksi_2023) ? $valueModel->rencana_produksi_2023 : 0
            ];
        }

        return $data;
    }

    public function findByApmId($id)
    {
        return ModelProduct::where('apm_id',$id)->pluck('id')->toArray();
    }

    public function cari($q)
    {
        return response()->json(
            ModelProduct::select("id", "nama_model AS name", "nama_tipe", "nama_kapasitas_silinder")
                ->where('nama_model', 'LIKE', "%$q%")
                ->when(request()->apm_id, function($query, $apm_id) {
                    if(!empty($apm_id)) {
                        return $query->where('apm_id', $apm_id);
                    }
                })
                ->get()
        );
    }

    public function report_apm()
    {
        $data = [];
        $dataApm = [];


        $models = ModelProduct::with('masterDataApm')->get();
        $apm = Apm::select('id','nama_perusahaan_apm','slug')->get();

        if(!empty($apm)) {
            foreach($models as $model) {

                $apmId = !empty($model->apm_id) ? $model->apm_id : '';

                $data['total'][] = !empty($model->id) ? $model->id : '';
                $data[$apmId][] = '';

            }


            foreach($apm as $keyApm => $valueApm) {
                $dataApm['informasi'][] = [
                    'nama_perusahaan' => !empty($valueApm->nama_perusahaan_apm) ? $valueApm->nama_perusahaan_apm : ''
                ];

                $dataApm['data'][] = [
                    'name' => !empty($valueApm->slug) ? $valueApm->slug : '',
                    'y' => !empty($data[$valueApm->id]) ? (float)sprintf("%2.2f", (count($data[$valueApm->id]) / count($data['total'])) * 100) : 0
                ];
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $dataApm['data'],
                'informasi' => $dataApm['informasi']
            ], 200);

        }


        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found',
            'data' => []
        ], 404);

    }

}
