<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class D5AExport implements FromView
{

    protected $supplier;
    protected $profil;
    protected $attribute;
    protected $kondisi;
    protected $periodeTahun;

    public function __construct($supplier, $profil, $attribute, $kondisi, $periodeTahun)
    {
        $this->supplier = $supplier;
        $this->profil = $profil;
        $this->attribute = $attribute;
        $this->kondisi = $kondisi;
        $this->periodeTahun = $periodeTahun;
    }

    public function view(): View
    {
        return view('ViewData.D5A.Unduh', [
            'supplier' => $this->supplier,
            'profil' => $this->profil,
            'attribute' => $this->attribute,
            'kondisi' => $this->kondisi,
            'periodeTahun' => $this->periodeTahun
        ]);
    }
}