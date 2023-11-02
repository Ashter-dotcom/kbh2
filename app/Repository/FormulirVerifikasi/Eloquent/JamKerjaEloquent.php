<?php

namespace App\Repository\FormulirVerifikasi\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\FormulirVerifikasi\Interfaces\JamKerjaInterface;
use App\Models\FormulirVerifikasi\ProsesProduksi;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MasterData\KategoriKomponen;
use App\Models\MasterData\Komponen;

class JamKerjaEloquent implements JamKerjaInterface
{
    public function all()
    {
        return ProsesProduksi::select('*')->orderBy('jamkerja')->get();
    }

    public function getData(array $params)
    {

        $data = [];

        $lists = Supplier::where('modeL_id', $params['model_id'])->with('masterDataSupplier','masterDataKomponen.masterDataKategoriKomponen')
        ->whereHas('masterDataKomponen.masterDataKategoriKomponen', function(Builder $query) use($params) {
            $query->where('id', $params['component_category']);
        })->get();


        if(!$lists->isEmpty()) {
            foreach($lists as $list) {

                if(!empty($list->in_house)) {
                    $data[$list->component_id]['data_inhouse'] = [
                        'id' => $list->id,
                        'in_house' => $list->in_house,
                        'actual_component_name' => $list->actual_component_name,
                    ];
                }

                if(empty($list->in_house)) {
                    $data[$list->component_id]['data_supplier'][] = [
                        'id' => $list->id,
                        'component_id' => $list->component_id,
                        'actual_component_name' => $list->actual_component_name,
                        'supplier_id' => $list->supplier_id,
                        'sub_supplier_id' => $list->sub_supplier_id,
                        'supplier_name' => !empty($list->masterDataSupplier) ? $list->masterDataSupplier->nama_perusahaan_supplier : '',
                        'sub_supplier_name' => !empty($list->masterDataSubSupplier) ? $list->masterDataSubSupplier->nama_perusahaan_supplier : '',
                        'category_name' => !empty($list->masterDataKomponen->masterDataKategoriKomponen) ? $list->masterDataKomponen->masterDataKategoriKomponen->nama_kategori_komponen : '',
                        'delete_url' => route('form_produksi.supplier.delete-supplier', ['model_id' => request()->model_id, 'id' => $list->id])
                    ];
                }
            }
        }

        return $data;
    }

    public function getDataComponentSupplier(array $params)
    {

        $data = [];
        $lists = Supplier::where('model_id', $params['model_id'])
            ->with('masterDataSupplier')
            ->with('masterDataSubSupplier')
            ->with('masterDataKomponen')
            ->with('masterDataModel.masterDataApm')
            ->with('masterDataKomponen.masterDataKategoriKomponen')
            ->whereHas('masterDataKomponen.masterDataKategoriKomponen', function(Builder $query) use($params) {
                $query->where('id', $params['component_category']);
            })
            ->get();

        foreach($lists as $key => $list) {
            $data[$list->masterDataKomponen->nama_komponen][] = [
                'component_supplier_id' => !empty($list->id) ? $list->id : '',
                'component_id' => $list->component_id,
                'component_name' => !empty($list->masterDataKomponen) ? $list->masterDataKomponen->nama_komponen : '',
                'supplier' => !empty($list->masterDataSupplier) ? $list->masterDataSupplier->nama_perusahaan_supplier : $list->masterDataModel->masterDataApm->nama_perusahaan_apm,
                'sub_supplier' => !empty($list->masterDataSubSupplier) ? "- ".$list->masterDataSubSupplier->nama_perusahaan_supplier : "",
                'supplier_id' => !empty($list->supplier_id) ? $list->supplier_id : $list->masterDataModel->masterDataApm->id
            ];
        }

        return $data;
    }

    public function store(array $attributes)
    {
        try {
            return ProsesProduksi::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    // public function update(array $attributes)
    // {
    //     try {
    //         $merek = $this->findById(request()->id);
    //         $attributes = request()->except(['_token']);

    //         return Merek::where('id', $merek->id)->update($attributes);
    //     } catch (Throwable $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    // public function delete($id)
    // {
    //     try {
    //         return $this->findById($id)->delete();
    //     } catch (Throwable $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    // public function findById($id)
    // {

    //     return Merek::findOrFail($id);
    // }

    public function cari($q=false,$supplierId)
    {
        return response()->json(
            Merek::select("id", "merek AS name")
                ->where('merek', 'LIKE', "%$q%")
                ->where('supplier_id', $supplierId)
                ->get()
        );
    }
}
