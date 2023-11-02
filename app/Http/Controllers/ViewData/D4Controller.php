<?php

namespace App\Http\Controllers\ViewData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\ProfilPerusahaan\Interfaces\ProfilPerusahaanApmInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\D4AExport;
use App\Exports\D4BExport;

class D4Controller extends Controller
{
    private $apmRepository;
    private $profilPerusahaanApm;
    private $attribute;
    private $periodeTahun;

    public function __construct(ApmInterface $apmRepository, ProfilPerusahaanApmInterface $profilPerusahaanApm)
    {
        $this->apmRepository = $apmRepository;
        $this->profilPerusahaanApm = $profilPerusahaanApm;
        $this->attribute = Config('params')['profil']['apm'];
        $this->periodeTahun = Config('params')['periode-tahun']['pertama'];
    }

    public function d4aIndex()
    {
        return view('ViewData.D4A.Index');
    }

    public function d4aLihat(Request $request)
    {
        if (!empty($request->apm)) {
            $apm = $this->apmRepository->findById($request->apm);
            $profil = $this->profilPerusahaanApm->findByPerusahaanApmId($request->apm);
            $kondisi = 'sebelum';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;
            
            return view('ViewData.D4A.Lihat', compact(["apm","profil","attribute","kondisi","periodeTahun"]));
        }else{
            return redirect()->route('view-data-d4a-index')->with('danger', 'Pilihan Data Perusahaan APM harus terisi');
        }
    }

    public function d4aUnduh(Request $request)
    {
        if (!empty($request->apm)) {
            $apm = $this->apmRepository->findById($request->apm);
            $profil = $this->profilPerusahaanApm->findByPerusahaanApmId($request->apm);
            $kondisi = 'sebelum';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;

            return Excel::download(new D4AExport($apm, $profil, $attribute, $kondisi, $periodeTahun), 'Data_D4A_' .$apm->slug. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }

    public function d4bIndex()
    {
        return view('ViewData.D4B.Index');
    }

    public function d4bLihat(Request $request)
    {
        if ($request->apm) {
            $apm = $this->apmRepository->findById($request->apm);
            $profil = $this->profilPerusahaanApm->findByPerusahaanApmId($request->apm);
            $kondisi = 'setelah';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;
            
            return view('ViewData.D4B.Lihat', compact(["apm","profil","attribute","kondisi","periodeTahun"]));
        }else{
            return redirect()->route('view-data-d4b-index')->with('danger', 'Pilihan Data Perusahaan APM harus terisi');
        }
    }

    public function d4bUnduh(Request $request)
    {
        if (!empty($request->apm)) {
            $apm = $this->apmRepository->findById($request->apm);
            $profil = $this->profilPerusahaanApm->findByPerusahaanApmId($request->apm);
            $kondisi = 'setelah';
            $periodeTahun = $this->periodeTahun[$kondisi];
            $attribute = $this->attribute;

            return Excel::download(new D4BExport($apm, $profil, $attribute, $kondisi, $periodeTahun), 'Data_D4B_' .$apm->slug. '_' . date('Y-m-d-H-i-s') . '.xlsx');
        }

        return  false;
    }
}
