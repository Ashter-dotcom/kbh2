<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $komponen_id
 * @property string $model_id
 * @property boolean $menggunakan
 * @property int $jumlah
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataKomponen $masterDataKomponen
 * @property MasterDataModel $masterDataModel
 */
class KomponenModel extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_komponen_model';

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
    protected $fillable = ['komponen_id', 'model_id', 'menggunakan', 'jumlah', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataKomponen()
    {
        return $this->belongsTo('App\Models\MasterData\Komponen', 'komponen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataModel()
    {
        return $this->belongsTo('App\Models\MasterData\ModelProduct', 'model_id');
    }
}
