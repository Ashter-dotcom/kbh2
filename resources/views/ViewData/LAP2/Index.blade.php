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
            <li class="breadcrumb-item">Lapangan 2</li>
            @if(!empty($data['apm']) && !empty($data['model']) && !empty($data['supplier']))
                <!-- <li class="breadcrumb-item">{{ $data['apm']->nama_perusahaan_apm }}</li> -->
                <!-- <li class="breadcrumb-item">{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</li> -->
                <li class="breadcrumb-item">{{ $data['supplier']->nama_perusahaan_supplier }}</li>
            @endif
        </ol>
    </nav>

    <!-- <form action="{{ route('view-data-lap2-index') }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-10 col-xs-12 col-sm-12 col-lg-10">
                        <label for="supplier">Pilih Perusahaan Supplier</label>
                        <select id="supplier" name="supplier" class="form-control {{ $errors->has('supplier') ? 'is-invalid' : '' }}"></select>
                    </div>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <button style="margin-top: 31px;" type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->

    <form action="{{ route('view-data-lap2-index') }}" method="GET" class="needs-validation" novalidate>
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
                <p>FORM VERIFIKASI PENERAPAN JAM KERJA</p>
                <!-- <p>APM : {{ \Str::upper($data['apm']->nama_perusahaan_apm) }}</p> -->
                <!-- <p>{{ \Str::upper($data['supplier']->nama_perusahaan_supplier) }}</p> -->
                <!-- <p>Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}</p> -->
                <a href="{{ route('view-data-lap2-lap2unduh', ['apm' => request()->apm, 'model' => request()->model, 'supplier' => request()->supplier]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a>
            </div>

            <div class="table-responsive">
                <div>
                    <table>
                        <tr>
                            <td>User ID</td>
                            <td>: </td>
                            <td>{{ ($data['apm']->nama_perusahaan_apm) }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>: </td>
                            <td> {{ ($data['supplier']->nama_perusahaan_supplier) }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: </td>
                            <td> {{ ($data['supplier']->alamat_pabrik) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Verifikasi</td>
                            <td>: </td>
                            <td> {{ ($data['supplier']->tanggal_kesediaan_diverifikasi) }}</td>
                        </tr>
                            <td>Surveyor</td>
                            <td>: </td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7" style="background-color:#56565c; text-align:center; vertical-align: middle;">Waktu Kerja (produksi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align: middle;">Jam Kerja (produksi) per Hari</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align: middle;">Jam Istirahat per Hari</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
                                <td>:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
                                <td>:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
                                <td>:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align: middle;">Efektif Jam Kerja (produksi) per Hari</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th rowspan="1" style="text-align:center; vertical-align: middle;">Hari Kerja per Minggu</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

    <!-- <script type="text/javascript">
        $('#supplier').select2({
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('master-data-supplier-cari') }}",
                dataType: 'json',
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
    </script> -->

    <script>
        let FormulirLAP2 = {
            init: function() {
                FormulirLAP2.selectApm();
                FormulirLAP2.selectSupplier();
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
                        FormulirLAP2.selectModel(data.id);
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
            FormulirLAP2.init();
        });
    </script>
@endpush
