<?php

namespace App\Exports;


use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;



class D2Export extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView,WithColumnWidths,WithCustomValueBinder
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
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 15,
            'M' => 15,
            'N' => 15,
            'O' => 30,
            'P' => 20,
        ];
    }
    
    public function view(): View
    {
        $this->data['results'] = $this->results;
        $this->data['apm'] = $this->apm->nama_perusahaan_apm;
        $this->data['periode'] = $this->periode->nama_periode .' - '. date_bahasa($this->periode->mulai, ['display_hari' => false]) .' sampai '. date_bahasa($this->periode->selesai, ['display_hari' => false]);

        return view('ViewData.D2.export', ['data' => $this->data]);
    }
}