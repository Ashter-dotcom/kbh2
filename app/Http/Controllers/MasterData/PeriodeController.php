<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\PeriodeDataTable;
use App\Http\Requests\MasterData\PeriodeRequest;
use App\Repository\MasterData\Interfaces\PeriodeInterface;
use App\Repository\MasterData\Eloquent\KapasitasSilinderEloquent;

class PeriodeController extends Controller
{
    private $periodeRepository;
    private $kapasitasSilinder;

    public function __construct(PeriodeInterface $periodeRepository)
    {
        $this->periodeRepository = $periodeRepository;
        $this->kapasitasSilinder = new KapasitasSilinderEloquent();
    }

    public function index(PeriodeDataTable $dataTable)
    {
        return $dataTable->render('MasterData.Periode.Index');
    }

    public function create()
    {
        return view('MasterData.Periode.Create');
    }

    public function store(PeriodeRequest $request)
    {
        $this->periodeRepository->store($request->all());

        return redirect()->route('master-data-periode-index')->with('success', 'Data Periode berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $periode = $this->periodeRepository->findById($request->id);
        $kelompokKapasitasSilinder = $this->kapasitasSilinder->all()->toArray();

        return view('MasterData.Periode.Edit', compact(["periode","kelompokKapasitasSilinder"]));
    }

    public function update(PeriodeRequest $request)
    {
        $this->periodeRepository->update($request->all());

        return redirect()->route('master-data-periode-index')->with('success', 'Data Periode berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->periodeRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->periodeRepository->cari($request->q);
    }
}
