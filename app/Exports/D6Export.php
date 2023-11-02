<?php

namespace App\Exports;


use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;


class D6Export extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, WithColumnWidths, WithCustomValueBinder
{
    protected $apm;
    protected $model;
    protected $periode;
    protected $results;

    public function __construct($results, $apm, $periode, $model)
    {
        $this->apm = $apm;
        $this->model = $model;
        $this->periode = $periode;
        $this->results = $results;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 25,
            'D' => 30,
            'E' => 30,            
            'F' => 15
        ];
    }

    public function view(): View
    {
        $this->data['no'] = 1;
        $this->data['apm'] = $this->apm->nama_perusahaan_apm;
        $this->data['model'] = $this->model;
        $this->data['periode'] = $this->periode->nama_periode .' - '. date_bahasa($this->periode->mulai, ['display_hari' => false]) .' sampai '. date_bahasa($this->periode->selesai, ['display_hari' => false]);
        $this->data['results'] = $this->results;

        return view('ViewData.D6.export', ['data' => $this->data]);
    }
}