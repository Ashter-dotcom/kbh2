<?php

namespace App\Http\Controllers\ViewData;


use Illuminate\Http\Request;
use App\Exports\D2Export;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductionForm\Selling;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\MasterData\Interfaces\PeriodeInterface;


class D2Controller extends Controller
{
    private $apmRepository;
    private $modelRepository;
    private $periodeRepository;

    public function __construct(ApmInterface $apmRepository, PeriodeInterface $periodeRepository, ModelInterface $modelRepository)
    {
        $this->apmRepository = $apmRepository;
        $this->modelRepository = $modelRepository;
        $this->periodeRepository = $periodeRepository;
    }

    public function Index()
    {
        if(!empty(request()->apm) && !empty(request()->periode)) {
            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['periode'] = $this->periodeRepository->findById(request()->periode);
            $this->data['results'] = $this->d2data($this->apmRepository, $this->periodeRepository, $this->modelRepository);

        }

        return view('ViewData.D2.Index', ['data' => $this->data]);
    }

    public function unduh()
    {

        if(!empty(request()->apm) && !empty(request()->periode)) {

            $results = $this->d2data($this->apmRepository, $this->periodeRepository, $this->modelRepository);

            $apm = $this->apmRepository->findById(request()->apm);
            $periode = $this->periodeRepository->findById(request()->periode);

            return Excel::download(new D2Export($results, $apm, $periode), 'DataD2'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }

        return  false;

    }

    public function d2data($apm, $periode, $model)
    {

        $data = [];
        $dataApmById = $apm->findById(request()->apm);
        $dataPeriodeByPeriodeId = $periode->findById(request()->periode);


        $totalRencanaUnit = $model->findByApm(request()->apm);
        $ranges = $periode->purchasePeriode($params = ['mulai' => $dataPeriodeByPeriodeId->mulai, 'selesai' => $dataPeriodeByPeriodeId->selesai]);


        $poduksiDanPenjualan = Selling::selectRaw('count(tanggal_produksi) as total_produksi, count(tanggal_penjualan) as total_penjualan, tanggal_produksi, tanggal_penjualan, model_id')->with('masterDataModel')->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                $queryApm->where('id', request()->apm);
            })
            ->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\") >= DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\") AND DATE_FORMAT(tanggal_produksi, \"%Y-%m\") <= DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")")
            ->groupByRaw('model_id, tanggal_produksi, tanggal_penjualan')
            ->get();


        foreach($poduksiDanPenjualan as $list) {

            $tahun = date('Y');
            $modelId = !empty($list->model_id) ? $list->model_id : '';
            $bulanProduksi = trim(date_bahasa($list->tanggal_produksi, ['display_hari' => false, 'display_tahun' => false]));
            $bulanPenjualan = !empty($list->tanggal_penjualan) ? trim(date_bahasa($list->tanggal_penjualan, ['display_hari' => false, 'display_tahun' => false])) : 0;

            $data[$modelId]['report'] = [
                'jenis' => !empty($list->masterDataModel) ? $list->masterDataModel->jenis_kbm : '',
                'merek' => !empty($list->masterDataModel->masterDataApm) ? $list->masterDataModel->masterDataApm->nama_perusahaan_apm : '-',
                'model' => !empty($list->masterDataModel) ? $list->masterDataModel->nama_model : '',
                'tipe' => !empty($list->masterDataModel) ? $list->masterDataModel->nama_tipe : '',
                'varian' => !empty($list->masterDataModel) ? $list->masterDataModel->nama_varian : '',
                'kapasitas_silinder' => !empty($list->masterDataModel) ? $list->masterDataModel->nama_kapasitas_silinder : '',
                'total_rencana_unit' => !empty($totalRencanaUnit[$modelId]) && in_array($tahun, ['2022','2023']) ? number_format($totalRencanaUnit[$modelId]['rencana_produksi_'.$tahun],0,'.','.') : 0
            ];


            $data[$modelId]['produksi'][$bulanProduksi][] = number_format($list->total_produksi, 0,'.','.');
            $data[$modelId]['penjualan'][$bulanPenjualan][] = number_format($list->total_penjualan, 0,'.','.');

        }

        return [
            'no' => 1,
            'ranges' => [
                'data' => $ranges,
                'total' => count($ranges)
            ],
            'data' => $data
        ];
    }
}
