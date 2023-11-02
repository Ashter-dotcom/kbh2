<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $nama_periode
 * @property string $mulai
 * @property string $selesai
 * @property string $kelompok_kapasitas_silinder
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Periode extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'master_data_periode';

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
    protected $fillable = ['nama_periode', 'mulai', 'selesai', 'kelompok_kapasitas_silinder', 'created_at', 'updated_at', 'deleted_at'];

}
