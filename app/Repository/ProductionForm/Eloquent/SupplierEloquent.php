<?php

namespace App\Repository\ProductionForm\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Models\MasterData\Komponen;
use Illuminate\Support\Facades\Hash;
use App\Models\ProductionForm\Supplier;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MasterData\KategoriKomponen;
use App\Models\ProfilPerusahaan\ProfilPerusahaanSupplier;
use App\Repository\ProductionForm\Interfaces\SupplierInterface;

class SupplierEloquent implements SupplierInterface
{

    public function all()
    {

    }

    public function getData(array $params) 
    {

        $data = [];

        $lists = Supplier::where('modeL_id', $params['model_id'])->with('masterDataSupplier','masterDataKomponen.masterDataKategoriKomponen')
        ->whereHas('masterDataKomponen.masterDataKategoriKomponen', function(Builder $query) use($params) {
            $query->where('id', $params['component_category']);
        })->get();


        if(!$lists->isEmpty()) {
            foreach($lists as $list) {

                if(!empty($list->in_house)) {
                    $data[$list->component_id]['data_inhouse'] = [
                        'id' => $list->id,
                        'in_house' => $list->in_house,
                        'actual_component_name' => $list->actual_component_name,
                    ];
                }

                if(empty($list->in_house)) {
                    $data[$list->component_id]['data_supplier'][] = [
                        'id' => $list->id,
                        'component_id' => $list->component_id,
                        'actual_component_name' => $list->actual_component_name,
                        'supplier_id' => $list->supplier_id,
                        'sub_supplier_id' => $list->sub_supplier_id,
                        'supplier_name' => !empty($list->masterDataSupplier) ? $list->masterDataSupplier->nama_perusahaan_supplier : '',
                        'sub_supplier_name' => !empty($list->masterDataSubSupplier) ? $list->masterDataSubSupplier->nama_perusahaan_supplier : '',
                        'category_name' => !empty($list->masterDataKomponen->masterDataKategoriKomponen) ? $list->masterDataKomponen->masterDataKategoriKomponen->nama_kategori_komponen : '',
                        'delete_url' => route('form_produksi.supplier.delete-supplier', ['model_id' => request()->model_id, 'id' => $list->id])
                    ];
                }
            }
        }

        return $data;
    }

    public function store(array $attributes)
    {
        try {

            $lists = [];
            $data = [];

            unset($attributes['_token']);

            foreach($attributes as $keyFirst => $valueFirst) {

                foreach($valueFirst as $keySecond => $valueSecond) {


                    if(!empty($attributes['inhouse'][$keySecond]) && !empty($attributes['actual_component_name_inhouse'][$keySecond])){

                        $lists[$keySecond]['data_inhouse'] = [
                            'in_house' => 1,
                            'actual_component_name' => !empty($attributes['actual_component_name_inhouse'][$keySecond]) ? $attributes['actual_component_name_inhouse'][$keySecond][0] : null,
                            'supplier_id' => null,
                            'sub_supplier_id' => null,
                            'model_id' => request()->model_id,
                            'component_id' => $keySecond,
                        ];
                    }


                    if(!empty($attributes['supplier_id'][$keySecond])) {
                        $lists[$keySecond]['data_supplier'] = [
                            'actual_component_name' => !empty($attributes['actual_component_name'][$keySecond]) ? $attributes['actual_component_name'][$keySecond] : null,
                            'supplier_id' => !empty($attributes['supplier_id'][$keySecond]) ? $attributes['supplier_id'][$keySecond] : null,
                            'sub_supplier_id' => !empty($attributes['sub_supplier_id'][$keySecond]) ? $attributes['sub_supplier_id'][$keySecond] : null,
                            'model_id' => request()->model_id,
                            'component_id' => $keySecond,
                        ];
                    }
                    
                }                
            }

            foreach($lists as $key => $list) {

                if(!empty($list['data_inhouse'])) {
                    Supplier::create($list['data_inhouse']);
                }
                
                if(!empty($list['data_supplier'])) {
                    for($x = 0; $x < count($list['data_supplier']['actual_component_name']); $x++) {
                        Supplier::create([
                            'model_id' => $list['data_supplier']['model_id'],
                            'component_id' => $list['data_supplier']['component_id'],
                            'actual_component_name' => !empty($list['data_supplier']['actual_component_name'][$x]) ? $list['data_supplier']['actual_component_name'][$x] : null,
                            'supplier_id' => !empty($list['data_supplier']['supplier_id'][$x]) ? $list['data_supplier']['supplier_id'][$x] : null,
                            'sub_supplier_id' => !empty($list['data_supplier']['sub_supplier_id'][$x]) ? $list['data_supplier']['sub_supplier_id'][$x] : null,
                        ]);
                    }
                    
                }
            }
            
            return true;
        } catch (\Throwable $e) {
            echo $e;
            return false;
        }
    
    }

    public function update(array $attributes)
    {

        $data = [];
        unset($attributes['_token']);

        try {
            if(!empty($attributes['actual_component_name_inhouse'])) {
                foreach($attributes['actual_component_name_inhouse'] as $key => $value) {

                    if(!empty($attributes['inhouse'][$key])) {

                        $id = !empty($attributes['id']['data_inhouse'][$key][0])  ? $attributes['id']['data_inhouse'][$key][0] : '';
                        Supplier::updateOrCreate(
                            ['id' => $id],
                            [
                                'in_house' => 1,
                                'component_id' => $key,
                                'model_id' => request()->model_id,
                                'supplier_id' => null,
                                'sub_supplier_id' => null,
                                'actual_component_name' => !empty($attributes['actual_component_name_inhouse'][$key][0]) ? $attributes['actual_component_name_inhouse'][$key][0] : '',
                            ]
                        );
                    } else {

                        $id = !empty($attributes['id']['data_inhouse'][$key][0])  ? $attributes['id']['data_inhouse'][$key][0] : '';
                        Supplier::destroy($id);
                    }
                }
            }

            if(!empty($attributes['actual_component_name'])) {
                foreach($attributes['actual_component_name'] as $key => $value) {
                    
                    if(!empty($attributes['actual_component_name'][$key])) {
                        for($x = 0; $x < count($value); $x++) {
                            $id = !empty($attributes['id']['data_supplier'][$key][$x]) ? $attributes['id']['data_supplier'][$key][$x] : '';

                            Supplier::updateOrCreate(['id' => $id],[
                                'component_id' => $key,
                                'model_id' => request()->model_id,
                                'supplier_id' => !empty($attributes['supplier_id'][$key]) ? $attributes['supplier_id'][$key][$x] : '',
                                'sub_supplier_id' => !empty($attributes['sub_supplier_id'][$key]) ? $attributes['sub_supplier_id'][$key][$x] : '',
                                'actual_component_name' => !empty($attributes['actual_component_name'][$key][$x]) ? $attributes['actual_component_name'][$key][$x] : ''
                            ]);   
                        }
                    }
                    
                }
            }

            return true;
        } catch (\Throwable $th) {
            echo $th;
            return false;
        }

        return true;
    }

    public function delete($id)
    {

        try {
            Supplier::destroy($id);

            return true;
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    public function findById($id) 
    {

    }

    public function getDataSupplier($params)
    {
        $data = [];
        $dataId = [];
        $suppliers = Supplier::where('model_id', $params['model_id'])
                    ->select('id','actual_component_name', 'supplier_id', 'sub_supplier_id', 'component_id')
                    ->with('masterDataSupplier')
                    ->with('masterDataKomponen')
                    ->whereNotNull('supplier_id')
                    ->when($params['supplier_id'], function($query, $supplier_id) {
                        return $query->where('supplier_id', $supplier_id);
                    })
                    ->paginate(10);

        foreach($suppliers as $supplier) {
            $dataId[$supplier->supplier_id] = !empty($supplier->id) ? $supplier->id : '';
            $data[$supplier->supplier_id][] = [
                'id' => !empty($supplier->id) ? $supplier->id : '',
                'component_id' => !empty($supplier->component_id) ? $supplier->component_id : '',
                'component_name' => !empty($supplier->masterDataKomponen) ? $supplier->masterDataKomponen->nama_komponen : '',
                'actual_component_name' => !empty($supplier->actual_component_name) ? $supplier->actual_component_name : '',
                'supplier_name' => !empty($supplier->masterDataSupplier) ? $supplier->masterDataSupplier->nama_perusahaan_supplier : '',
                'sub_supplier_name' => !empty($supplier->masterDataSubSupplier) ? '- '.$supplier->masterDataSubSupplier->nama_perusahaan_supplier : '',
            ];
        }

        return [
            'id' => array_values($dataId),
            'data' => $data,
            'pagination' => $suppliers
        ];
    }

    public function findByMultipleId(array $id)
    {
        return Supplier::whereIn('id', $id)->get();
    }

    public function getDataComponentSupplier(array $params)
    {

        $data = [];
        $lists = Supplier::where('model_id', $params['model_id'])
            ->with('masterDataSupplier')
            ->with('masterDataSubSupplier')
            ->with('masterDataKomponen')
            ->with('masterDataModel.masterDataApm')
            ->with('masterDataKomponen.masterDataKategoriKomponen')
            ->whereHas('masterDataKomponen.masterDataKategoriKomponen', function(Builder $query) use($params) {
                $query->where('id', $params['component_category']);
            })
            ->get();

        foreach($lists as $key => $list) {
            $data[$list->masterDataKomponen->nama_komponen][] = [
                'component_supplier_id' => !empty($list->id) ? $list->id : '',
                'component_id' => $list->component_id,
                'component_name' => !empty($list->masterDataKomponen) ? $list->masterDataKomponen->nama_komponen : '',
                'supplier' => !empty($list->masterDataSupplier) ? $list->masterDataSupplier->nama_perusahaan_supplier : $list->masterDataModel->masterDataApm->nama_perusahaan_apm,
                'sub_supplier' => !empty($list->masterDataSubSupplier) ? "- ".$list->masterDataSubSupplier->nama_perusahaan_supplier : "",
                'supplier_id' => !empty($list->supplier_id) ? $list->supplier_id : $list->masterDataModel->masterDataApm->id
            ];
        }
        
        return $data;
    }

    public function getSupplierByModelId(array $id)
    {
        $data = [];
        $lists = Supplier::whereIn('model_id', $id)
            ->where('in_house',0)
            ->whereNotNull('supplier_id')
            ->where('sub_supplier_id',null)
            ->with('masterDataSupplier.masterDataSupplierPic')
            ->with('masterDataKomponen')
            ->with('masterDataModel')
            ->with('masterDataKomponen.masterDataKategoriKomponen')
            ->get()->sortBy('masterDataSupplier.nama_perusahaan_supplier');
        
        foreach ($lists as $key => $value) {
            $pic = [
                'nama_pic' => '',
                'divisi_pic' => '',
                'no_telp_pic' => '',
                'email_pic' => '',
            ];
            if (count($value->masterDataSupplier->masterDataSupplierPic) > 0) {
                for ($i=0; $i < count($value->masterDataSupplier->masterDataSupplierPic); $i++) { 
                    if ($value->masterDataSupplier->masterDataSupplierPic[$i]->apm_id == $value->masterDataModel->apm_id) {
                        $pic['nama_pic'] = $value->masterDataSupplier->masterDataSupplierPic[$i]->nama_pic;
                        $pic['divisi_pic'] = $value->masterDataSupplier->masterDataSupplierPic[$i]->divisi_pic;
                        $pic['no_telp_pic'] = $value->masterDataSupplier->masterDataSupplierPic[$i]->no_telp_pic;
                        $pic['email_pic'] = $value->masterDataSupplier->masterDataSupplierPic[$i]->email_pic;
                    }
                }
            }
            $dataSama = $this->checkAvailability($data, $value->masterDataSupplier->id, $value->masterDataModel->id);
            if (count($dataSama) > 0) {
                array_push($data[array_keys($data,$dataSama[0])[0]]['komponen'], $value->masterDataKomponen->nama_komponen);
            }else{
                array_push($data, [
                    'id_perusahaan' => $value->masterDataSupplier->id,
                    'nama_perusahaan' => $value->masterDataSupplier->nama_perusahaan_supplier,
                    'alamat_perusahaan' => $value->masterDataSupplier->alamat_pabrik,
                    'nama_pic' => $pic['nama_pic'],
                    'divisi_pic' => $pic['divisi_pic'],
                    'no_telp_pic' => $pic['no_telp_pic'],
                    'email_pic' => $pic['email_pic'],
                    'komponen' => [$value->masterDataKomponen->nama_komponen],
                    'id_model' => $value->masterDataModel->id,
                    'nama_model' => $value->masterDataModel->nama_model,
                    'tanggal_sedia_verifikasi' => $value->masterDataSupplier->tanggal_kesediaan_diverifikasi,
                    'keterangan' => ''
                ]);
            }
        }

        return $data;
    }

    public function getSubSupplierByModelId(array $id)
    {
        $data = [];
        $lists = Supplier::whereIn('model_id', $id)
            ->where('in_house',0)
            ->whereNotNull('sub_supplier_id')
            ->with('masterDataSupplier.masterDataSupplierPic')
            ->with('masterDataSubSupplier.masterDataSupplierPic')
            ->with('masterDataKomponen')
            ->with('masterDataModel')
            ->with('masterDataKomponen.masterDataKategoriKomponen')
            ->get()->sortBy('masterDataSupplier.nama_perusahaan_supplier');
        
        foreach ($lists as $key => $value) {
            $pic = [
                'nama_pic' => '',
                'divisi_pic' => '',
                'no_telp_pic' => '',
                'email_pic' => '',
            ];
            if (count($value->masterDataSubSupplier->masterDataSupplierPic) > 0) {
                for ($i=0; $i < count($value->masterDataSubSupplier->masterDataSupplierPic); $i++) { 
                    if ($value->masterDataSubSupplier->masterDataSupplierPic[$i]->apm_id == $value->masterDataModel->apm_id) {
                        $pic['nama_pic'] = $value->masterDataSubSupplier->masterDataSupplierPic[$i]->nama_pic;
                        $pic['divisi_pic'] = $value->masterDataSubSupplier->masterDataSupplierPic[$i]->divisi_pic;
                        $pic['no_telp_pic'] = $value->masterDataSubSupplier->masterDataSupplierPic[$i]->no_telp_pic;
                        $pic['email_pic'] = $value->masterDataSubSupplier->masterDataSupplierPic[$i]->email_pic;
                    }
                }
            }
            $dataSama = $this->checkAvailabilitySubkontraktor($data, $value->masterDataSupplier->id, $value->masterDataSubSupplier->id, $value->masterDataModel->id);
            if (count($dataSama) > 0) {
                array_push($data[array_keys($data,$dataSama[0])[0]]['komponen'], $value->masterDataKomponen->nama_komponen);
            }else{
                array_push($data, [
                    'id_perusahaan' => $value->masterDataSupplier->id,
                    'nama_perusahaan' => $value->masterDataSupplier->nama_perusahaan_supplier,
                    'id_sub_perusahaan' => $value->masterDataSubSupplier->id,
                    'nama_sub_perusahaan' => $value->masterDataSubSupplier->nama_perusahaan_supplier,
                    'alamat_perusahaan' => $value->masterDataSubSupplier->alamat_pabrik,
                    'nama_pic' => $pic['nama_pic'],
                    'divisi_pic' => $pic['divisi_pic'],
                    'no_telp_pic' => $pic['no_telp_pic'],
                    'email_pic' => $pic['email_pic'],
                    'komponen' => [$value->masterDataKomponen->nama_komponen],
                    'id_model' => $value->masterDataModel->id,
                    'nama_model' => $value->masterDataModel->nama_model,
                    'tanggal_sedia_verifikasi' => $value->masterDataSupplier->tanggal_kesediaan_diverifikasi,
                    'keterangan' => ''
                ]);
            }
        }
        
        return $data;
    }

    public function getInHouseByModelId(array $id)
    {
        $data = [];
        $lists = Supplier::whereIn('model_id', $id)
            ->where('in_house',1)
            ->orderby('model_id')
            ->with('masterDataKomponen')
            ->with('masterDataModel')
            ->with('masterDataKomponen.masterDataKategoriKomponen')
            ->get();

        foreach ($lists as $key => $value) {
            $dataSama = $this->checkAvailabilityInhouse($data, $value->masterDataModel->id);
            if (count($dataSama) > 0) {
                array_push($data[array_keys($data,$dataSama[0])[0]]['komponen'], $value->masterDataKomponen->nama_komponen);
            }else{
                array_push($data, [
                    'komponen' => [$value->masterDataKomponen->nama_komponen],
                    'id_model' => $value->masterDataModel->id,
                    'nama_model' => $value->masterDataModel->nama_model,
                    'keterangan' => ''
                ]);
            }
        }

        return $data;
    }

    protected function checkAvailabilityInhouse(Array $data, $model)
    {
        return array_values(array_filter($data, function($val) use($model){
            return ($val['id_model'] == $model);
        }));
    }

    protected function checkAvailabilitySubkontraktor(Array $data, $perusahaan, $subsupplier, $model)
    {
        return array_values(array_filter($data, function($val) use($perusahaan, $subsupplier, $model){
            return ($val['id_perusahaan'] === $perusahaan and $val['id_sub_perusahaan'] === $subsupplier and $val['id_model'] === $model);
        }));
    }

    protected function checkAvailability(Array $data, $perusahaan, $model)
    {
        return array_values(array_filter($data, function($val) use($perusahaan, $model){
            return ($val['id_perusahaan'] == $perusahaan and $val['id_model'] == $model);
        }));
    }

    public function report_supplier_apm_kelompok_komponen()
    {

        $data = [];
        $results = [];
        $dataCategory = [];
        $finalResults = [];

        $categories = KategoriKomponen::pluck('nama_kategori_komponen','id')->all();
      
        $suppliers = Supplier::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
            $queryApm->when(request()->apm, function($query, $apm) {
                return $query->where('id', $apm);
            });
        })
        ->with('masterDataSupplier')
        ->with('masterDataSubSupplier')
        ->with('masterDataKomponen.masterDataKategoriKomponen')
        ->where('in_house', 0)
        ->get();

        if($suppliers->isNotEmpty()){


            $prev_supplier = '';

            foreach($suppliers as $key => $supplier) {

                $apm_id = !empty($supplier->masterDataModel->masterDataApm) ? $supplier->masterDataModel->masterDataApm->id : '';
                $kategori_komponen = !empty($supplier->masterDataKomponen->masterDataKategoriKomponen) ? $supplier->masterDataKomponen->masterDataKategoriKomponen->id : '';
            
                $nama_perusahaan_supplier = $supplier->masterDataSupplier->nama_perusahaan_supplier;

                if($prev_supplier != $nama_perusahaan_supplier) {

                    $prev_supplier = $nama_perusahaan_supplier;
                
                } else {

                    if(!empty($supplier->masterDataSubSupplier)) {
                        $prev_supplier = $supplier->masterDataSubSupplier->nama_perusahaan_supplier;
                    } else {
                        
                        if($nama_perusahaan_supplier == $prev_supplier) {
                            $prev_supplier = '';
                        }
                    }
                }
                
                $data[$apm_id]['name'] = !empty($supplier->masterDataModel->masterDataApm) ? $supplier->masterDataModel->masterDataApm->slug : '';
                $data[$apm_id]['supplier'][$kategori_komponen][] = $prev_supplier;
            }

            foreach($categories as $keyCategory => $category) {
                $dataCategory[$keyCategory] = 0;
            }

            foreach($data as $keyApm => $valueApm) {

                $results[$keyApm]['name'] = $valueApm['name'];
                $results[$keyApm]['data'] = array_values(array_merge($dataCategory, $valueApm['supplier']));
            }

            
            foreach($results as $keyApm => $valueApm) {
                $finalResult[$keyApm]['name'] = $valueApm['name']; 

                foreach($valueApm['data'] as $keyData => $valueData) {                    
                    $finalResult[$keyApm]['data'][] = is_array($valueApm['data'][$keyData]) ? count(array_filter($valueApm['data'][$keyData])) : 0;
                }
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => [
                    'data' => array_values($finalResult),
                    'categories' => array_values($categories)
                ]
            ], 200);
        }


        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found',
            'data' => []
        ], 404);
    }

    public function report_pohon_industri()
    {
        $data = [];
        $results = [];
        $totalSupplier = 0;
        $dataKomponenKategori = [];

        $masterDataKategoriKomponen = KategoriKomponen::all();

        foreach($masterDataKategoriKomponen as $key => $value) {
            $dataKomponenKategori[$value->id] = [
                'name' => !empty($value->nama_kategori_komponen) ? $value->nama_kategori_komponen : '-',
                'total' => 0,
                'tenaga_kerja' => 0
            ];
        }

        $tenaga_kerja = DB::table('profil_perusahaan_supplier as pps')
                   ->select('supplier_id',DB::raw('MAX(pps.jumlah_tenaga_kerja) as tenaga_kerja'))
                   ->where('pps.kondisi', 'setelah')
                   ->groupBy('supplier_id');

        $suppliers = DB::table('component_suppliers as cs')
                        ->select('cs.supplier_id','mdk.kategori_id', 'mdkk.nama_kategori_Komponen', 'tenaga_kerja')
                        ->join('master_data_komponen as mdk', 'cs.component_id', '=', 'mdk.id')
                        ->join('master_data_kategori_komponen as mdkk', 'mdk.kategori_id', '=', 'mdkk.id')
                        ->leftJoinSub($tenaga_kerja, 'tenaga_kerja', function ($join) {
                            $join->on('cs.supplier_id', '=', 'tenaga_kerja.supplier_id');
                        })
                        ->where('in_house', 0)
                        ->groupByRaw('cs.supplier_id, mdk.kategori_id, mdkk.nama_kategori_Komponen, tenaga_kerja')
                        ->get();

        if(!empty($suppliers)){

            foreach($suppliers as $key => $supplier) {
                
                $master_data_kategori_komponen = !empty($supplier->kategori_id) ? $supplier->kategori_id : '';
                
                $data[$master_data_kategori_komponen]['name'] = !empty($supplier->nama_kategori_Komponen) ? $supplier->nama_kategori_Komponen : '';
                $data[$master_data_kategori_komponen]['supplier'][] = !empty($supplier->supplier_id) ? $supplier->supplier_id : '';
                $data[$master_data_kategori_komponen]['tenaga_kerja'][] = !empty($supplier->tenaga_kerja) ? $supplier->tenaga_kerja : '';
                $data['total_supplier'][] = !empty($supplier->supplier_id) ? $supplier->supplier_id : '';
            }

            foreach($data as $key => $value) {
                $results['total_supplier'] = !empty($data['total_supplier']) ? count(array_filter($data['total_supplier'])) : 0;
                $results['data'][$key] = [
                    'name' => !empty($value['name']) ? $value['name'] : '',
                    'total' => !empty($value['supplier']) ? number_format(count($value['supplier']),0,'.','.') : 0,
                    'tenaga_kerja' => !empty($value['tenaga_kerja']) ? number_format(array_sum(array_filter($value['tenaga_kerja'])),0,'.','.') : 0
                ];   
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => [
                    'total_supplier' => $results['total_supplier'],
                    'data' => array_values(array_merge($dataKomponenKategori, $results['data']))
                ]
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found'
        ], 404);
    }

    public function report_pohon_industri_kategori_komponen($master_kategori_name)
    {
        $data = [];
        $results = [];
        $data_komponen = [];

        $komponen = Komponen::with('masterDataKategoriKomponen')->whereHas('masterDataKategoriKomponen', function(Builder $query) use($master_kategori_name) {
            return $query->where('nama_kategori_komponen', $master_kategori_name);
        })->get();

        foreach($komponen as $key => $value) {
            $kategori_id = !empty($value->id) ? $value->id : '';

            $data_komponen[$kategori_id] = [
                'kategori_id' => $kategori_id,
                'nama_komponen' => !empty($value->nama_komponen) ? $value->nama_komponen : ''
            ];
        }

        $suppliers = Supplier::with('masterDataSupplier')
                    ->with('masterDataSubSupplier')
                    ->with('masterDataSupplier.masterDataSupplierPic')
                    ->with('masterDataSubSupplier.masterDataSupplierPic')
                    ->with('masterDataKomponen')->whereHas('masterDataKomponen.masterDataKategoriKomponen', function(Builder $query) use($master_kategori_name) {
                        return $query->where('nama_kategori_komponen', $master_kategori_name);
                    })
                    ->where('in_house', 0)
                    ->get();

        if($suppliers->isNotEmpty()){
            
            $prev_supplier = '';

            foreach($suppliers as $key => $supplier) {
            
                $nama_perusahaan_supplier = $supplier->masterDataSupplier->nama_perusahaan_supplier;

                if($prev_supplier != $nama_perusahaan_supplier) {

                    $prev_supplier = $nama_perusahaan_supplier;

                } else {

                    if(!empty($supplier->masterDataSubSupplier)) {
                        $prev_supplier = $supplier->masterDataSubSupplier->nama_perusahaan_supplier;
                    } else {

                        if($nama_perusahaan_supplier == $prev_supplier && empty($supplier->masterDataSubSupplier->nama_perusahaan_supplier)) {
                            $supplier_id = !empty($supplier->masterDataSupplier) ? $supplier->masterDataSupplier->id : '';
                        } else {
                            $prev_supplier = '';
                        }
                    }
                }
                
                $component_id = !empty($supplier->component_id) ? $supplier->component_id : '';

                $data[$component_id]['jumlah_supplier'][$supplier->supplier_id] = [
                    'kategori_id' => !empty($supplier->component_id) ? $supplier->component_id : '',
                    'nama_komponen' => !empty($supplier->masterDataKomponen) ? $supplier->masterDataKomponen->nama_komponen : '',
                ];

                $data[$component_id]['jumlah_tenaga_kerja'][$supplier->supplier_id] = $this->data_tenaga_kerja($supplier->supplier_id);
            }

            $data_merge = array_merge_recursive($data_komponen, $data);


            foreach($data_merge as $key => $value) {

                $results[$key] = [
                    'kategori_id' => $key,
                    'nama_komponen' => $value['nama_komponen'],
                    'jumlah_supplier' => !empty($value['jumlah_supplier']) ? number_format(count($value['jumlah_supplier']),0,'.','.') : 0,
                    'jumlah_tenaga_kerja' => !empty($value['jumlah_tenaga_kerja']) ? number_format(array_sum($value['jumlah_tenaga_kerja']),0,'.','.') : 0,
                ];
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => array_values($results)
            ], 200);
        }

        if(!empty($data)) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ]);
        }

        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found',
            'data' => $data
        ]);
    }

    public function report_pohon_industri_supplier($kategori_id)
    {
        
        $email_pic = [];
        $no_tlp_pic = [];

        $suppliers = Supplier::with('masterDataSupplier')
                    ->with('masterDataSubSupplier')
                    ->with('masterDataSupplier.masterDataSupplierPic')
                    ->with('masterDataSubSupplier.masterDataSupplierPic')
                    ->where('component_id', $kategori_id)
                    ->where('in_house', 0)
                    ->get();

        if($suppliers->isNotEmpty()){
            
            $prev_supplier = '';
            $alamat_pabrik = '';

            foreach($suppliers as $key => $supplier) {

                
                $data_pic = !empty($supplier->masterDataSupplier->masterDataSupplierPic) ? $supplier->masterDataSupplier->masterDataSupplierPic : '';

                foreach($data_pic as $key => $value) {
                    $email_pic[$supplier->supplier_id][] = !empty($value->email_pic) ? $value->email_pic : '';
                    $no_tlp_pic[$supplier->supplier_id][] = !empty($value->no_telp_pic) ? $value->no_telp_pic : '';
                }
            
                $supplier_id = !empty($supplier->supplier_id) ? $supplier->supplier_id : '';
                $nama_perusahaan_supplier = $supplier->masterDataSupplier->nama_perusahaan_supplier;

                if($prev_supplier != $nama_perusahaan_supplier) {

                    $prev_supplier = $nama_perusahaan_supplier;
                    $supplier_id = !empty($supplier->masterDataSupplier) ? $supplier->masterDataSupplier->id : '';
                    $alamat_pabrik = !empty($supplier->masterDataSupplier) ? $supplier->masterDataSupplier->alamat_pabrik : '';

                } else {

                    if(!empty($supplier->masterDataSubSupplier)) {
                        $prev_supplier = $supplier->masterDataSubSupplier->nama_perusahaan_supplier;
                        $supplier_id = !empty($supplier->masterDataSupplier) ? $supplier->masterDataSupplier->id : '';
                        $alamat_pabrik = !empty($supplier->masterDataSubSupplier) ? $supplier->masterDataSubSupplier->alamat_pabrik : '';
                    } else {

                        if($nama_perusahaan_supplier == $prev_supplier && empty($supplier->masterDataSubSupplier->nama_perusahaan_supplier)) {
                            $supplier_id = !empty($supplier->masterDataSupplier) ? $supplier->masterDataSupplier->id : '';
                            $prev_supplier = $nama_perusahaan_supplier;
                        } else {
                            $prev_supplier = '';
                        }
                    }
                }

                
                $data[$supplier->supplier_id] = [
                    'supplier' => $prev_supplier,
                    'supplier_id' => $supplier_id,
                    'tenaga_kerja' => number_format($this->data_tenaga_kerja($supplier_id),0,'.','.'),
                    'alamat_pabrik' => $alamat_pabrik,
                    'email_pic' => !empty($email_pic[$supplier->supplier_id]) ? implode(', ',array_unique($email_pic[$supplier->supplier_id])) : '',
                    'no_tlp_pic' => !empty($no_tlp_pic[$supplier->supplier_id]) ? implode(', ',array_unique($no_tlp_pic[$supplier->supplier_id])) : ''
                ];
            
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => array_values($data)
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found'
        ], 404);

    }

    public function report_supplier_komponen_apm()
    {
        $data = [];
        $results = [];
        $dataCategory = [];
        $finalResults = [];


        if(!empty(request()->komponen_kategori)) {
        
            $categories = Komponen::with('masterDataKategoriKomponen')->whereHas('masterDataKategoriKomponen', function(Builder $queryCategoryComponentId) {
                $queryCategoryComponentId->when(request()->komponen_kategori, function($query, $komponen_kategori) {
                    return $query->where('kategori_id', $komponen_kategori);
                });
            })
            ->pluck('nama_komponen','id')
            ->all();
        
            $suppliers = Supplier::with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                $queryApm->when(request()->apm, function($query, $apm) {
                    return $query->where('id', $apm);
                });
            })
            ->with('masterDataKomponen.masterDataKategoriKomponen')->whereHas('masterDataKomponen.masterDataKategoriKomponen', function(Builder $queryCategoryComponentId) {
                $queryCategoryComponentId->when(request()->komponen_kategori, function($query, $komponen_kategori) {
                    return $query->where('kategori_id', $komponen_kategori);
                });
            })
            ->with('masterDataSupplier')
            ->with('masterDataSubSupplier')
            ->where('in_house', 0)
            ->get();
            

            if($suppliers->isNotEmpty()){
                
                $prev_supplier = '';

                foreach($suppliers as $key => $supplier) {

                    $apm_id = !empty($supplier->masterDataModel->masterDataApm) ? $supplier->masterDataModel->masterDataApm->id : '';
                    $komponen_id = !empty($supplier->component_id) ? $supplier->component_id : '';
                
                    $nama_perusahaan_supplier = $supplier->masterDataSupplier->nama_perusahaan_supplier;

                    if($prev_supplier != $nama_perusahaan_supplier) {

                        $prev_supplier = $nama_perusahaan_supplier;
                    
                    } else {

                        if(!empty($supplier->masterDataSubSupplier)) {
                            $prev_supplier = $supplier->masterDataSubSupplier->nama_perusahaan_supplier;
                        } else {
                            
                            if($nama_perusahaan_supplier == $prev_supplier && empty($supplier->masterDataSubSupplier->nama_perusahaan_supplier)) {
                                $prev_supplier = $nama_perusahaan_supplier;
                            } else {
                                $prev_supplier = '';
                            }
                        }
                    }
                    
                    $data[$apm_id]['name'] = !empty($supplier->masterDataModel->masterDataApm) ? $supplier->masterDataModel->masterDataApm->slug : '';
                    $data[$apm_id]['supplier'][$komponen_id][] = $prev_supplier;
                }


                foreach($categories as $keyCategory => $category) {
                    $dataCategory[$keyCategory] = 0;
                }

                foreach($data as $keyApm => $valueApm) {

                    $results[$keyApm]['name'] = $valueApm['name'];
                    $results[$keyApm]['data'] = array_values(array_merge($dataCategory, $valueApm['supplier']));
                }
                
                foreach($categories as $keyCategory => $category) {
                    $dataCategory[$keyCategory] = 0;
                }
    
                foreach($data as $keyApm => $valueApm) {
    
                    $results[$keyApm]['name'] = $valueApm['name'];
                    $results[$keyApm]['data'] = array_values(array_merge($dataCategory, $valueApm['supplier']));
                }
    
                
                foreach($results as $keyApm => $valueApm) {
                    $finalResult[$keyApm]['name'] = $valueApm['name']; 
    
                    foreach($valueApm['data'] as $keyData => $valueData) {                    
                        $finalResult[$keyApm]['data'][] = is_array($valueApm['data'][$keyData]) ? count(array_filter($valueApm['data'][$keyData])) : 0;
                    }
                }
    
                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => [
                        'data' => array_values($finalResult),
                        'categories' => array_values($categories)
                    ]
                ], 200);
            }
        }


        return response()->json([
            'code' => 404,
            'message' => 'Data Not Found',
            'data' => []
        ], 404);
    }

    public function data_tenaga_kerja($supplier_id)
    {
        $profilePerusahan = ProfilPerusahaanSupplier::selectRaw('MAX(jumlah_tenaga_kerja) as tenaga_kerja')
            ->where('supplier_id', $supplier_id)
            ->where('kondisi', 'setelah')
            ->first();

        return !empty($profilePerusahan->tenaga_kerja) ? $profilePerusahan->tenaga_kerja : 0;
        
    }

}