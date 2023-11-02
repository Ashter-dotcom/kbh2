<?php

namespace App\Http\Controllers\ViewData;


use DB;
use File;
use App\Exports\H3Export;
use App\Exports\D7BExport;
use App\Exports\D7CExport;
use Illuminate\Http\Request;
use Box\Spout\Common\Entity\Row;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductionForm\Selling;
use Illuminate\Support\Facades\Storage;
use Box\Spout\Common\Entity\Style\Color;
use Illuminate\Database\Eloquent\Builder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use App\Repository\MasterData\Interfaces\ApmInterface;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
class D7Controller extends Controller
{
    private $apmRepository;
    private $periodeRepository;

    public function __construct(ApmInterface $apmRepository, PeriodeInterface $periodeRepository)
    {
        ini_set('memory_limit', '256M');

        if(!File::isDirectory(storage_path('excel'))){
            File::makeDirectory(storage_path('excel'), 0777, true, true);
        }

        $this->apmRepository = $apmRepository;
        $this->periodeRepository = $periodeRepository;
    }

    public function h3Index()
    {

        if(!empty(request()->apm) && !empty(request()->periode)) {
            $this->data['no'] = !empty(request()->page) && request()->page != 1 ? (100 * request()->page) + 1  : 1;
            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['periode'] = $this->periodeRepository->findById(request()->periode);
            $this->data['results'] = $this->h3data($this->apmRepository, $this->periodeRepository);
        }

        return view('ViewData.H3.Index', ['data' => $this->data]);
    }

    public function d7bIndex()
    {
        if(!empty(request()->apm) && !empty(request()->periode)) {
            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['periode'] = $this->periodeRepository->findById(request()->periode);
            $this->data['results'] = $this->d7bdata($this->apmRepository, $this->periodeRepository);

        }

        return view('ViewData.D7B.Index', ['data' => $this->data]);
    }

    public function d7cIndex()
    {

        if(!empty(request()->apm) && !empty(request()->periode)) {
            $this->data['apm'] = $this->apmRepository->findById(request()->apm);
            $this->data['periode'] = $this->periodeRepository->findById(request()->periode);
            $this->data['results'] = $this->d7cdata($this->apmRepository, $this->periodeRepository);
        }

        return view('ViewData.D7C.Index', ['data' => $this->data]);
    }

    public function h3unduh()
    {

        if(!empty(request()->apm) && !empty(request()->periode)) {
            $apm = $this->apmRepository->findById(request()->apm);
            $periode = $this->periodeRepository->findById(request()->periode);

            return $this->h3dataunduh($this->apmRepository,  $this->periodeRepository);

            return Excel::download(new H3Export($results, $apm, $periode), 'DataH3'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }

        return  false;

    }

    public function d7bunduh()
    {
        if(!empty(request()->apm) && !empty(request()->periode)) {
            $apm = $this->apmRepository->findById(request()->apm);
            $periode = $this->periodeRepository->findById(request()->periode);
            $results = $this->d7bdata($this->apmRepository,  $this->periodeRepository, $action = 'unduh');

            return Excel::download(new D7BExport($results['data'], $apm, $periode), 'Data7B'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }

        return  false;

    }

    public function d7cunduh()
    {
        if(!empty(request()->apm) && !empty(request()->periode)) {
            $apm = $this->apmRepository->findById(request()->apm);
            $periode = $this->periodeRepository->findById(request()->periode);
            $results = $this->d7cdata($this->apmRepository, $this->periodeRepository, $action = 'unduh');

            return Excel::download(new D7CExport($results['data'], $apm, $periode), 'Data7C'.$apm->slug.date('Y-m-dH:i:s').'.xlsx');
        }

        return  false;
    }

    public function h3data($apm, $periode)
    {
        $data = [];
        $dataApmById = $apm->findById(request()->apm);
        $dataPeriodeByPeriodeId = $periode->findById(request()->periode);

        return DB::table('data_d7')->select('merek','jenis_kbm','nama_model','nama_tipe','nama_varian','nama_kapasitas_silinder','nik')
            ->where('apm_id', request()->apm)
            ->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\")
                    BETWEEN
                DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\")
                    AND
                DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")
            ")
            ->paginate(100);
    }

    public function h3dataunduh($apm, $periode)
    {

        $writer = WriterEntityFactory::createXLSXWriter();
        $filePath = storage_path('excel/h3_'.date('Y-m-d').'.xlsx');
        $oldFile = storage_path('excel/h3_'.date('Y-m-d', strtotime('-1 day')).'.xlsx');

        if(file_exists($oldFile)) {
            unlink($oldFile);
        }

        try {

            $data = [];
            $dataApmById = $apm->findById(request()->apm);
            $dataPeriodeByPeriodeId = $periode->findById(request()->periode);

            $writer->openToFile($filePath); // write data to a file or to a PHP stream

            $cells = [
                WriterEntityFactory::createCell('No'),
                WriterEntityFactory::createCell('Grouping Hasil Produksi Berdasarkan IUI'),
                WriterEntityFactory::createCell('Merek'),
                WriterEntityFactory::createCell('Jenis'),
                WriterEntityFactory::createCell('Model'),
                WriterEntityFactory::createCell('Tipe'),
                WriterEntityFactory::createCell('Varian'),
                WriterEntityFactory::createCell('Kapasitas Silinder'),
                WriterEntityFactory::createCell('NIK'),
                WriterEntityFactory::createCell('Keterangan'),
            ];

            /** add a row at a time */
            $singleRow = WriterEntityFactory::createRow($cells);
            $writer->addRow($singleRow);

            $lists = DB::table('data_d7')->select('merek','jenis_kbm','nama_model','nama_tipe','nama_varian','nama_kapasitas_silinder','nik')
                ->where('apm_id', request()->apm)
                ->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\")
                        BETWEEN
                    DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\")
                        AND
                    DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")
                ")
                ->get()
                ->toArray();

            $lists = json_decode(json_encode($lists), true);

            foreach($lists as $key => $list) {
                $no = $key + 1;
                array_unshift($list, $no, 'Pembuatan / perakitan kendaraan bermotor roda empat');
                $list['keterangan'] = '-';

                $rowFromValues = WriterEntityFactory::createRowFromArray(array_values($list));
                $writer->addRow($rowFromValues);
            }

            $writer->close();

            return response()->download($filePath);

        } catch (\Throwable $th) {
            unlink($oldFile);
        }


    }

    public function d7bdata($apm, $periode, $action = 'list')
    {
        $data = [];
        $dataApmById = $apm->findById(request()->apm);
        $dataPeriodeByPeriodeId = $periode->findById(request()->periode);

        $dataPenjualan = DB::table('data_d7')->selectRaw("merek, jenis_kbm, nama_model, nama_tipe, nama_varian, nama_kapasitas_silinder, GROUP_CONCAT(nik) as nik, GROUP_CONCAT(DISTINCT(customer)) as customer,GROUP_CONCAT(harga) as harga, count(nik) as total_nik")
            ->where('apm_id', request()->apm)
            ->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\")
                BETWEEN
                DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\")
                    AND
                DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")
                    AND
                DATE_FORMAT(tanggal_penjualan, \"%Y-%m\")
                    BETWEEN DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\")
                    AND
                DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")
            ")
            ->groupBy('model_id');


            if($action == 'unduh') {
                $dataPenjualan = $dataPenjualan->get();
            } else {
                $dataPenjualan = $dataPenjualan->paginate(1);
            }

        foreach($dataPenjualan as $keyDataPenjualan => $valueDataPenjualan) {
            $data[] = [
                'no' => $action != 'unduh' ? ($dataPenjualan->currentpage()-1) * $dataPenjualan->perpage() + $keyDataPenjualan + 1 : $keyDataPenjualan + 1,
                'grouping_berdasarkan_uiu' => 'Pembuatan / perakitan kendaraan bermotor roda empat',
                'merek' => !empty($valueDataPenjualan->merek) ? $valueDataPenjualan->merek : '',
                'jenis' => !empty($valueDataPenjualan->jenis_kbm) ? $valueDataPenjualan->jenis_kbm : '',
                'model' => !empty($valueDataPenjualan->nama_model) ? $valueDataPenjualan->nama_model : '',
                'tipe' => !empty($valueDataPenjualan->nama_tipe) ? $valueDataPenjualan->nama_tipe : '',
                'varian' => !empty($valueDataPenjualan->nama_varian) ? $valueDataPenjualan->nama_varian : '',
                'kapasitas_silinder' => !empty($valueDataPenjualan->nama_kapasitas_silinder) ? $valueDataPenjualan->nama_kapasitas_silinder : '',
                'nik' => !empty($valueDataPenjualan->nik) ? explode(',',$valueDataPenjualan->nik) : '',
                'customer' => !empty($valueDataPenjualan->customer) ? explode(',',$valueDataPenjualan->customer) : '',
                'harga' => !empty($valueDataPenjualan->harga) ? explode(',',$valueDataPenjualan->harga) : '',
                'total_nik' => !empty($valueDataPenjualan->total_nik) ? number_format($valueDataPenjualan->total_nik, 0,'.','.') : ''
            ];
        }

        return [
            'data' => $data,
            'pagination' => $dataPenjualan
        ];
    }

    public function d7cdata($apm, $periode, $action = 'list')
    {

        $data = [];

        $dataApmById = $apm->findById(request()->apm);
        $dataPeriodeByPeriodeId = $periode->findById(request()->periode);

        $dataStock = DB::table('data_d7')
            ->selectRaw("merek, jenis_kbm, nama_model, nama_tipe, nama_varian, nama_kapasitas_silinder, GROUP_CONCAT(nik) as nik, count(nik) as total_nik")
            ->where('apm_id', request()->apm)
            ->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\") <= DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")")
            ->whereNull('tanggal_penjualan')
            ->groupBy('model_id');

        if($action == 'unduh') {
            $dataStock = $dataStock->get();
        } else {
            $dataStock = $dataStock->paginate(10);
        }

        foreach($dataStock as $keyDataStock => $valueDataStock) {
            $data[] = [
                'no' => $action != 'unduh' ? ($dataStock->currentpage()-1) * $dataStock->perpage() + $keyDataStock + 1 : $keyDataStock + 1,
                'grouping_berdasarkan_uiu' => 'Pembuatan / perakitan kendaraan bermotor roda empat',
                'merek' => !empty($valueDataStock->merek) ? $valueDataStock->merek : '',
                'jenis' => !empty($valueDataStock->jenis_kbm) ? $valueDataStock->jenis_kbm : '',
                'model' => !empty($valueDataStock->nama_model) ? $valueDataStock->nama_model : '',
                'tipe' => !empty($valueDataStock->nama_tipe) ? $valueDataStock->nama_tipe : '',
                'varian' => !empty($valueDataStock->nama_varian) ? $valueDataStock->nama_varian : '',
                'kapasitas_silinder' => !empty($valueDataStock->nama_kapasitas_silinder) ? $valueDataStock->nama_kapasitas_silinder : '',
                'nik' => !empty($valueDataStock->nik) ? explode(',',$valueDataStock->nik) : '',
            ];
        }

        return [
            'data' => $data,
            'pagination' => $dataStock
        ];
    }
}
