<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\MasterData\Interfaces\SupplierInterface;
use App\Models\MasterData\Supplier;
use App\Models\MasterData\SupplierPic;

class SupplierEloquent implements SupplierInterface
{
    public function all()
    {
        return Supplier::select('*')->orderBy('nama_perusahaan_supplier')->get();
    }

    public function store(array $attributes)
    {
        try {
            $pic = $attributes['pic'];
            $attributes = request()->except(['_token','pic']);
            $supplier = Supplier::create($attributes);
            $supplierModel = Supplier::find($supplier->id);
            $supplierPic = [];
            // create relation attribute
            foreach ($pic as $p => $c) {
                if (!is_null($c['nama_pic'])) {
                    array_push($supplierPic, [
                        'apm_id' => $p,
                        'supplier_id' => $supplier->id,
                        'nama_pic' => $c['nama_pic'],
                        'divisi_pic' => $c['divisi_pic'],
                        'email_pic' => $c['email_pic'],
                        'no_telp_pic' => $c['no_telp_pic']
                    ]);
                }
            }
            $supplierModel->masterDataSupplierPic()->createMany($supplierPic);
            return $supplier;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $supplier = $this->findById(request()->id);
            $pic = $attributes['pic'];
            $attributes = request()->except(['_token','pic']);
            $supplierModel = Supplier::find($supplier->id);

            // update relation attribute
            foreach ($pic as $p => $c) {
                if (is_null($c['nama_pic'])) {
                    $supplierPic = SupplierPic::find($p);
                    (isset($supplierPic->id)) ? $supplierPic->delete() : true;
                }else{
                    $c['tanggal_kesediaan_diverifikasi'] = ($c['tanggal_kesediaan_diverifikasi'] == '1970-01-01') ? null : $c['tanggal_kesediaan_diverifikasi'];
                    $supplierModel->masterDataSupplierPic()->updateOrCreate(
                        [
                            'id' => $p
                        ],
                        [
                            'apm_id' => $c['apm_id'],
                            'supplier_id' => $supplier->id,
                            'nama_pic' => $c['nama_pic'],
                            'divisi_pic' => $c['divisi_pic'],
                            'email_pic' => $c['email_pic'],
                            'no_telp_pic' => $c['no_telp_pic'],
                            'tanggal_kesediaan_diverifikasi' => $c['tanggal_kesediaan_diverifikasi']
                        ]
                    );
                }
            }

            return Supplier::where('id', $supplier->id)->update($attributes);
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
        return Supplier::findOrFail($id);
    }

    public function findByMultipleId(array $id)
    {
        return Supplier::select('id','nama_perusahaan_supplier')->whereIn('id', $id)->get();
    }

    public function cari($q)
    {
        return response()->json(
            Supplier::select("id", "nama_perusahaan_supplier AS name")
                ->where('nama_perusahaan_supplier', 'LIKE', "%$q%")
                ->get()
        );
    }

}
