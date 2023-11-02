@extends('layouts.admin_layout')

@push('style')


<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>

    table th {
        color: #000000;
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
            <li class="breadcrumb-item">Lapangan 1</li>
            @if(!empty($data['apm']) && !empty($data['model']) && !empty($data['supplier']))
                <li class="breadcrumb-item">{{ $data['apm']->nama_perusahaan_apm }}</li>
                <li class="breadcrumb-item">{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</li>
                <li class="breadcrumb-item">{{ $data['supplier']->nama_perusahaan_supplier }}</li>
            @endif
        </ol>
    </nav>

    <form action="{{ route('view-data-lap1-index') }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
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
                        <label for="supplier">Pilih Supplier :</label>
                        <select name="supplier" id="supplier" class="form-control supplier" required>
                            <option value="">-- Pilih Supplier--</option>
                        </select>
                        <div class="invalid-feedback">
                            Supplier tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-lg-2 col-xs-2 col-sm-2">
                        <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(!empty(request()->apm) && !empty(request()->model) && !empty(request()->supplier))
        @if(!empty($data['results']))
            <div class="title">
                <p>FORM VERIFIKASI LAPANGAN KAPASITAS TERPASANG LINE PRODUKSI</p>
                <p>APM : {{ \Str::upper($data['apm']->nama_perusahaan_apm) }}</p>
                <p>Supplier : {{ \Str::upper($data['supplier']->nama_perusahaan_supplier) }}</p>
                <p>Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</p>
                <a href="{{ route('view-data-lap1-lap1unduh', ['apm' => request()->apm, 'model' => request()->model, 'supplier' => request()->supplier]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">No</th>
                            <th colspan="7" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Rencana Produksi</th>
                            <th colspan="4" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Kapasitas Terpasang</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Keterangan</th>
                        </tr>
                        <tr>

                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Nama Komponen</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">No Photo</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Line Produksi yang digunkan</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Nama Mesin</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">No Photo</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Proses</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">No Photo</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Kapasitas Mesin</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Waktu Proses</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Jumlah Operator</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Jumlah Mesin</th>
                            <!-- @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                                <th style="background-color:#FDFF04; text-align:center; vertical-align:middle; text-align:center">{{ $valueBulan }}</th>
                            @endforeach -->
                            <!-- @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                                <th style="background-color:#FDFF04; text-align:center; vertical-align:middle; text-align:center">{{ $valueBulan }}</th>
                            @endforeach -->
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <!-- <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">1</td>
                            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">Produksi</td> -->
                        </tr>


                        @foreach($data['results']['productionsanddevlivery'] as $keyResult => $valueResult)

                            <tr>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center">{{ $valueResult['component_name'] }}</td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center"></td>
                            </tr>
                            @foreach($valueResult['data'] as $keyData => $valueData)
                                <tr>
                                    <!-- <td>{{ $valueResult['data'][$keyData]['actual_component_name'] }}</td> -->

                                    <!-- @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                                        <td>{{ !empty($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2021']) ? number_format($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2021'],0,'.','.') : 0 }}</td>
                                    @endforeach
                                    @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                                        <td>{{ !empty($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2022']) ? number_format($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2022'],0,'.','.') : 0 }}</td>
                                    @endforeach

                                    <td>{{ $valueResult['data'][$keyData]['produksi']['total'] }}</td>
                                    <td>-</td> -->
                                </tr>
                            @endforeach
                        @endforeach
                        <!-- <tr>
                            <td colspan="100" style="background-color:#5B9BD5;"></td>
                        </tr> -->

                        <tr>
                            <!-- <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">2</td>
                            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">Delivery</td> -->
                        </tr>


                        <!-- @foreach($data['results']['productionsanddevlivery'] as $keyResult => $valueResult)
                            <tr>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center">{{ $valueResult['component_name'] }}</td>
                            </tr>
                            @foreach($valueResult['data'] as $keyData => $valueData)
                                <tr>
                                    <td>{{ $valueResult['data'][$keyData]['actual_component_name'] }}</td>

                                    @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                                        <td>{{ !empty($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2021']) ? number_format($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2021'],0,'.','.') : 0 }}</td>
                                    @endforeach

                                    @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                                        <td>{{ !empty($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2022']) ? number_format($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2022'],0,'.','.') : 0 }}</td>
                                    @endforeach

                                    <td>{{ $valueResult['data'][$keyData]['delivery']['total'] }}</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        @endforeach -->

                        <!-- <tr>
                            <td colspan="100" style="background-color:#5B9BD5;"></td>
                        </tr> -->

                        <tr>
                            <!-- <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">3</td>
                            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">Stock</td> -->
                        </tr>


                        <!-- @foreach($data['results']['productionsanddevlivery'] as $keyResult => $valueResult)
                            <tr>
                                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center">{{ $valueResult['component_name'] }}</td>
                            </tr>
                            @foreach($valueResult['data'] as $keyData => $valueData)
                                <tr>
                                    <td>{{ $valueResult['data'][$keyData]['actual_component_name'] }}</td>

                                    @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                                        <td>{{ !empty($valueResult['data'][$keyData]['dataStock'][$valueBulan]['2021']) ? $valueResult['data'][$keyData]['dataStock'][$valueBulan]['2021'] : 0 }}</td>
                                    @endforeach

                                    @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                                        <td>{{ !empty($valueResult['data'][$keyData]['dataStock'][$valueBulan]['2022']) ? $valueResult['data'][$keyData]['dataStock'][$valueBulan]['2022'] : 0 }}</td>
                                    @endforeach

                                    <td></td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        @endforeach -->
                        <!-- <tr>
                            <td colspan="100" style="background-color:#5B9BD5;"></td>
                        </tr> -->

                        <tr>
                            <td colspan="1"></td>
                            <td colspan="1"style="background-color:#56565c; text-align:left; vertical-align:middle; text-align:left">Foto Gedung</td>
                            <td colspan="3"></td>
                            <td colspan="1"></td>
                            <td colspan="1"style="background-color:#56565c; text-align:left; vertical-align:middle; text-align:left">Bahan Baku</td>
                            <td colspan="3"></td>
                            <td colspan="1"></td>
                            <td colspan="2"style="background-color:; text-align:left; vertical-align:middle; text-align:left">Surveyor :</td>
                            <!-- <td style="vertical-align:middle; text-align:center">4</td>
                            <td colspan="3" style="vertical-align:middle; text-align:center">Jumlah Karyawan</td>
                            @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                                <td>{{ $data['dataKaryawan']['2022'][$valueBulan] }}</td>
                            @endforeach
                            @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                                <td>{{ $data['dataKaryawan']['2022'][$valueBulan] }}</td>
                            @endforeach
                            <td></td>
                            <td></td> -->
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="1"style="background-color:#56565c; text-align:left; vertical-align:middle; text-align:left">Foto Raw Material</td>
                            <td colspan="3"></td>
                            <td colspan="1"></td>
                            <td colspan="1"style="background-color:#56565c; text-align:left; vertical-align:middle; text-align:left">Negara Asal</td>
                            <td colspan="3"></td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="1"style="background-color:#56565c; text-align:left; vertical-align:middle; text-align:left">Foto Investasi</td>
                            <td colspan="3"></td>
                            <td colspan="1"></td>
                            <td colspan="1"style="background-color:#56565c; text-align:left; vertical-align:middle; text-align:left">Spesifikasi</td>
                            <td colspan="3"></td>
                            <td colspan="3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <br>
            <div class="alert alert-warning">Data Not Found</div>
        @endif
    @else
        <br>
        <div class="alert alert-warning">Pilih Data Apm, Model, Supplier</div>
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
        let FormulirLAP1 = {
            init: function() {
                FormulirLAP1.selectApm();
                FormulirLAP1.selectSupplier();
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
                        FormulirLAP1.selectModel(data.id);
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
                });
            },

            selectSupplier: function(apmId) {
                $('.supplier').select2({
                    theme: 'bootstrap4',
                    ajax: {
                        url: "{{ route('master-data-supplier-cari') }}",
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
                });
            }
        }

        $(document).ready(function(){
            FormulirLAP1.init();
        });
    </script>
@endpush
