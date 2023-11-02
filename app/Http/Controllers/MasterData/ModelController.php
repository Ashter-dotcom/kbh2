<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\ModelDataTable;
use App\Http\Requests\MasterData\ModelRequest;
use App\Repository\MasterData\Interfaces\ModelInterface;
use App\Repository\MasterData\Eloquent\KomponenEloquent;
use App\Repository\MasterData\Eloquent\KomponenModelEloquent;

class ModelController extends Controller
{
    private $modelRepository;
    private $komponenRepository;
    private $komponenModelRepository;

    public function __construct(ModelInterface $modelRepository)
    {
        $this->modelRepository = $modelRepository;
        $this->komponenRepository = new KomponenEloquent();
        $this->komponenModelRepository = new KomponenModelEloquent();
    }

    public function index(ModelDataTable $dataTable)
    {
        return $dataTable->render('MasterData.Model.Index');
    }

    public function create()
    {
        $komponen = $this->komponenRepository->all();
        $kategori = $this->komponenRepository->kategori();

        return view('MasterData.Model.Create', compact(["komponen","kategori"]));
    }

    public function store(ModelRequest $request)
    {
        $this->modelRepository->store($request->all());

        return redirect()->route('master-data-model-index')->with('success', 'Data Model berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $model = $this->modelRepository->findById($request->id);
        $kategori = $this->komponenRepository->kategori();
        $this->komponenModelRepository->syncComponent($request->id);
        $komponen = $this->komponenModelRepository->findByModelId($request->id);

        return view('MasterData.Model.Edit', compact(["model","komponen","kategori"]));
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
