<?php


if( ! function_exists('filter'))
{
    function filter($params,$htmlentities=true)
    {
        if(is_array($params)){
            throw new \Exception('Parameter filter is Array.!');
        }
        if ($params){
            if ($htmlentities){
                return htmlentities(trim($params),ENT_QUOTES,'UTF-8');
            }
            return trim($params);
        }
        return '';
    }
}

if( ! function_exists('encrypt_decrypt')) {
    function encrypt_decrypt($string, $decrypt = false)
    {
        // you may change these values to your own
        $secret_key = 'qJB0rGtIn5UB1xG03efyCp';
        $secret_iv = 'qJB0rGtIn5UB1xG03efyCp123658NGeselIN';

        $output = '';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($decrypt){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            return $output ?: '';
        }
        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }
}


if( ! function_exists('formulir_sidebar'))
{
    function formulir_sidebar()
    {
        $menu = '';
        $lists = App\Models\MasterData\Apm::with(['masterDataModels' => function ($query) { 
            return $query->orderBy('nama_model', 'ASC')->orderBy('nama_varian', 'ASC')->orderBy('nama_tipe', 'ASC');
        }])->get();

        if(!empty($lists)) : 
            foreach($lists as $key => $apm) {
                $modelIds = App\Models\MasterData\ModelProduct::where(['apm_id'=>$apm->id])->pluck('id')->all();
                if (count($apm->masterDataModels) > 0) {
                    $menu .= ''
                    .'<a class="nav-link collapsed nav-link-custom" href="#" data-toggle="collapse" data-target="#id-'.$apm->id.'" aria-expanded="true" aria-controls="'.strtolower($apm->slug).'">'
                    .'<i class="'.( (in_array(request()->model_id, $modelIds)) ? 'fas' : 'far').' fa-building"></i>'
                        .'<span>'.ucfirst($apm->slug).'</span>'
                    .'</a>'
                    .'<div id="id-'.$apm->id.'" class="collapse '.((in_array(request()->model_id, $modelIds)) ? 'show' : '').'" aria-labelledby="headingPages" data-parent=".accordionSubModelData">'
                        .'<div class="bg-white py-2 collapse-inner rounded">';
                        foreach($apm->masterDataModels as $k => $model) :
                            $menu .= '<a class="collapse-item '.($model->id == request()->model_id ? 'active' : '').'" href="'.route('form_produksi.supplier.index-supplier', ['model_id' => $model->id]).'">'.$model->nama_model. ' '.$model->nama_tipe.' '.$model->nama_kapasitas_silinder.'</a>';
                        endforeach;
                        $menu .='</div>'
                    .'</div>';
                }
            }
            
            return '<hr class="sidebar-divider my-0">'
                    .'<li class="nav-item '.Active::checkRoute('form_produksi.*').'">'
                        .'<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseModelData" aria-expanded="true" aria-controls="collapseModelData">'
                            .'<i class="fas fa-fw fa-th-large"></i>'
                            .'<span>Formulir Produksi</span>'
                        .'</a>'
                        .'<div id="collapseModelData" class="collapse '.Active::checkRoute(['form_produksi.*'],'show','').'" aria-labelledby="headingPages" data-parent="#accordionSidebar">'.
                            $menu
                        .'</div>'
                    .'</li>';
        endif;
    }

}


if( ! function_exists('component_category'))
{
    function component_category($routingParams)
    {
        $html = '';
        $components = [];
        $lists = \App\Models\MasterData\KategoriKomponen::select('id','nama_kategori_komponen as component_category')->get();


        foreach($lists as $list) {
            $components[] = [
                'id' => !empty($list->id) ? $list->id : 0,
                'component_category' => !empty($list->component_category) ? $list->component_category : ''
            ];
        }
        

        if(in_array($routingParams,['form_produksi.supplier.index-supplier', 'form_produksi.supplier.create-supplier'] )) {
            $html = '<ul class="category" data-url="'.route('form_produksi.supplier.create-supplier', ['model_id' => request()->model_id, 'component_category' => $components[0]['id']]).'">';
        } else {
            $html = '<ul class="category" data-url="'.route('form_produksi.purchase.create-purchase', ['model_id' => request()->model_id, 'period_id' => request()->period_id, 'component_category' => $components[0]['id']]).'">';
        }
            
            foreach($components as $component) :

                switch ($routingParams) {
                    case 'form_produksi.supplier.index-supplier':
                    case 'form_produksi.supplier.create-supplier':
                        $html.= '<li> 
                            <a onclick="return confirm(\'Apakah data anda sudah disimpan ?\')" href="'.route('form_produksi.supplier.create-supplier', ['model_id' => request()->model_id, 'component_category' => $component['id']]).'" class="'.(request()->component_category == $component['id'] ? 'active-custom' : '').'">
                                '.$component['component_category'].'
                            </a>
                        </li>';
                        break;

                    case 'form_produksi.purchase.create-purchase':
                    case 'form_produksi.purchase.index-purchase':
                        $html.= '<li> 
                            <a onclick="return confirm(\'Apakah data anda sudah disimpan ?\')" href="'.route('form_produksi.purchase.create-purchase', ['model_id' => request()->model_id, 'period_id' => request()->period_id, 'component_category' => $component['id']]).'" class="'.(request()->component_category == $component['id'] ? 'active-custom' : '').'">
                                '.$component['component_category'].'
                            </a>
                        </li>';
                        break;
                    
                    default:
                        # code...
                        break;
                }
                
            endforeach;

        $html .= '</ul>';
        
        return $html;
    }
}


if( ! function_exists('date_bahasa'))
{
    function date_bahasa($tanggal, $params = [])
    {
        $display = ['display_hari' => true, 'display_bulan' => true, 'display_tahun' => true];

        $condition = array_merge($display, $params);
        
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);


        
        $tanggal = $condition['display_hari'] == true ? $pecahkan[2] : '';
        $bulan =   $condition['display_bulan'] == true ? $bulan[ (int)$pecahkan[1] ] : '';
        $tahun =   $condition['display_tahun'] ? $pecahkan[0] : '';
     
        return $tanggal. ' ' . $bulan . ' ' . $tahun;
    }

}