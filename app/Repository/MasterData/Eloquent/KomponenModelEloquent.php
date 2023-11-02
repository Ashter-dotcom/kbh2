<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Models\MasterData\Komponen;
use App\Models\MasterData\KomponenModel;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\KomponenModelInterface;
class KomponenModelEloquent implements KomponenModelInterface
{
    public function all()
    {
        return KomponenModel::select('*')->get();
    }

    public function store(array $attributes)
    {
        try {
            return KomponenModel::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $komponenModel = $this->findById(request()->id);
            $attributes = request()->except(['_token']);

            return KomponenModel::where('id', $komponenModel->id)->update($attributes);
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
        return KomponenModel::findOrFail($id);
    }

    public function findByModelId($id)
    {
        return KomponenModel::with(['masterDataKomponen.masterDataKategoriKomponen'])->where('model_id',$id)->get()->sortBy(['masterDataKomponen.masterDataKategoriKomponen.nama_kategori_komponen','masterDataKomponen.nama_komponen']);
    }

    public function findByKomponenId($id)
    {
        return KomponenModel::with(['masterDataModel'])->where('komponen_id',$id)->get();
    }

    public function getDataKomponentModel(array $params)
    {
        $components = [];
        $lists = KomponenModel::where(['model_id' => $params['model_id'], 'menggunakan' => 1, ['jumlah', '>', 0]])
            ->with('masterDataKomponen')
            ->whereHas('masterDataKomponen', function(Builder $query) use($params) {
                $query->where('kategori_id', $params['component_category']);
            })
            ->with('masterDataKomponen.masterDataKategoriKomponen')
        ->get();

        foreach($lists as $list) {
            $components[] = [
                'component_ammount' => !empty($list->jumlah) ? $list->jumlah : 0,
                'component_id' => !empty($list->komponen_id) ? $list->komponen_id : 0,
                'component_name' => !empty($list->masterDataKomponen) ? $list->masterDataKomponen->nama_komponen : '',
                'component_category_name' => !empty($list->masterDataKomponen->masterDataKategoriKomponen) ? $list->masterDataKomponen->masterDataKategoriKomponen->nama_kategori_komponen : '',
            ];
        }

        return $components;
    }

    public function syncComponent($id)
    {
        $dataKomponen =  KomponenModel::select('komponen_id')->where('model_id',$id)->pluck('komponen_id')->toArray();
        $komponen = Komponen::select('id')->pluck('id')->toArray();
        $komponenDiff = array_diff($komponen, $dataKomponen);

        foreach ($komponenDiff as $value) {
            KomponenModel::create([
                'komponen_id' => $value,
                'model_id' => $id,
                'menggunakan' => 0,
                'jumlah' => 0
            ]);
        }

        return true;
    }

}
