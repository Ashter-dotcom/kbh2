<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class LAP2Export extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, WithColumnWidths, WithCustomValueBinder
{
    protected $tahun;
    protected $results;
    protected $bulan;
    protected $dataKaryawan;
    protected $apm;
    protected $model;
    protected $supplier;

    public function __construct($results,$bulan, $dataKaryawan, $apm, $model, $supplier)
    {
        $this->results = $results;
        $this->bulan = $bulan;
        $this->dataKaryawan = $dataKaryawan;
        $this->apm = $apm;
        $this->model = $model;
        $this->supplier = $supplier;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 25,
            'D' => 35,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 35,
            'M' => 15,
            'N' => 15,
            'O' => 30,
            'P' => 30,
            'Q' => 30,
            'R' => 30,
            'S' => 30,
        ];
    }

    public function view(): View
    {
        $this->data['no'] = 1;
        $this->data['results'] = $this->results;
        $this->data['bulan'] = $this->bulan;
        $this->data['dataKaryawan'] = $this->dataKaryawan;
        $this->data['apm'] = $this->apm;
        $this->data['model'] = $this->model;
        $this->data['supplier'] = $this->supplier;

        return view('ViewData.LAP2.export', ['data' => $this->data]);
    }
}
