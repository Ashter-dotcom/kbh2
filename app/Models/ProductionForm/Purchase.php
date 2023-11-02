<?php

namespace App\Models\ProductionForm;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use UsesUuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];
    protected $table = 'component_purchase';


    public function masterDataModel()
    {
        return $this->belongsTo('App\Models\MasterData\ModelProduct', 'model_id');
    }

    public function masterDataKategoriKomponen()
    {
        return $this->belongsTo('App\Models\MasterData\KategoriKomponen', 'komponen_kategori_id');
    }

}
