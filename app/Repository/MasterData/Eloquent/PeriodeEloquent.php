<?php

namespace App\Repository\MasterData\Eloquent;


use Carbon\CarbonPeriod;
use App\Models\MasterData\Periode;
use App\Models\MasterData\ModelProduct;
use App\Models\MasterData\KapasitasSilinder;
use App\Repository\MasterData\Interfaces\PeriodeInterface;

class PeriodeEloquent implements PeriodeInterface
{
    public function all()
    {
        return Periode::select('*')->orderBy('nama_periode')->get();
    }

    public function store(array $attributes)
    {
        try {
            $attributes['kelompok_kapasitas_silinder'] = json_encode($attributes['kelompok_kapasitas_silinder']);
            return Periode::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $periode = $this->findById(request()->id);
            $attributes = request()->except(['_token']);
            $attributes['kelompok_kapasitas_silinder'] = json_encode($attributes['kelompok_kapasitas_silinder']);

            return Periode::where('id', $periode->id)->update($attributes);
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
        return Periode::findOrFail($id);
    }

    public function purchasePeriode($params)
    {
        $data = [];

        $ranges = CarbonPeriod::create(date('Y-m' , strtotime($params['mulai'])), '1 month', date('Y-m' , strtotime($params['selesai'])));
        foreach($ranges as $key => $range) {
            $data[] = trim(date_bahasa($range->format("Y-m"), ['display_hari' => false, 'display_tahun' => false]));
        }

        return $data;
    }

    public function productionPeriods()
    {
        $data = [];
        $ranges = Config('params')['periode-tahun']['pertama']['setelah'];

        foreach($ranges as $key => $range) {

            $date = date('Y-m', strtotime($range['tahun'].'-'.$range['bulan']));

            $data[] = [
                'tahun' => trim(date_bahasa($date, ['display_hari' => false, 'display_bulan' => false])),
                'bulan' => trim(date_bahasa($date, ['display_hari' => false, 'display_tahun' => false]))
            ];
        }

        return $data;
    }

    public function cari($q)
    {
        return response()->json(
            Periode::select("id", "nama_periode AS name")
                ->where('nama_periode', 'LIKE', "%$q%")
                ->when(request()->model_id, function($query, $model_id) {
                    return $query->whereIn('id', $this->data_periode($model_id));
                })
                ->when(request()->apm_Id, function($query, $apm_Id) {
                    return $query->whereIn('id', $this->data_periode($apm_Id, $tipe = 'apm'));
                })
                ->get()
        );
    }

    public function getPeriodeByModelId($modelId)
    {
        return Periode::whereIn('id', $this->data_periode($modelId))->orderBy('mulai')->get();
    }

    public function data_periode($data_id, $tipe = 'model')
    {
        $result = [];
        $period = [];
        $dataPeriode = [];
        $dataKapasitas = [];

        $periods = Periode::all();
        $nama_kapasitas_silinder = ModelProduct::select('nama_kapasitas_silinder')
                        ->when($tipe, function($query, $tipe) use($data_id) {
                            if($tipe == 'apm') {
                                return $query->where('apm_id', $data_id);
                            } else {
                                return $query->where('id', $data_id);
                            }
                        })
                        ->first();

        $kapasitasSilinder = KapasitasSilinder::where('minimal', '<=', $nama_kapasitas_silinder->nama_kapasitas_silinder)->where('maksimal', '>=', $nama_kapasitas_silinder->nama_kapasitas_silinder)->get();

        foreach($kapasitasSilinder as $keyKapasitasSilinder => $valueKapasitasSilinder) {
            $dataKapasitas[$valueKapasitasSilinder->id] = $valueKapasitasSilinder->id;
        }

        foreach($periods as $keyPeriod => $period) {
            $data = json_decode($period->kelompok_kapasitas_silinder, true);
            foreach($data as $keyData => $valueData) {
                $dataPeriode[$period->id][] = $valueData;
            }
        }

        if(!empty($dataPeriode)) {
            foreach($dataPeriode as $keyPeriode => $valuePeriode) {
                foreach($valuePeriode as $key => $value) {
                    if(!empty($dataKapasitas[$value])) {
                        $result[] = $keyPeriode;
                    }
                }
            }
        }

        return $result;
    }
}
