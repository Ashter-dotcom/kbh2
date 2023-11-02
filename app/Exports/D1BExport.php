<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class D1BExport implements FromView
{

    protected $apm;
    protected $supplierComponent;

    public function __construct($apm, $supplierComponent)
    {
        $this->apm = $apm;
        $this->supplierComponent = $supplierComponent;
    }

    public function view(): View
    {
        return view('ViewData.D1B.Unduh', [
            'apm' => $this->apm,
            'supplierComponent' => $this->supplierComponent
        ]);
    }
}