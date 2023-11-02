@push('style')
    <style>

        .component-wrapper {
            padding: 0 10px;
            display:inline-block;
        }

        .component-wrapper i {
            font-size:2rem;
            display:block;
            text-align:center;
        }

        .component-wrapper p{
            text-align:center;
            font-family: 'STIX Two Text', serif;
            font-weight:700;
        }

        .component-wrapper a {
            color:#4B5C6B;
            text-decoration:none;
        }

        .active-custom{
            border-bottom: 4px solid #1BAE9F !important;
        }

        .active-custom a{
            color:#1BAE9F;
            font-size:14px;
        }

        .active-custom a:hover{
            color:#1f9e8f;
        }

        .border-outer {
            margin:2em 0 10px 0;
            border-style: dotted;
            border-color:#B2ACFA;
        }

        .title {
            background-color:#B2ACFA;
            padding:5px 0;
        }

        .title p {
            text-align:center;
            color:#293845;
            font-weight:bold;
            font-family: 'STIX Two Text', serif;
            font-size:14px;
            margin:auto;
        }

        .component-category {
            margin-top:2em;
        }

        .component-category ul {
            list-style-type: none;
            padding:0;
        }

        .component-category li {
            display:inline;
            margin-right:1.5em;
            font-family: 'STIX Two Text', serif;
            font-weight:bold;
        }

        .component-category li a {
            text-decoration:none;
            color:#4B5C6B;
            font-size:14px;
        }

        .component-category li a.active-custom {
            color:#B2ACFA;
            border-bottom: 2px solid #B2ACFA !important;
        }

        .period-title {
            background-color: #788896;
            padding:8px 0;
        }

        .period-title p {
            text-align:center;
            color:white;
            margin:0;
            padding:0;
            font-family: 'STIX Two Text', serif;
        }
    </style>
@endpush

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Formulir Produksi</li>
    <li class="breadcrumb-item">{{ $breadcrumb['apm'] }}</li>
    <li class="breadcrumb-item">{{ $breadcrumb['model'] }} {{ $breadcrumb['varian'] }}</li>
    <li class="breadcrumb-item">{{ $breadcrumb['menu'] }}</li>
    @if(\Request::route()->getName() == 'form_produksi.purchase.create-purchase')
    <li class="breadcrumb-item">{{ $period->nama_periode }}</li>
    @endif
  </ol>
</nav>

<div class="pt-25">

    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="component-wrapper">
                <div class="{{ Active::checkRoute(['form_produksi.supplier.*'], 'active-custom','') }}">
                    <a href="{{ route('form_produksi.supplier.index-supplier', ['model_id' => request()->model_id]) }}" onclick="return confirm('Apakah data anda sudah disimpan ?')">
                        <i class="fa fa-cog"></i>
                        <p>Supplier Komponen</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="component-wrapper">
                <div class="{{ Active::checkRoute(['form_produksi.selling.*'], 'active-custom','') }}">
                    <a href="{{ route('form_produksi.selling.index-selling', ['model_id' => request()->model_id]) }}" onclick="return confirm('Apakah data anda sudah disimpan ?')">
                        <i class="fas fa-chart-line"></i>
                        <p>Produksi & Penjualan</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="component-wrapper">
                <div class="{{ Active::checkRoute(['form_produksi.purchase.*'], 'active-custom','') }}">
                    <a href="{{ route('form_produksi.purchase.period-purchase', ['model_id' => request()->model_id]) }}" onclick="return confirm('Apakah data anda sudah disimpan ?')">
                        <i class="fas fa-cart-arrow-down"></i>
                        <p>Delivery Komponen</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="component-wrapper">
                <div class="{{ Active::checkRoute(['form_produksi.production.*'], 'active-custom','') }}">
                    <a href="{{ route('form_produksi.production.period-production', ['model_id' => request()->model_id]) }}" onclick="return confirm('Apakah data anda sudah disimpan ?')">
                        <i class="fas fa-chart-line"></i>
                        <p>Produksi Supplier</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="border-outer">
    <div class="title">
        <p>{{ $title }}</p>
    </div>
</div>


@if(\Request::route()->getName() == 'form_produksi.purchase.create-purchase')
    <div class="period-title">
        <p>
            <i class="fa fa-calendar-check"></i> {{ $period->nama_periode }} - {{ date_bahasa($period->mulai, ['display_hari' => false]) }} sampai {{ date_bahasa($period->selesai, ['display_hari' => false]) }}
        </p>
    </div>
@endif

@if(in_array(\Request::route()->getName(), ['form_produksi.supplier.index-supplier','form_produksi.supplier.create-supplier', 'form_produksi.purchase.index-purchase', 'form_produksi.purchase.create-purchase']))
    <div class="component-category">
        {!! component_category($params = \Request::route()->getName()) !!}
    </div>
@endif

