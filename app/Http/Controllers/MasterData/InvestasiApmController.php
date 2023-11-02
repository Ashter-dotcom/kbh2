<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\InvestasiApmDataTable;
use App\Http\Requests\MasterData\InvestasiApmRequest;
use App\Repository\MasterData\Interfaces\ApmInterface;

class InvestasiApmController extends Controller
{
    private $apmRepository;

    public function __construct(ApmInterface $apmRepository)
    {
        $this->apmRepository = $apmRepository;
    }

    public function index(InvestasiApmDataTable $dataTable)
    {
        return $dataTable->render('MasterData.InvestasiApm.Index');
    }

    public function create()
    {
        return view('MasterData.InvestasiApm.Create');
    }

    public function store(InvestasiApmRequest $request)
    {
        $this->apmRepository->store($request->all());

        return redirect()->route('master-data-investasi-apm-index')->with('success', 'Data Investasi APM berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $apm = $this->apmRepository->findById($request->id);

        return view('MasterData.InvestasiApm.Edit', compact("apm"));
    }

    public function update(InvestasiApmRequest $request)
    {
        $this->apmRepository->update($request->all());

        return redirect()->route('master-data-investasi-apm-index')->with('success', 'Data Investasi APM berhasil diubah');
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
