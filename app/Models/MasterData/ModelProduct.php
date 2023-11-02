<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;


/**
 * @property string $id
 * @property string $apm_id
 * @property string $jenis_kbm
 * @property string $nama_model
 * @property string $nama_tipe
 * @property string $nama_varian
 * @property int $nama_kapasitas_silinder
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property \MasterDataApm $masterDataApm
 * @property \MasterDataKomponenModel[] $masterDataKomponenModels
 */
class ModelProduct extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_model';

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
    protected $fillable = ['id','apm_id', 'merek_id', 'jenis_kbm', 'nama_model', 'nama_tipe', 'nama_varian', 'nama_kapasitas_silinder', 'rencana_produksi_2021','rencana_produksi_2022', 'created_at', 'updated_at', 'deleted_at'];

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
    public function masterDataMerek()
    {
        return $this->belongsTo('App\Models\MasterData\Merek', 'merek_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterDataKomponenModels()
    {
        return $this->hasMany('App\Models\MasterData\KomponenModel', 'model_id');
    }
}
