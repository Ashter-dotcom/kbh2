<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $slug
 * @property string $nama_perusahaan_apm
 * @property string $nama_pic
 * @property string $npwp_perusahaan
 * @property string $no_telp_kantor
 * @property string $alamat_kantor
 * @property string $alamat_pabrik
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataModel[] $masterDataModels
 */
class Apm extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_apm';

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
    protected $fillable = [
        'slug',
        'nama_perusahaan_apm',
        'nama_pic',
        'npwp_perusahaan',
        'no_telp_kantor',
        'alamat_kantor',
        'alamat_pabrik',
        'divisi_pic',
        'email_pic',
        'no_telp_pic',
        'tanggal_kesediaan_diverifikasi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterDataModels()
    {
        return $this->hasMany('App\Models\MasterData\ModelProduct', 'apm_id');
    }

    public function masterDataSupplierPic()
    {
        return $this->hasMany('App\Models\MasterData\SupplierPic', 'apm_id');
    }
}
