@extends('layouts.admin_layout')

@push('style')


<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>

    table th {
        color: #FFFFFF;
    }
    .btn-custom {
        margin-top:1.8em;
    }

    .btn-unduh {
        margin:10px 0;
    }

    .title {
        margin:20px 0 10px 0;
    }

    .title p {
        text-align:center;
        margin:0;
        padding:0;
        font-weight:bold;
        font-size:14px;
    }
</style>

@endpush

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">View Data</li>
            <li class="breadcrumb-item">V3</li>
            @if(!empty($data['apm']) && !empty($data['model']) && !empty($data['periode']))
                <li class="breadcrumb-item">{{ $data['apm']->nama_perusahaan_apm }}</li>
                <!-- <li class="breadcrumb-item">{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</li>
                <li class="breadcrumb-item">{{ $data['periode']->nama_periode }}</li> -->
            @endif
        </ol>
    </nav>

    <form action="{{ route('view-data-d3-index') }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        <label for="apm">Pilih Perusahaan APM :</label>
                        <select name="apm" id="apm" class="form-control apm" required>
                            <option value="">-- Pilih Perusahaan APM --</option>
                        </select>
                        <div class="invalid-feedback">
                            Perusahaan APM tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        <label for="model">Pilih Model :</label>
                        <select name="model" id="model" class="form-control model" required>
                            <option value="">-- Pilih Model--</option>
                        </select>
                        <div class="invalid-feedback">
                            Model tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        <label for="periode">Pilih Periode :</label>
                        <select name="periode" id="periode" class="form-control periode" required>
                            <option value="">-- Pilih Periode --</option>
                        </select>
                        <div class="invalid-feedback">
                            Periode tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-3 col-lg-3 col-xs-2 col-sm-2">
                        <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->periode))
        @if(!empty($data['results']['data']))
            <div class="title">
                <p>RENCANA PRODUKSI UNIT</p>
                <p>{{ \Str::upper($data['apm']->nama_perusahaan_apm) }}</p>
                <!-- <p>Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</p>
                <p>{{ $data['periode']->nama_periode}} - {{ date_bahasa($data['periode']->mulai, ['display_hari' => false]) }} sampai {{ date_bahasa($data['periode']->selesai, ['display_hari' => false]) }} </p> -->
                <a href="{{ route('view-data-d3-unduh', ['apm' => request()->apm, 'model' => request()->model, 'periode' => request()->periode]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-responsi">
                    <thead>
                        <tr>
                            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">No</th>
                            <th colspan="7" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Produk</th>
                            <th colspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Quantity Produk</th>
                            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Keterangan</th>
                        </tr>

                        <tr>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Grouping Hasil Produksi Berdasarkan IUI</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Merek</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Jenis</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Model</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Tipe</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Varian</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Kapasitas Silinder (cc)</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Rencana</th>
                            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Persediaan</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['results'] as $result)
                            <tr>
                                <td>{{ $data['results']['no']++}}</td>
                                <td>Pembuatan / perakitan kendaraan bermotor roda empat</td>
                                <!-- <td>{{ !empty($result->merek) ? $result->merek : '' }}</td> -->
                                <td>{{ !empty($data['model']->merek_id) ? $data['model']->merek_id : '' }}</td>
                                <!-- <td>{{ !empty($result->jenis_kbm) ? $result->jenis_kbm : '' }}</td> -->
                                <td>{{ !empty($data['model']->jenis_kbm) ? $data['model']->jenis_kbm : '' }}</td>
                                <td>{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : '' }}</td>
                                <td>{{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }}</td>
                                <!-- <td>{{ !empty($result->nama_varian) ? $result->nama_varian : '' }}</td> -->
                                <td>{{ !empty($data['model']->nama_varian) ? $data['model']->nama_varian : '' }}</td>
                                <td>{{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</td>
                                <td>{{ !empty($data['model']->rencana_produksi_2022) ? $data['model']->rencana_produksi_2022 : '' }}</td>
                                <td>{{ !empty($result->nik) ? $result->nik : '' }}</td>
                                <td style="text-align:center;">-</td>
                            </tr>
                        @endforeach

                        <!-- @php
                            $presentase = '0 %';
                            $totalComponent = [];
                            $totalPresentase = [];
                            $totalDataKebutuhan = [];
                            $totalDataPembelian = [];
                            $countTotalPresentase = [];
                            $totalRealisasiPembelian = [];

                        @endphp

                        @foreach($data['results']['data'] as $result)

                            @foreach($result['data']['pembelian'] as $keyPembelian => $pembelian)
                                @php
                                    $totalPembelian = 0;
                                    array_push($totalComponent, $keyPembelian);
                                @endphp
                                @if (empty($data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier']))
                                @elseif (strtolower(preg_replace('/\s+/', '', $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'])) != 'tidakdigunakan')
                                <tr>
                                    <td>{{ $data['results']['no']++}}</td>
                                    <td>{{ $result['kelompok'] }}</td>
                                    <td>{{ $result['kategori'] }}</td>

                                    @foreach($data['results']['ranges']['data'] as $range)

                                        @php
                                            $totalDataKebutuhan[$range][] = !empty($result['data']['kebutuhan'][$range]) ? $result['data']['kebutuhan'][$range] : 0
                                        @endphp

                                        <td style="text-align:center;">{{ !empty($result['data']['kebutuhan'][$range]) ? number_format($result['data']['kebutuhan'][$range], 0,'.','.') : 0 }}</td>
                                    @endforeach

                                    <td style="text-align:center;">{{ $result['satuan'] }}</td>

                                    @foreach($data['results']['ranges']['data'] as $range)
                                        @php
                                            $totalDataPembelian[$range][] = array_sum($pembelian['month'][$range]);
                                        @endphp
                                        <td style="text-align:center;">{{ number_format(array_sum($pembelian['month'][$range]),0,'.','.') }}</td>
                                    @endforeach

                                    <td style="text-align:center;">{{ $result['satuan'] }}</td>
                                    <td style="text-align:center;">{{ !empty($data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier']) ? $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'] : 'Tidak Digunakan' }}</td>

                                    @php
                                        array_push($totalRealisasiPembelian, array_sum($pembelian['total']));
                                    @endphp

                                    <td>{{ number_format(array_sum($pembelian['total']),0,'.','.') }}</td>

                                    @if(!empty(array_sum($pembelian['total'])) && !empty(array_sum($result['data']['kebutuhan'])))
                                        @php
                                            $valuePersentase = (array_sum($pembelian['total']) / array_sum($result['data']['kebutuhan'])) * 100;
                                            $valueAkhir = ($valuePersentase >= 100) ? 100 : $valuePersentase;

                                            array_push($totalPresentase, $valueAkhir);
                                        @endphp
                                        <td style="text-align:center;">{{ number_format($valueAkhir,2,',','.') }} %</td>
                                    @else
                                        <td style="text-align:center;">0,00 %</td>
                                    @endif

                                    @if($loop->first)

                                        @php
                                            $totalKebutuhan = array_sum($result['data']['kebutuhan']);
                                        @endphp

                                        <td  rowspan="{{ count($result['data']['pembelian']) }}" style="text-align:center;">
                                            @foreach($result['data']['pembelian'] as $keyPembelian => $valuePembelian)
                                                @if(!empty(array_sum($valuePembelian['total'])) && !empty(array_sum($result['data']['kebutuhan'])))
                                                    @php
                                                        $totalPembelian += array_sum($valuePembelian['total']);
                                                    @endphp
                                                @endif

                                            @endforeach

                                            @php
                                                $presentaseMerging = !empty($totalKebutuhan) ? (($totalPembelian / $totalKebutuhan) * 100) > 100 ? 100 : ($totalPembelian / $totalKebutuhan) * 100 : 0;

                                                if (empty($data['results']['dataSupplier'][$keyPembelian]['supplier_id'])) {

                                                }elseif(strtolower(preg_replace('/\s+/', '', $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'])) != 'tidakdigunakan') {
                                                    array_push($countTotalPresentase, $presentaseMerging);
                                                }

                                            @endphp

                                            {{ number_format($presentaseMerging,2,',','.') .'%' }}
                                        </td>
                                    @endif
                                    <td style="text-align:center;">-</td>
                                </tr>
                                @endif
                            @endforeach

                        @endforeach

                        @if(!empty($totalPresentase))
                            @php
                                $dataPresentase = array_sum($totalPresentase) / count($totalComponent);
                                $presentase = $dataPresentase > 100 ? '100 %' : number_format($dataPresentase,2,',','.').' %'
                            @endphp
                        @endif

                        <tfoot>
                            <tr>

                            </tr>
                        </tfoot> -->
                    </tbody>
                </table>
            </div>
        @else
            <br>
            <div class="alert alert-warning">Data Not Found</div>
        @endif
    @else
        <br>
        <div class="alert alert-warning">Pilih Data Apm, model, dan Periode</div>
    @endif

@endsection


@push('scripts')
<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>

<script>

    let FormulirD3 = {

        init: function() {
            FormulirD3.selectApm();
        },

        selectApm: function() {
            $('.apm').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-apm-cari') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                var data = e.params.data;

                if(data.id != undefined) {
                    FormulirD3.selectModel(data.id);
                }
            });
        },

        selectModel: function(apmId) {


            $('.model').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-model-cari') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var query = {
                            q: params.term,
                            apm_id: apmId
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name + ' ' + item.nama_tipe + ' ' + item.nama_kapasitas_silinder,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                var data = e.params.data;

                if(data.id != undefined) {
                    FormulirD3.selectPeriode(data.id);
                }
            });
        },

        selectPeriode: function(model_id) {
            $('.periode').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-periode-cari') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var query = {
                            q: params.term,
                            model_id: model_id
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }
    }

    $(document).ready(function(){
        FormulirD3.init();
    });
</script>
@endpush
