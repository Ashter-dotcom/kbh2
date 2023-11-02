<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class H5Export implements FromView
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
        return view('ViewData.H5.Unduh', [
            'apm' => $this->apm,
            'supplierComponent' => $this->supplierComponent
        ]);
    }
}
