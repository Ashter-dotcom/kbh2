<?php

namespace App\Exports;


use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class D7AExport implements FromView
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

    public function view(): View
    {
        $this->data['no'] = 1;
        $this->data['apm'] = $this->apm->nama_perusahaan_apm;
        $this->data['periode'] = $this->periode->nama_periode .' - '. date_bahasa($this->periode->mulai, ['display_hari' => false]) .' sampai '. date_bahasa($this->periode->selesai, ['display_hari' => false]);
        $this->data['results'] = $this->results;

        return view('ViewData.D7A.export', ['data' => $this->data]);
    }
}