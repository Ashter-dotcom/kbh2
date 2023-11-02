<?php

namespace App\Models\ProfilPerusahaan;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $apm_id
 * @property int $bulan
 * @property int $tahun
 * @property string $kondisi
 * @property float $jumlah_produksi
 * @property float $jumlah_penjualan_ekspor
 * @property float $jumlah_penjualan_domestik
 * @property float $jumlah_tenaga_kerja
 * @property float $ppn_impor
 * @property float $ppn_spt
 * @property float $ppn_bm
 * @property float $pph_21
 * @property float $pph_22
 * @property float $pph_23
 * @property float $pph_25
 * @property float $pph_4_2
 * @property float $kapasitas_produksi
 * @property float $tingkat_utilitas
 * @property float $investasi_baru
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataApm $masterDataApm
 */
class ProfilPerusahaanApm extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'profil_perusahaan_apm';

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
    protected $fillable = ['apm_id', 'bulan', 'tahun', 'kondisi', 'jumlah_produksi', 'jumlah_penjualan_ekspor', 'jumlah_penjualan_domestik', 'jumlah_tenaga_kerja', 'ppn_impor', 'ppn_spt', 'ppn_bm', 'pph_21', 'pph_22', 'pph_23', 'pph_25', 'pph_4_2', 'kapasitas_produksi', 'tingkat_utilitas', 'investasi_baru', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataApm()
    {
        return $this->belongsTo('App\Models\MasterData\Apm', 'apm_id');
    }
}
