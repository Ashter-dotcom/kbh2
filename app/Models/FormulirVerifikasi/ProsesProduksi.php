<?php

namespace App\Models\FormulirVerifikasi;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $supplier_id
 * @property string $prosesproduksi
 * @property string $created_at
 * @property MasterDataModel[] $masterDataModels
 */
class Merek extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_merek';

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
        'merek',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataApm()
    {
        return $this->belongsTo('App\Models\MasterData\Apm', 'apm_id');
    }
}
