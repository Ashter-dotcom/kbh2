<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $apm_id
 * @property string $supplier_id
 * @property string $nama_pic
 * @property string $divisi_pic
 * @property string $email_pic
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class SupplierPic extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'master_data_supplier_pic';

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
    protected $fillable = ['apm_id', 'supplier_id', 'nama_pic', 'divisi_pic', 'email_pic', 'no_telp_pic', 'tanggal_kesediaan_diverifikasi', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataApm()
    {
        return $this->belongsTo('App\Models\MasterData\Apm', 'apm_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataSupplier()
    {
        return $this->belongsTo('App\Models\MasterData\Supplier', 'supplier_id');
    }
}
