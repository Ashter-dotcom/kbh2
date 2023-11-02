<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class D4BExport implements FromView
{

    protected $apm;
    protected $profil;
    protected $attribute;
    protected $kondisi;
    protected $periodeTahun;

    public function __construct($apm, $profil, $attribute, $kondisi, $periodeTahun)
    {
        $this->apm = $apm;
        $this->profil = $profil;
        $this->attribute = $attribute;
        $this->kondisi = $kondisi;
        $this->periodeTahun = $periodeTahun;
    }

    public function view(): View
    {
        return view('ViewData.D4B.Unduh', [
            'apm' => $this->apm,
            'profil' => $this->profil,
            'attribute' => $this->attribute,
            'kondisi' => $this->kondisi,
            'periodeTahun' => $this->periodeTahun
        ]);
    }
}