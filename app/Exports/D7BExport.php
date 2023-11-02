<?php

namespace App\Exports;


use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class D7BExport implements FromView,WithStyles
{
    protected $apm;
    protected $periode;
    protected $results;

    public function __construct($results, $apm, $periode)
    {
        $this->apm = $apm;
        $this->periode = $periode;
        $this->results = $results;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true) ;
        $sheet->getColumnDimension('B')->setAutoSize(true) ;
        $sheet->getColumnDimension('C')->setAutoSize(true) ;
        $sheet->getColumnDimension('D')->setAutoSize(true) ;
        $sheet->getColumnDimension('E')->setAutoSize(true) ;
        $sheet->getColumnDimension('F')->setAutoSize(true) ;
        $sheet->getColumnDimension('G')->setAutoSize(true) ;
        $sheet->getColumnDimension('H')->setAutoSize(true) ;
        $sheet->getColumnDimension('I')->setAutoSize(true) ;
        $sheet->getColumnDimension('J')->setAutoSize(true) ;
        $sheet->getColumnDimension('K')->setAutoSize(true) ;
        $sheet->getColumnDimension('L')->setAutoSize(true) ;
        $sheet->getColumnDimension('M')->setAutoSize(true) ;
    }

    public function view(): View
    {
        $this->data['no'] = 1;
        $this->data['apm'] = $this->apm->nama_perusahaan_apm;
        $this->data['periode'] = $this->periode->nama_periode .' - '. date_bahasa($this->periode->mulai, ['display_hari' => false]) .' sampai '. date_bahasa($this->periode->selesai, ['display_hari' => false]);
        $this->data['results'] = $this->results;

        return view('ViewData.D7B.export', ['data' => $this->data]);
    }
}
