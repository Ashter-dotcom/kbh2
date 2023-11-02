<?php

namespace App\Models\ProfilPerusahaan;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $supplier_id
 * @property int $bulan
 * @property int $tahun
 * @property string $kondisi
 * @property float $jumlah_produksi
 * @property float $jumlah_penjualan_ekspor
 * @property float $jumlah_penjualan_domestik
 * @property float $jumlah_tenaga_kerja
 * @property float $pph_21
 * @property float $pph_25
 * @property float $kapasitas_produksi
 * @property float $tingkat_utilitas
 * @property float $investasi_baru
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataSupplier $masterDataSupplier
 */
class ProfilPerusahaanSupplier extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profil_perusahaan_supplier';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['supplier_id', 'bulan', 'tahun', 'kondisi', 'jumlah_produksi', 'jumlah_penjualan_ekspor', 'jumlah_penjualan_domestik', 'jumlah_tenaga_kerja', 'pph_21', 'pph_25', 'kapasitas_produksi', 'tingkat_utilitas', 'investasi_baru', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataSupplier()
    {
        return $this->belongsTo('App\Models\MasterData\Supplier', 'supplier_id');
    }
}
