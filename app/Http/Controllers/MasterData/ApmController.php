<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\ApmDataTable;
use App\Http\Requests\MasterData\ApmRequest;
use App\Repository\MasterData\Interfaces\ApmInterface;

class ApmController extends Controller
{
    private $apmRepository;

    public function __construct(ApmInterface $apmRepository)
    {
        $this->apmRepository = $apmRepository;
    }

    public function index(ApmDataTable $dataTable)
    {
        return $dataTable->render('MasterData.Apm.Index');
    }

    public function create()
    {
        return view('MasterData.Apm.Create');
    }

    public function store(ApmRequest $request)
    {
        $this->apmRepository->store($request->all());

        return redirect()->route('master-data-apm-index')->with('success', 'Data Perusahaan APM berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $apm = $this->apmRepository->findById($request->id);

        return view('MasterData.Apm.Edit', compact("apm"));
    }

    public function update(ApmRequest $request)
    {
        $this->apmRepository->update($request->all());

        return redirect()->route('master-data-apm-index')->with('success', 'Data Perusahaan APM berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->apmRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->apmRepository->cari($request->q);
    }
}
