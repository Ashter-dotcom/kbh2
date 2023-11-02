<?php

namespace App\Repository\ProductionForm\Eloquent;


use App\Models\ProductionForm\Production;
use App\Repository\ProductionForm\Interfaces\ProductionInterface;

class ProductionEloquent implements ProductionInterface
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

            foreach($attributes['produksi'] as $key => $produksi) {
                Production::updateOrCreate(
                    ['komponen_supplier_id' => $key],
                    [
                        'komponen_supplier_id' => $key,
                        'model_id' => request()->model_id,
                        'tahun' => date('Y'),
                        'stock' => !empty($attributes['stock'][$key]) ? $attributes['stock'][$key] : 0,
                        'produksi' => !empty($attributes['produksi'][$key]) ? json_encode($attributes['produksi'][$key]) : 0
                    ]
                );
            }

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

    public function getDataProductionSuppliers($params)
    {



        $data = [];
        $productionSuppliers = Production::where(['model_id' => $params['model_id']])->get();

        foreach($productionSuppliers as $productionSupplier) {
            $data[$productionSupplier->komponen_supplier_id] = [
                'komponen_supplier_id' => !empty($productionSupplier->komponen_supplier_id) ? $productionSupplier->komponen_supplier_id : '',
                'produksi' => !empty($productionSupplier->produksi) ? json_decode($productionSupplier->produksi, true) : '',
                'stock' => !empty($productionSupplier->stock) ? $productionSupplier->stock : '',
            ];
        }

        return $data;
    }

}
