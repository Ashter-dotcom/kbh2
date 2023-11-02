<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Models\MasterData\SupplierPic;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\SupplierPicInterface;

class SupplierPicEloquent implements SupplierPicInterface
{
    public function all()
    {
        return SupplierPic::select('*')->get();
    }

    public function store(array $attributes)
    {
        try {
            return SupplierPic::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $supplierPic = $this->findById(request()->id);
            $attributes = request()->except(['_token']);

            return SupplierPic::where('id', $supplierPic->id)->update($attributes);
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
        return SupplierPic::findOrFail($id);
    }

    public function findByApmId($id)
    {
        return SupplierPic::with(['masterDataApm'])->where('apm_id',$id)->get()->sortBy(['masterDataApm.nama_perusahaan_apm']);
    }

    public function findBySupplierId($id)
    {
        return SupplierPic::with(['masterDataSupplier','masterDataApm'])->where('supplier_id',$id)->get()->sortBy(['masterDataApm.nama_perusahaan_apm']);
    }

}
