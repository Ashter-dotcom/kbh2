<?php

namespace App\Models\ProductionForm;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use UsesUuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];
    protected $table = 'production_supplier';


    public function componentSupplier()
    {
        return $this->belongsTo('App\Models\ProductionForm\Supplier', 'komponen_supplier_id');
    }

}
