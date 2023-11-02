<?php

namespace App\Models\ProductionForm;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use UsesUuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];
    protected $table = 'production_selling';


    public function masterDataModel()
    {
        return $this->belongsTo('App\Models\MasterData\ModelProduct', 'model_id');
    }
    
    public function masterDataSuppliers()
    {
        return $this->belongsTo('App\Models\MasterData\Supplier', 'supplier_id');
    }
}
