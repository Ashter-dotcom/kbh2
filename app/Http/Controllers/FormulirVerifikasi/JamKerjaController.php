<?php

namespace App\Http\Controllers\FormulirVerifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\DataTables\MasterData\MerekDataTable;
use App\Http\Requests\FormulirVerifikasi\JamKerjaRequest;
use App\Repository\FormulirVerifikasi\Interfaces\JamKerjaInterface;
use App\Repository\MasterData\Interfaces\KomponenModelInterface;


class JamKerjaController extends Controller
{
    private $jamkerjaRepository;

    public function __construct(JamKerjaInterface $jamkerjaRepository)
    {
        $this->jamkerjaRepository = $jamkerjaRepository;
    }

    // public function index(MerekDataTable $dataTable)
    // {
    //     return $dataTable->render('MasterData.Merek.Index');
    // }

    public function create(KomponenModelInterface $componentModel)
    {
        $this->data['components'] = $componentModel->getDataKomponentModel(['model_id' => request()->model_id,'component_category' => request()->component_category]);
        return view('FormulirVerifikasi.JamKerja.Create', ['data' => $this->data]);
    }

    public function store(JamKerjaRequest $request)
    {
        $this->jamkerjaRepository->store($request->all());

        return redirect()->route('formulir-verifikasi-jamkerja-create')->with('success', 'Jam Kerja berhasil ditambahkan');
    }

    // public function edit(Request $request)
    // {
    //     $merek = $this->prosesproduksiRepository->findById($request->id);

    //     return view('MasterData.Merek.Edit', compact("merek"));
    // }

    // public function update(MerekRequest $request)
    // {
    //     $this->merekRepository->update($request->all());

    //     return redirect()->route('master-data-merek-index')->with('success', 'Data Merek berhasil diubah');
    // }

    // public function delete(Request $request)
    // {
    //     return $this->merekRepository->delete($request->id);
    // }

    public function cari(Request $request)
    {
        return $this->jamkerjaRepository->cari($request->q=false,$request->supplierId);
    }
}
