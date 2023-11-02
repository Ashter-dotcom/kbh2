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
            @if(!empty($data['apm']) && !empty($data['periode']))
            <li class="breadcrumb-item">{{ $data['apm']->nama_perusahaan_apm }}</li>
            <li class="breadcrumb-item">{{ $data['periode']->nama_periode }}</li>
            @endif
        </ol>
    </nav>
    <form action="{{ route('view-data-h3-index') }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-5 col-lg-5 col-xs-12 col-sm-12">
                        <label for="apm">Pilih Perusahaan APM :</label>
                        <select name="apm" id="apm" class="form-control apm" required>
                            <option value="">-- Pilih Perusahaan APM --</option>
                        </select>
                        <div class="invalid-feedback">
                            Perusahaan APM tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-lg-5 col-xs-12 col-sm-12">
                        <label for="periode">Pilih Periode :</label>
                        <select name="periode" id="periode" class="form-control periode" required>
                            <option value="">-- Pilih Periode --</option>
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
        @if(!empty($data['results']))

            <div class="title">
                <p>RENCANA PRODUKSI UNIT</p>
                <p>{{ \Str::upper($data['apm']->nama_perusahaan_apm) }}</p>
                <p>{{ $data['periode']->nama_periode}} - {{ date_bahasa($data['periode']->mulai, ['display_hari' => false]) }} sampai {{ date_bahasa($data['periode']->selesai, ['display_hari' => false]) }} </p>
                <a href="{{ route('view-data-h3-h3unduh', ['apm' => request()->apm, 'periode' => request()->periode]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-responsi">
                    <thead>
                        <tr>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle;">No</th>
                            <th colspan="7" style="background-color:#56565c; text-align:center; vertical-align: middle;">Produk</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle;">NIK</th>
                            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle;">Keterangan</th>
                        </tr>
                        <tr>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Grouping Hasil Produksi Berdasarkan IUI</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Merek</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Jenis</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Model</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Tipe</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Varian</th>
                            <th style="background-color:#56565c; text-align:center; vertical-align: middle;">Kapasitas Silinder</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['results'] as $result)
                            <tr>
                                <td>{{ ($data['results']->currentpage()-1) * $data['results']->perpage() + $loop->index + 1 }}</td>
                                <td>Pembuatan / perakitan kendaraan bermotor roda empat</td>
                                <td>{{ !empty($result->merek) ? $result->merek : '' }}</td>
                                <td>{{ !empty($result->jenis_kbm) ? $result->jenis_kbm : '' }}</td>
                                <td>{{ !empty($result->nama_model) ? $result->nama_model : '' }}</td>
                                <td>{{ !empty($result->nama_tipe) ? $result->nama_tipe : '' }}</td>
                                <td>{{ !empty($result->nama_varian) ? $result->nama_varian : '' }}</td>
                                <td>{{ !empty($result->nama_kapasitas_silinder) ? $result->nama_kapasitas_silinder : '' }}</td>
                                <td>{{ !empty($result->nik) ? $result->nik : '' }}</td>
                                <td style="text-align:center;">-</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data['results']->appends(['apm' => request()->apm, 'periode' => request()->periode])->links('pagination.bootstrap') }}
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
        let FormulirH3 = {
            init: function() {
                FormulirH3.selectApm();
                FormulirH3.selectPeriode();
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
            }
        }

        $(document).ready(function(){
            FormulirH3.init();
        });
    </script>
@endpush
