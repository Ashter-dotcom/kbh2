<?php

namespace App\Http\Controllers\ProfilPerusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\ProfilPerusahaan\PerusahaanApmDataTable;
use App\Repository\MasterData\Interfaces\ApmInterface;
use App\Repository\ProfilPerusahaan\Eloquent\ProfilPerusahaanApmEloquent;
use App\Repository\MasterData\Interfaces\PeriodeInterface;

class ProfilApmController extends Controller
{
    private $apmRepository;
    private $profilPerusahaanApmInterface;
    private $periodeRepository;

    public function __construct(ApmInterface $apmRepository, PeriodeInterface $periodeRepository)
    {
        $this->apmRepository = $apmRepository;
        $this->periodeRepository = $periodeRepository;
        $this->profilPerusahaanApmInterface = new ProfilPerusahaanApmEloquent();
    }

    public function index(PerusahaanApmDataTable $dataTable)
    {
        return $dataTable->render('ProfilPerusahaan.Apm.Index');
    }

    public function editSebelum(Request $request)
    {
        $apm = $this->apmRepository->findById($request->id);
        $periodeTahun = Config('params')['periode-tahun']['pertama']['sebelum'];
        $data = $this->profilPerusahaanApmInterface->findByPerusahaanApmId($request->id);

        return view('ProfilPerusahaan.Apm.EditSebelum', compact(["apm","periodeTahun","data"]));
    }

    public function updateSebelum(Request $request)
    {
        $this->profilPerusahaanApmInterface->update($request->all());

        return back()->with('success', 'Data Profil Perusahaan APM Sebelum Insentif berhasil disimpan');
    }

    public function editSetelah(Request $request)
    {
        $apm = $this->apmRepository->findById($request->id);
        $periodeTahun = Config('params')['periode-tahun']['pertama']['setelah'];
        $data = $this->profilPerusahaanApmInterface->findByPerusahaanApmId($request->id);

        return view('ProfilPerusahaan.Apm.EditSetelah', compact(["apm","periodeTahun","data"]));
    }

    public function updatesetelah(Request $request)
    {
        $this->profilPerusahaanApmInterface->update($request->all());

        return redirect()->route('profil-perusahaan-apm-index')->with('success', 'Data Profil Perusahaan APM setelah Insentif berhasil disimpan');
    }
}
