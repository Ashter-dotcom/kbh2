<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $kategori_id
 * @property string $nama_komponen
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataKategoriKomponen $masterDataKategoriKomponen
 * @property MasterDataKomponenModel[] $masterDataKomponenModels
 */
class Komponen extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_komponen';

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
    protected $fillable = ['kategori_id', 'nama_komponen', 'unit', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDataKategoriKomponen()
    {
        return $this->belongsTo('App\Models\MasterData\KategoriKomponen', 'kategori_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterDataKomponenModels()
    {
        return $this->hasMany('App\Models\MasterData\KomponenModel', 'komponen_id');
    }
}
