<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;


class SkviExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, WithColumnWidths, WithCustomValueBinder
{
    protected $results;
    protected $apm;
    protected $apmInformation;

    public function __construct($results, $apm, $apmInformation, $kapasitasSilinder)
    {
        $this->apm = $apm;
        $this->results = $results;
        $this->apmInformation = $apmInformation;
        $this->kapasitasSilinder = $kapasitasSilinder;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 25,            
            'F' => 25,
            'G' => 25,
            'H' => 25
        ];
    }

    public function view(): View
    {
        $this->data['no'] = 1;
        $this->data['apm'] = $this->apm;
        $this->data['results'] = $this->results;
        $this->data['apmInformation'] = $this->apmInformation;
        $this->data['kapasitas_silinder'] = $this->kapasitasSilinder;

        return view('SKVI.export', ['data' => $this->data]);
    }
}