<?php

namespace App\Repository\ProfilPerusahaan\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\ProfilPerusahaan\Interfaces\ProfilPerusahaanSupplierInterface;
use App\Models\ProfilPerusahaan\ProfilPerusahaanSupplier;

class ProfilPerusahaanSupplierEloquent implements ProfilPerusahaanSupplierInterface
{
    public function all()
    {
        return ProfilPerusahaanSupplier::select('*')->get();
    }

    public function update(array $attributes)
    {
        try {
            $attributes = request()->except(['_token']);

            // update relation attribute
            foreach ($attributes as $att) {
                ProfilPerusahaanSupplier::updateOrCreate(
                    [
                        'supplier_id' => $att['supplier_id'],
                        'bulan' => floatval($att['bulan']),
                        'tahun' => floatval($att['tahun']),
                        'kondisi' => $att['kondisi'],
                    ],
                    [
                        'jumlah_produksi' => floatval($att['jumlah_produksi']),
                        'jumlah_penjualan_ekspor' => floatval($att['jumlah_penjualan_ekspor']),
                        'jumlah_penjualan_domestik' => floatval($att['jumlah_penjualan_domestik']),
                        'jumlah_tenaga_kerja' => floatval($att['jumlah_tenaga_kerja']),
                        'pph_21' => floatval($att['pph_21']),
                        'pph_25' => floatval($att['pph_25']),
                        'kapasitas_produksi' => floatval($att['kapasitas_produksi']),
                        'tingkat_utilitas' => floatval($att['tingkat_utilitas']),
                        'investasi_baru' => floatval($att['investasi_baru'])
                    ]
                );
            }

            return true;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function findById($id)
    {

        return ProfilPerusahaanSupplier::findOrFail($id);
    }

    public function findByPerusahaanSupplierId($id)
    {
        return ProfilPerusahaanSupplier::where(['supplier_id'=>$id])->get();
    }

}
