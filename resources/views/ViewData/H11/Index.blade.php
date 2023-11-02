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
            <li class="breadcrumb-item">V11</li>
            @if(!empty($data['apm']) && !empty($data['model']) && !empty($data['periode']))
                <li class="breadcrumb-item">{{ $data['apm']->nama_perusahaan_apm }}</li>
                <li class="breadcrumb-item">{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</li>
                <!-- <li class="breadcrumb-item">{{ $data['periode']->nama_periode }}</li> -->
            @endif
        </ol>
    </nav>

    <form action="{{ route('view-data-h11-index') }}" method="GET" class="needs-validation" novalidate>
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
                <p class="h2 text-center font-weight-bold">REALISASI TAHAPAN MANUFAKTUR DAN PENGGUNAAN KOMPONEN LAINNYA</p>
                <p class="h2 text-center font-weight-bold">{{ \Str::upper($data['apm']->nama_perusahaan_apm) }}</p>
                <!-- <p>Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</p> -->
                <!-- <p>{{ $data['periode']->nama_periode}} - {{ date_bahasa($data['periode']->mulai, ['display_hari' => false]) }} sampai {{ date_bahasa($data['periode']->selesai, ['display_hari' => false]) }} </p> -->
                <a href="{{ route('view-data-h11-unduh', ['apm' => request()->apm, 'model' => request()->model, 'periode' => request()->periode]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-responsi">
                    <thead>
                        <tr>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">No</th>
                            <th colspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Produk</th>
                            <th colspan="3" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Panduan Rencana Tahapan Manufaktur Sesuai PerMenPerin</th>
                            <th colspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Rencana Tahapan Manufaktur</th>
                            <th colspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Realisasi Tahapan Manufaktur</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Nama Perusahaan</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Local/Impor</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Kondisi</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Keterangan</th>
                        </tr>
                        <tr>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Kelompok Barang</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Nama Komponen Aktual</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Nama Komponen</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Tahun</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Kondisi</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Tahun</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Kondisi</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Tahun</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>


                        @php
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
                                        <td>{{ $result['kategori'] }}</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">x</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">x</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">x</td>
                                        <td style="text-align:center;">{{ !empty($data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier']) ? $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'] : 'Tidak Digunakan' }}</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                    </tr>
                                @endif
                            @endforeach

                        @endforeach
                        <tfoot>
                            <tr>

                            </tr>
                        </tfoot>
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

    let FormulirH11 = {

        init: function() {
            FormulirH11.selectApm();
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
                    FormulirH11.selectModel(data.id);
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
                    FormulirH11.selectPeriode(data.id);
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
        FormulirH11.init();
    });
</script>
@endpush
