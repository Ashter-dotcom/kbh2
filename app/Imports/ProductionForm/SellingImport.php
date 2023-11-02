<?php

namespace App\Imports\ProductionForm;


use Illuminate\Support\Facades\DB;
use App\Models\ProductionForm\Selling;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SellingImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            
            foreach ($rows as $row) {

                if($row->filter()->isNotEmpty()){

                    Selling::updateOrCreate(
                        ['nik' => $row['nik']],
                        [
                            'nik' => $row['nik'],
                            'tanggal_produksi' => date('Y-m-d', strtotime($row['tanggal_produksi'])),
                            'tanggal_penjualan' => !empty($row['tanggal_penjualan']) ? date('Y-m-d', strtotime($row['tanggal_penjualan'])) : null,
                            'penjualan' => $row['penjualan'],
                            'harga' => $row['haga_satuan'],
                            'konsumen' => $row['konsumen'],
                            'model_id' => request()->model_id
                        ]
                    );
                }
            }

            DB::commit();
            
            return true;

        } catch (\Throwable $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'nik';
    }

    public function startRow(): int
    {
        return 1;
    }
}