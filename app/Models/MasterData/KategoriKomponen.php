<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UsesUuid;

/**
 * @property string $id
 * @property string $nama_kategori_komponen
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MasterDataKomponen[] $masterDataKomponens
 */
class KategoriKomponen extends Model
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_data_kategori_komponen';

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
    protected $fillable = ['nama_kategori_komponen', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterDataKomponens()
    {
        return $this->hasMany('App\Models\MasterData\Komponen', 'kategori_id');
    }
}
