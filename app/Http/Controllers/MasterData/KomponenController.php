<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\KomponenDataTable;
use App\Http\Requests\MasterData\KomponenRequest;
use App\Repository\MasterData\Interfaces\KomponenInterface;

class KomponenController extends Controller
{
    private $komponenRepository;

    public function __construct(KomponenInterface $komponenRepository)
    {
        $this->komponenRepository = $komponenRepository;
    }

    public function index(KomponenDataTable $dataTable)
    {
        return $dataTable->render('MasterData.Komponen.Index');
    }

    public function create()
    {
        return view('MasterData.Komponen.Create');
    }

    public function store(KomponenRequest $request)
    {
        $this->komponenRepository->store($request->all());

        return redirect()->route('master-data-komponen-index')->with('success', 'Data Komponen berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $komponen = $this->komponenRepository->findById($request->id);

        return view('MasterData.Komponen.Edit', compact("komponen"));
    }

    public function update(KomponenRequest $request)
    {
        $this->komponenRepository->update($request->all());

        return redirect()->route('master-data-komponen-index')->with('success', 'Data Komponen berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->komponenRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->komponenRepository->cari($request->q);
    }
}
