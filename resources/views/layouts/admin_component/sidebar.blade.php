@inject('dynamicMenu', \App\helpers\DynamicMenu::class)

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion accordionSubModelData" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://127.0.0.1:8000">
        <div class="sidebar-brand-text mx-3">KBH2-LCEV</div>
    </a>

    <!-- Nav Item - Dashboard -->

    @hasanyrole('superadmin|kemenperin|admin|operator|ta')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item {{ Active::checkRoute('dashboard') }}">
            <a class="nav-link" href="{{ route('dashboard', ['tipe_report' => 'overview']) }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @endrole


    @hasanyrole('superadmin|admin|operator')
        {!! formulir_sidebar() !!}
    @endrole

    @hasanyrole('superadmin|admin|operator')
        {!! $dynamicMenu->sidebar('Formulir-Profil-Perusahaan') !!}
    @endrole

    @hasanyrole('superadmin|admin|operator|ta')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Konfigurasi Collapse Menu -->
        <li class="nav-item {{ Active::checkRoute('formulir-verifikasi-*') }} ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormulirVerifikasi"
                aria-expanded="true" aria-controls="collapseFormulirVerifikasi">
                <i class="fas fa-fw {{ (Active::checkRoute('formulir-verifikasi-*') == 'active') ? 'fa-folder-open' : 'fa-folder' }} "></i>
                <span>Formulir Verifikasi</span>
            </a>
            <div id="collapseFormulirVerifikasi" class="collapse {{ Active::checkRoute(['formulir-verifikasi-*'],'show','') }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Active::checkRoute('formulir-verifikasi-prosesproduksi-*') }}" href="{{ route('formulir-verifikasi-prosesproduksi-create') }}">Proses Produksi</a>
                    <a class="collapse-item {{ Active::checkRoute('formulir-verifikasi-jamkerja-*') }}" href="{{ route('formulir-verifikasi-jamkerja-create') }}">Jam Kerja</a>
                </div>
            </div>
        </li>
    @endrole

    @hasanyrole('superadmin|admin|operator|ta')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Konfigurasi Collapse Menu -->
        <li class="nav-item {{ Active::checkRoute('view-data-*') }} ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseViewData"
                aria-expanded="true" aria-controls="collapseViewData">
                <i class="fas fa-fw {{ (Active::checkRoute('view-data-*') == 'active') ? 'fa-folder-open' : 'fa-folder' }} "></i>
                <span>View Data</span>
            </a>
            <div id="collapseViewData" class="collapse {{ Active::checkRoute(['view-data-*'],'show','') }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Active::checkRoute('view-data-d1a-*') }}" href="{{ route('view-data-d1a-index') }}">V1A</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d1b-*') }}" href="{{ route('view-data-d1b-index') }}">V1B</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d1c-*') }}" href="{{ route('view-data-d1c-index') }}">V1C</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d2-*') }}" href="{{ route('view-data-d2-index') }}">V2</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d3-*') }}" href="{{ route('view-data-d3-index') }}">V3</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-h4-*') }}" href="{{ route('view-data-h4-index') }}">V4</a>
                    <!-- <a class="collapse-item {{ Active::checkRoute('view-data-d4a-*') }}" href="{{ route('view-data-d4a-index') }}">H4</a> -->
                    <a class="collapse-item {{ Active::checkRoute('view-data-d4b-*') }}" href="{{ route('view-data-d4b-index') }}">V5</a>
                    <!-- <a class="collapse-item {{ Active::checkRoute('view-data-h5-*') }}" href="{{ route('view-data-h5-index') }}">H5</a> -->
                    <a class="collapse-item {{ Active::checkRoute('view-data-d5a-*') }}" href="{{ route('view-data-d5a-index') }}">V6A</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d5b-*') }}" href="{{ route('view-data-d5b-index') }}">V6B</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d6-*') }}" href="{{ route('view-data-d6-index') }}">V7</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d7a-*') }}" href="{{ route('view-data-d7a-index') }}">V8</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d7b-*') }}" href="{{ route('view-data-d7b-index') }}">V9</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-d7c-*') }}" href="{{ route('view-data-d7c-index') }}">V10</a>
                    <!-- <a class="collapse-item {{ Active::checkRoute('view-data-d8-*') }}" href="{{ route('view-data-d8-index') }}">H11</a> -->
                    <a class="collapse-item {{ Active::checkRoute('view-data-h11-*') }}" href="{{ route('view-data-h11-index') }}">V11</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-h12-*') }}" href="{{ route('view-data-h12-index') }}">V12</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-lap1-*') }}" href="{{ route('view-data-lap1-index') }}">Lapangan 1</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-lap2-*') }}" href="{{ route('view-data-lap2-index') }}">Lapangan 2</a>
                    <a class="collapse-item {{ Active::checkRoute('view-data-lap3-*') }}" href="{{ route('view-data-lap3-index') }}">Lapangan 3</a>
                </div>
            </div>
        </li>
    @endrole

    @hasanyrole('superadmin|kemenperin|admin|operator|ta')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item {{ Active::checkRoute('skvi*') }}">
            <a class="nav-link" href="{{ route('skvi-index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>SKVI</span>
            </a>
        </li>
    @endrole

    @hasanyrole('superadmin|admin')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Konfigurasi Collapse Menu -->
        <li class="nav-item {{ Active::checkRoute('master-data-*') }} ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
                aria-expanded="true" aria-controls="collapseMasterData">
                <i class="fas fa-fw {{ (Active::checkRoute('master-data-*') == 'active') ? 'fa-folder-open' : 'fa-folder' }} "></i>
                <span>Referensi Data</span>
            </a>
            <div id="collapseMasterData" class="collapse {{ Active::checkRoute(['master-data-*'],'show','') }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Active::checkRoute('master-data-apm-*') }}" href="{{ route('master-data-apm-index') }}">Perusahaan APM</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-merek-*') }}" href="{{ route('master-data-merek-index') }}">Merek Produk</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-komponen-*') }}" href="{{ route('master-data-komponen-index') }}">Komponen</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-model-*') }}" href="{{ route('master-data-model-index') }}">Model</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-supplier-*') }}" href="{{ route('master-data-supplier-index') }}">Perusahaan</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-kapasitas-silinder-*') }}" href="{{ route('master-data-kapasitas-silinder-index') }}">Kapasitas Silinder</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-periode-*') }}" href="{{ route('master-data-periode-index') }}">Periode</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-manufakturing-*') }}" href="{{ route('master-data-manufakturing-index') }}">Manufakturing</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-investasi-apm-*') }}" href="{{ route('master-data-investasi-apm-index') }}">Investasi APM</a>
                    <a class="collapse-item {{ Active::checkRoute('master-data-produksi-terpasang-*') }}" href="{{ route('master-data-produksi-terpasang-index') }}">Produksi Terpasang</a>
                </div>
            </div>
        </li>
    @endrole

    @role('superadmin|admin')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Konfigurasi Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonfigurasi"
                aria-expanded="true" aria-controls="collapseKonfigurasi">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan Sistem</span>
            </a>
            <div id="collapseKonfigurasi" class="collapse {{ Active::checkRoute(['user.*','role.*','permission.*'],'show','') }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Active::checkRoute('user.*') }}" href="{{ route('user.indexuser') }}">Pengguna</a>
                    <a class="collapse-item {{ Active::checkRoute('role.*') }}" href="{{ route('role.indexrole') }}"">Tugas</a>
                    <a class="collapse-item {{ Active::checkRoute('permission.*') }}" href="{{ route('permission.indexpermission') }}"">Hak Akses</a>
                </div>
            </div>
        </li>
    @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
