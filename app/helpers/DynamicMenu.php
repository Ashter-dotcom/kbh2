<?php

namespace App\helpers;

use App\helpers\Helper;
use Pyaesone17\ActiveState\ActiveFacade;
use App\Repository\MasterData\Eloquent\ApmEloquent;
use Illuminate\Support\Facades\Route;

class DynamicMenu extends Helper
{

    public function sidebar($name=false)
    {
        if ($name == 'Formulir-Profil-Perusahaan') {
            return $this->menuFormulirProfilPerusahaan();
        }
        return false;
    }

    private function menuFormulirProfilPerusahaan()
    {
        return '
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Formulir Profil Perusahaan Collapse Menu -->
            <li class="nav-item '. ActiveFacade::checkRoute("profil-perusahaan-*") .' ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfilPerusahaan" aria-expanded="true" aria-controls="collapseProfilPerusahaan">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Formulir Profil Perusahaan</span>
                </a>
                <div id="collapseProfilPerusahaan" class="collapse '. ActiveFacade::checkRoute(["profil-perusahaan-*"],"show","") .'" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <a class="nav-link '. ActiveFacade::checkRoute("profil-perusahaan-apm-*") .'" href="'.route('profil-perusahaan-apm-index').'">
                        <i class="'. ActiveFacade::checkRoute(["profil-perusahaan-apm-*"],"fas","far") .' fa-building"></i>
                        <span>Perusahaan APM</span>
                    </a>
                    <a class="nav-link '. ActiveFacade::checkRoute("profil-perusahaan-supplier-*") .'" href="'.route('profil-perusahaan-supplier-index').'">
                        <i class="'. ActiveFacade::checkRoute(["profil-perusahaan-supplier-*"],"fas","far") .' fa-building"></i>
                        <span>Perusahaan Supplier</span>
                    </a>
                </div>
            </li>
        ';
    }

}
