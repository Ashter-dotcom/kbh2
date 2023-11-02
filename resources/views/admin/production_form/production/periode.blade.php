@extends('layouts.admin_layout')
@section('content')    
    @push('style')
    <style>
        .card-header-custom {
            background-color:#788896;
            text-align:center;
            color:#ffffff;
            font-size:14px;
        }

        .card-body-custom {
            background-color:#DFE6ED;
        }

        .card-title-custom {
            font-weight:bold;
        }

        .card-title-custom, .card-text-custom {
            font-size:12px;
            text-align:center;
        }

        .mulai {
            margin-bottom:2em;
        }

        .selesai {
            margin-bottom:2em;
        }
    </style>

    @endpush

    <!-- Page Heading -->
    @include('admin.production_form.component.navigation', ['title' => $data['title'], 'breadcrumb' => $data['breadcrumb']])

    <div class="row">
        @if($data['periods']->isNotEmpty())
            @foreach($data['periods'] as $period)
                <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12 mb-10">
                    <div class="card">
                        <h5 class="card-header card-header-custom"><i class="far fa-calendar-check"></i> {{ $period->nama_periode }}</h5>
                        <div class="card-body card-body-custom">
                            <div class="mulai">
                                <h5 class="card-title-custom">Bulan Mulai</h5>
                                <p class="card-text-custom">{{ date_bahasa($period->mulai, $display = ['display_hari' => false]) }}</p>
                            </div>

                            <div class="selesai">
                                <h5 class="card-title-custom">Bulan Berakhir</h5>
                                <p class="card-text-custom">{{ date_bahasa($period->selesai, $display = ['display_hari' => false]) }}</p>
                            </div>

                            <div class="col text-center">
                                <!-- <a href="{{ route('form_produksi.production.index-production', ['model_id' => request()->model_id, 'period_id' => $period->id]) }}" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i> Lihat</a> -->
                                <a href="{{ route('form_produksi.production.create-production', ['model_id' => request()->model_id, 'period_id' => $period->id]) }}" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@push('style')

