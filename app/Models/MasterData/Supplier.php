<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $nama_perusahaan_supplier
 * @property string $no_telp_kantor
 * @property string $nama_pic
 * @property string $divisi_pic
 * @property string $email_pic
 * @property string $tanggal_kesediaan_diverifikasi
 * @property string $alamat_pabrik
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Supplier extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'master_data_supplier';

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
    protected $fillable = ['nama_perusahaan_supplier', 'tanggal_kesediaan_diverifikasi', 'alamat_pabrik', 'keterangan', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterDataSupplierPic()
    {
        return $this->hasMany('App\Models\MasterData\SupplierPic', 'supplier_id');
    }

}
