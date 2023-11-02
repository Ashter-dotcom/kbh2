<?php

namespace App\Exports;


use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;


class D3Export extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, WithColumnWidths, WithCustomValueBinder
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
            'A' => 10,
            'B' => 55,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 25,
            'G' => 25,
            'H' => 25,
            'I' => 25,
            'J' => 25,
            'K' => 25,
            'L' => 25,
            'M' => 25,
            'N' => 25,
            'O' => 25,
            'P' => 25,
        ];
    }

    public function view(): View
    {
        $this->data['apm'] = $this->apm->nama_perusahaan_apm;
        $this->data['model'] = $this->model;
        $this->data['periode'] = $this->periode->nama_periode .' - '. date_bahasa($this->periode->mulai, ['display_hari' => false]) .' sampai '. date_bahasa($this->periode->selesai, ['display_hari' => false]);
        $this->data['results'] = $this->results;

        return view('ViewData.D3.export', ['data' => $this->data]);
    }
}
