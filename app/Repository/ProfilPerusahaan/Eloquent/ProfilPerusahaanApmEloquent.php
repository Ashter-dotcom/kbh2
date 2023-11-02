<?php

namespace App\Repository\ProfilPerusahaan\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\ProfilPerusahaan\Interfaces\ProfilPerusahaanApmInterface;
use App\Models\ProfilPerusahaan\ProfilPerusahaanApm;

class ProfilPerusahaanApmEloquent implements ProfilPerusahaanApmInterface
{
    public function all()
    {
        return ProfilPerusahaanApm::select('*')->get();
    }

    public function update(array $attributes)
    {
        try {
            foreach ($attributes as $att) {
                $updateData = [
                    'jumlah_produksi' => isset($att['jumlah_produksi']) ? floatval($att['jumlah_produksi']) : 0,
                    'jumlah_penjualan_ekspor' => isset($att['jumlah_penjualan_ekspor']) ? floatval($att['jumlah_penjualan_ekspor']) : 0,
                    'jumlah_penjualan_domestik' => isset($att['jumlah_penjualan_domestik']) ? floatval($att['jumlah_penjualan_domestik']) : 0,
                    'jumlah_tenaga_kerja' => isset($att['jumlah_tenaga_kerja']) ? floatval($att['jumlah_tenaga_kerja']) : 0,
                    'ppn_impor' => isset($att['ppn_impor']) ? floatval($att['ppn_impor']) : 0,
                    'ppn_spt' => isset($att['ppn_spt']) ? floatval($att['ppn_spt']) : 0,
                    'ppn_bm' => isset($att['ppn_bm']) ? floatval($att['ppn_bm']) : 0,
                    'pph_21' => isset($att['pph_21']) ? floatval($att['pph_21']) : 0,
                    'pph_22' => isset($att['pph_22']) ? floatval($att['pph_22']) : 0,
                    'pph_23' => isset($att['pph_23']) ? floatval($att['pph_23']) : 0,
                    'pph_25' => isset($att['pph_25']) ? floatval($att['pph_25']) : 0,
                    'pph_4_2' => isset($att['pph_4_2']) ? floatval($att['pph_4_2']) : 0,
                    'kapasitas_produksi' => isset($att['kapasitas_produksi']) ? floatval($att['kapasitas_produksi']) : 0,
                    'tingkat_utilitas' => isset($att['tingkat_utilitas']) ? floatval($att['tingkat_utilitas']) : 0,
                    'investasi_baru' => isset($att['investasi_baru']) ? floatval($att['investasi_baru']) : 0
                ];

                $conditions = [
                    'apm_id' => isset($att['apm_id']) ? $att['apm_id'] : null,
                    'bulan' => isset($att['bulan']) ? floatval($att['bulan']) : null,
                    'tahun' => isset($att['tahun']) ? floatval($att['tahun']) : null,
                    'kondisi' => isset($att['kondisi']) ? $att['kondisi'] : null,
                ];

                // Remove any null values from the conditions array
                $conditions = array_filter($conditions, function ($value) {
                    return $value !== null;
                });

                ProfilPerusahaanApm::updateOrCreate($conditions, $updateData);
            }

            return true;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }


    // public function update(array $attributes)
    // {
    //     try {
    //         $attributes = request()->except(['_token']);

    //         // update relation attribute
    //         foreach ($attributes as $att) {
    //             ProfilPerusahaanApm::updateOrCreate(
    //                 [
    //                     'apm_id' => $att['apm_id'],
    //                     'bulan' => floatval($att['bulan']),
    //                     'tahun' => floatval($att['tahun']),
    //                     'kondisi' => $att['kondisi'],
    //                 ],
    //                 [
    //                     'jumlah_produksi' => floatval($att['jumlah_produksi']),
    //                     'jumlah_penjualan_ekspor' => floatval($att['jumlah_penjualan_ekspor']),
    //                     'jumlah_penjualan_domestik' => floatval($att['jumlah_penjualan_domestik']),
    //                     'jumlah_tenaga_kerja' => floatval($att['jumlah_tenaga_kerja']),
    //                     'ppn_impor' => floatval($att['ppn_impor']),
    //                     'ppn_spt' => floatval($att['ppn_spt']),
    //                     'ppn_bm' => floatval($att['ppn_bm']),
    //                     'pph_21' => floatval($att['pph_21']),
    //                     'pph_22' => floatval($att['pph_22']),
    //                     'pph_23' => floatval($att['pph_23']),
    //                     'pph_25' => floatval($att['pph_25']),
    //                     'pph_4_2' => floatval($att['pph_4_2']),
    //                     'kapasitas_produksi' => floatval($att['kapasitas_produksi']),
    //                     'tingkat_utilitas' => floatval($att['tingkat_utilitas']),
    //                     'investasi_baru' => floatval($att['investasi_baru'])
    //                 ]
    //             );
    //         }

    //         return true;
    //     } catch (Throwable $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    public function findById($id)
    {

        return ProfilPerusahaanApm::findOrFail($id);
    }

    public function findByPerusahaanApmId($id)
    {
        return ProfilPerusahaanApm::where(['apm_id'=>$id])->get();
    }

    public function findProfil($params)
    {
        return ProfilPerusahaanApm::where($params)->get();
    }

}
