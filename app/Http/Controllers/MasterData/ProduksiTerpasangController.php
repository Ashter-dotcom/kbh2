<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\MasterData\ProduksiTerpasangDataTable;
use App\Http\Requests\MasterData\MerekRequest;
use App\Repository\MasterData\Interfaces\MerekInterface;

class ProduksiTerpasangController extends Controller
{
    private $merekRepository;

    public function __construct(MerekInterface $merekRepository)
    {
        $this->merekRepository = $merekRepository;
    }

    public function index(ProduksiTerpasangDataTable $dataTable)
    {
        return $dataTable->render('MasterData.ProduksiTerpasang.Index');
    }

    public function create()
    {
        return view('MasterData.ProduksiTerpasang.Create');
    }

    public function store(MerekRequest $request)
    {
        $this->merekRepository->store($request->all());

        return redirect()->route('master-data-merek-index')->with('success', 'Data Merek berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $merek = $this->merekRepository->findById($request->id);

        return view('MasterData.Merek.Edit', compact("merek"));
    }

    public function update(MerekRequest $request)
    {
        $this->merekRepository->update($request->all());

        return redirect()->route('master-data-merek-index')->with('success', 'Data Merek berhasil diubah');
    }

    public function delete(Request $request)
    {
        return $this->merekRepository->delete($request->id);
    }

    public function cari(Request $request)
    {
        return $this->merekRepository->cari($request->q=false,$request->apmId);
    }
}
