<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\KapasitasSilinderDataTable;
use App\Http\Requests\MasterData\KapasitasSilinderRequest;
use App\Repository\MasterData\Interfaces\KapasitasSilinderInterface;

class KapasitasSilinderController extends Controller
{
    private $kapasitasSilinderRepository;

    public function __construct(KapasitasSilinderInterface $kapasitasSilinderRepository)
    {
        $this->kapasitasSilinderRepository = $kapasitasSilinderRepository;
    }

    public function index(KapasitasSilinderDataTable $dataTable)
    {
        return $dataTable->render('MasterData.KapasitasSilinder.Index');
    }

    public function create()
    {
        return view('MasterData.KapasitasSilinder.Create');
    }

    public function store(KapasitasSilinderRequest $request)
    {
        $this->kapasitasSilinderRepository->store($request->all());

        return redirect()->route('master-data-kapasitas-silinder-index')->with('success', 'Data Kapasitas Silinder berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $kapasitasSilinder = $this->kapasitasSilinderRepository->findById($request->id);

        return view('MasterData.KapasitasSilinder.Edit', compact("kapasitasSilinder"));
    }

    public function update(KapasitasSilinderRequest $request)
    {
        $this->kapasitasSilinderRepository->update($request->all());

        return redirect()->route('master-data-kapasitas-silinder-index')->with('success', 'Data Kapasitas Silinder berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->kapasitasSilinderRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->kapasitasSilinderRepository->cari($request->q);
    }
}
