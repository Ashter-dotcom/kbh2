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
            <li class="breadcrumb-item">V2</li>
            @if(!empty($data['apm']) && !empty($data['periode']))
            <li class="breadcrumb-item">{{ $data['apm']->nama_perusahaan_apm }}</li>
            <li class="breadcrumb-item">{{ $data['periode']->nama_periode }}</li>
            @endif
        </ol>
    </nav>

    <form action="{{ route('view-data-d2-index') }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-5 col-lg-5 col-xs-12 col-sm-12">
                        <label for="apm">Pilih Perusahaan APM :</label>
                        <select name="apm" id="apm" class="form-control apm">
                            @if(!empty($data['apm']))
                                <option value="{{ $data['apm']->id }}" selected>{{ $data['apm']->nama_perusahaan_apm }}</option>
                            @else
                                <option value="">-- Pilih Perusahaan APM --</option>
                            @endif
                        </select>
                        <div class="invalid-feedback">
                            Perusahaan APM tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-5 col-lg-5 col-xs-12 col-sm-12">
                        <label for="periode">Pilih Periode :</label>
                        <select name="periode" id="periode" class="form-control periode" required>
                            @if(!empty($data['periode']))
                                <option value="{{ $data['periode']->id }}" selected>{{ $data['periode']->nama_periode }}</option>
                            @else
                                <option value="">-- Pilih Periode --</option>
                            @endif

                        </select>
                        <div class="invalid-feedback">
                            Periode tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-lg-2 col-xs-2 col-sm-2">
                        <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(!empty(request()->apm) && !empty(request()->periode))
        @if(!empty($data['results']['data']))
            <div class="title">
                <p>RENCANA INVESTASI</p>
                <p>{{ \Str::upper($data['apm']->nama_perusahaan_apm) }}</p>
                <!-- <p>{{ $data['periode']->nama_periode}} - {{ date_bahasa($data['periode']->mulai, ['display_hari' => false]) }} sampai {{ date_bahasa($data['periode']->selesai, ['display_hari' => false]) }} </p> -->
                <a href="{{ route('view-data-d2-unduh', ['apm' => request()->apm, 'periode' => request()->periode]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-responsi">
                <thead>
                    <tr>
                        <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">No</th>
                        <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">tahun</th>
                        <th colspan="1" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">Investasi (Rp)</th>
                        <th colspan="1" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">Kegiatan Mufaktur</th>
                        <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:30%">Data Pendukung</th>
                        <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:30%">Keterangan</th>
                    </tr>

                    <tr>
                        <th style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:50%;">Rencana</th>
                        <th style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:30%;">Rencana</th>
                    </tr>
                </thead>
                    <tbody>
                        <!-- @foreach($data['results']['data'] as $key => $dataKey)
                            <tr>
                                <td>{{ $data['results']['no']++ }}</td>
                                <td>2022</td>
                            </tr>
                        @endforeach -->
                    </tbody>
                </table>
            </div>
        @else
            <br>
            <div class="alert alert-warning">Data Not Found</div>
        @endif
    @else
        <br>
        <div class="alert alert-warning">Pilih Data Apm dan Periode</div>
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

    let FormulirD2 = {

        init: function() {
            FormulirD2.selectApm();
            FormulirD2.selectPeriode();
        },

        selectPeriode: function() {
            $('.periode').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-periode-cari') }}",
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
            });
        },
    }

    $(document).ready(function(){
        FormulirD2.init();
    });
</script>
@endpush