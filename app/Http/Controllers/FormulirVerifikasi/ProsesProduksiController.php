<?php

namespace App\Http\Controllers\FormulirVerifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\DataTables\MasterData\MerekDataTable;
use App\Http\Requests\FormulirVerifikasi\ProsesProduksiRequest;
use App\Repository\FormulirVerifikasi\Interfaces\ProsesProduksiInterface;
use App\Repository\MasterData\Interfaces\KomponenModelInterface;

class ProsesProduksiController extends Controller
{
    private $prosesproduksiRepository;

    public function __construct(ProsesProduksiInterface $prosesproduksiRepository)
    {
        $this->prosesproduksiRepository = $prosesproduksiRepository;
    }

    // public function index(MerekDataTable $dataTable)
    // {
    //     return $dataTable->render('MasterData.Merek.Index');
    // }

    public function create(KomponenModelInterface $componentModel)
    {   
        $this->data['components'] = $componentModel->getDataKomponentModel(['model_id' => request()->model_id,'component_category' => request()->component_category]);
        return view('FormulirVerifikasi.ProsesProduksi.Create');
    }

    public function store(ProsesProduksiRequest $request)
    {
        $this->prosesproduksiRepository->store($request->all());

        return redirect()->route('formulir-verifikasi-prosesproduksi-create')->with('success', 'Proses Produksi berhasil ditambahkan');
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
        return $this->prosesproduksiRepository->cari($request->q=false,$request->supplierId);
    }
}
