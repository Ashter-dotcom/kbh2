<?php

namespace App\Models\ProductionForm;


use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    use UsesUuid;

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


    protected $guarded = [];
    protected $table = 'component_suppliers';


    public function masterDataKomponen()
    {
        return $this->belongsTo('App\Models\MasterData\Komponen', 'component_id');
    }

    public function masterDataSupplier()
    {
        return $this->belongsTo('App\Models\MasterData\Supplier', 'supplier_id');
    }

    public function masterDataSubSupplier()
    {
        return $this->belongsTo('App\Models\MasterData\Supplier', 'sub_supplier_id');
    }

    public function masterDataModel()
    {
        return $this->belongsTo('App\Models\MasterData\ModelProduct', 'model_id');
    }

}
