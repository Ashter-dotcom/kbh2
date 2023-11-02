<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\MasterData\Interfaces\InvestasiApmInterface;
use App\Models\MasterData\InvestasiApm;

class InvestasiApmEloquent implements InvestasiApmInterface
{
    public function all()
    {
        return Apm::select('*')->orderBy('nama_perusahaan_apm')->get();
    }

    public function store(array $attributes)
    {
        try {
            return Apm::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $apm = $this->findById(request()->id);
            $attributes = request()->except(['_token']);

            return Apm::where('id', $apm->id)->update($attributes);
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

        return Apm::findOrFail($id);
    }

    public function findByMultipleId(array $id)
    {
        return Apm::select('id','nama_perusahaan_apm')->whereIn('id', $id)->get();
    }

    public function cari($q)
    {
        return response()->json(
            Apm::select("id", "nama_perusahaan_apm AS name")
                ->where('nama_perusahaan_apm', 'LIKE', "%$q%")
                ->get()
        );
    }

    public function supplierPic($id)
    {
        return Apm::with(['masterDataSupplierPic' => function($q) use($id){
            $q->where(['master_data_supplier_pic.supplier_id'=>$id]);
        }])->orderBy('nama_perusahaan_apm')->get();
    }

}
