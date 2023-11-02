<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $apm_id
 * @property string $model_id
 * @property string $periode_id
 * @property string $nama_tipe
 * @property boolean $kondisi
 * @property int $rencana_kemenperin
 * @property int $rencana_apm
 * @property int $realisasi
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataKomponen $masterDataKomponen
 * @property MasterDataModel $masterDataModel
 * @property MasterDataManufakturing $masterDataManufakturing
 */
class Manufakturing extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_manufakturing';

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
        'apm_id',
        'model_id',
        'periode_id',
        'nama_tipe',
        'kondisi',
        'rencana_kemenperin',
        'rencana_apm',
        'realisasi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

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
    public function masterDataModel()
    {
        return $this->belongsTo('App\Models\MasterData\ModelProduct', 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataPeriode()
    {
        return $this->belongsTo('App\Models\MasterData\Periode', 'periode_id');
    }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function masterData()
    // {
    //     return $this->belongsTo('App\Models\MasterData\Periode', 'periode_id');
    // }
}
