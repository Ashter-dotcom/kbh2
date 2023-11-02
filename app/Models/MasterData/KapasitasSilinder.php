<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $nama_kelompok
 * @property int $minimal
 * @property int $maksimal
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class KapasitasSilinder extends Model
{
    use HasFactory, Notifiable, UsesUuid;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'master_data_kapasitas_silinder';

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
    protected $fillable = ['nama_kelompok', 'minimal', 'maksimal', 'created_at', 'updated_at', 'deleted_at'];

}
