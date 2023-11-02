<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\ManufakturingDataTable;
use App\Http\Requests\MasterData\ManufakturingRequest;
use App\Repository\MasterData\Interfaces\ManufakturingInterface;
use App\Repository\MasterData\Eloquent\KomponenEloquent;
use App\Repository\MasterData\Eloquent\KomponenModelEloquent;

class ManufakturingController extends Controller
{
    private $manufakturingRepository;
    private $komponenRepository;
    private $komponenModelRepository;

    public function __construct(ManufakturingInterface $manufakturingRepository)
    {
        $this->manufakturingRepository = $manufakturingRepository;
        $this->komponenRepository = new KomponenEloquent();
        $this->komponenModelRepository = new KomponenModelEloquent();
    }

    public function index(ManufakturingDataTable $dataTable)
    {
        return $dataTable->render('MasterData.Manufakturing.Index');
    }

    public function create()
    {
        $komponen = $this->komponenRepository->all();
        $kategori = $this->komponenRepository->kategori();

        return view('MasterData.Manufakturing.Create', compact(["komponen","kategori"]));
    }

    public function store(ModelRequest $request)
    {
        $this->modelRepository->store($request->all());

        return redirect()->route('master-data-manufakturing-index')->with('success', 'Data Model berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $model = $this->modelRepository->findById($request->id);
        $kategori = $this->komponenRepository->kategori();
        $this->komponenModelRepository->syncComponent($request->id);
        $komponen = $this->komponenModelRepository->findByModelId($request->id);

        return view('MasterData.Manufakturing.Edit', compact(["model","komponen","kategori"]));
    }

    public function update(ModelRequest $request)
    {
        $this->modelRepository->update($request->all());

        return redirect()->route('master-data-model-index')->with('success', 'Data Model berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->modelRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->modelRepository->cari($request->q);
    }
}
