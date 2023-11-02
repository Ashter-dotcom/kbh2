@push('style')
    <style>
        .custom-navbar li {
            margin-right:30px;
        }

        .custom-navbar li a {
            font-weight:bold;
        }

        .custom-navbar li a.active {
            color:#6559F5 !important;
            border-bottom:4px solid #6559F5;
        }
    </style>
@endpush


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav custom-navbar">
      <li class="nav-item">
        <a class="nav-link {{ Active::check('admin/report/overview', true) }}" href="{{ route('dashboard', ['tipe_report' => 'overview']) }}">Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Active::check('admin/report/pohon-industri') }}" href="{{ route('dashboard', ['tipe_report' => 'pohon-industri']) }}">Pohon Industri</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Active::check('admin/report/statistik-apm', true) }}" href="{{ route('dashboard', ['tipe_report' => 'statistik-apm']) }}">Statistik APM</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Active::check('admin/report/statistik-supplier', true) }}" href="{{ route('dashboard', ['tipe_report' => 'statistik-supplier']) }}">Statistik Supplier</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Active::check('admin/report/statistik-komponen', true) }}" href="{{ route('dashboard', ['tipe_report' => 'statistik-komponen']) }}">Statistik Komponen</a>
      </li>
    </ul>
  </div>
</nav>
