<?php

namespace App\Http\Controllers;

use App\Models\MasterData\ModelProduct;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];


    protected function breadcrumb($menu)
    {
    
        $model = ModelProduct::where('id', request()->model_id)->with('masterDataApm')->first();

        if(!empty($model)) {
            return [
                'apm' => !empty($model->masterDataApm) ? ucfirst($model->masterDataApm->slug) : '',
                'model' => !empty($model->nama_model) ? $model->nama_model : '',
                'varian' => !empty($model->nama_varian) ? $model->nama_varian : '',
                'menu' => $menu
            ];
        }
        return [
            'apm' => '-',
            'model' => '-',
            'varian' => '-',
            'menu' => '-'
        ];
    }
}
