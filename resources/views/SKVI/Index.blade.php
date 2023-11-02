@extends('layouts.admin_layout')

@push('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js" integrity="sha512-vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>

    p {
        text-align:center;
        margin:2px 0;
        font-weight:bold;
        color:#000000;
        font-size:10px;
        font-family: ui-serif;
    }

    .btn-custom {
        margin-top:1.8em;
    }

    .rule {
        border: 1px solid #000000;
    }

    .address {
        margin-top:1em;
        font-size:10px;
        font-family: ui-serif;
    }

    .btn-unduh {
        margin:10px 0;
    }

    .address td, .title p {
        color:#000000;
    }

    .signature {
        float:right;
    }

    .title, .signature {
        margin:1em 0 0 0;
        font-size:10px;
        font-family: ui-serif;
    }

    .description {
        margin:1em 0;
    }

    .description p {
        text-align:left;
        margin:0;
    }

    .table-condensed{
    font-size: 10px;
    }
</style>

@endpush

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">SKVI</li>
        </ol>
    </nav>

    <form action="{{ route('skvi-index') }}" method="GET" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="apm">Pilih Perusahaan APM :</label>
                    <select name="apm" id="apm" class="form-control apm" required>

                        @if(!empty($data['apmInformation']))
                            <option value="{{ $data['apmInformation']->id }}">{{ $data['apmInformation']->nama_perusahaan_apm }}</option>
                        @else
                            <option value="">-- Pilih Perusahaan APM --</option>
                        @endif

                    </select>
                    <div class="invalid-feedback">
                        Perusahaan APM tidak boleh kosong
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="periode">Pilih Periode :</label>
                    <select name="periode" id="periode" class="form-control periode" required>
                        <option value="">-- Pilih Periode --</option>
                    </select>
                    <div class="invalid-feedback">
                        Periode tidak boleh kosong
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="kapasitas_silinder">Kapasitas Silinder:</label>
                    <select name="kapasitas_silinder" id="kapasitas_silinder" class="form-control kapasitas_silinder" required>
                        @if(!empty($data['apmInformation']))
                            <option value="{{ $data['kapasitas_silinder']->id }}">{{ $data['kapasitas_silinder']->nama_kelompok }}</option>
                        @else
                            <option value="">-- Kapasitas Silinder --</option>
                        @endif

                    </select>
                    <div class="invalid-feedback">
                        Kapasitas Silinder tidak boleh kosong
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="apm">Nama Pejabat :</label>
                    <input type="text" name="nama_pejabat" id="nama_pejabat" class="form-control" value="{{ !empty(request()->nama_pejabat) ? request()->nama_pejabat : '' }}" required>
                    <div class="invalid-feedback">
                        Nama Pejabat tidak boleh kosong
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="apm">Nomor SKVI :</label>
                    <input type="text" name="nomor_skvi" id="nomor_skvi" class="form-control" value="{{ !empty(request()->nomor_skvi) ? request()->nomor_skvi : '' }}" required>
                    <div class="invalid-feedback">
                        Nama Pejabat tidak boleh kosong
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xs-1 col-sm-1">
                <button class="btn btn-dark btn-custom btn-block"><i class="fa fa-eye"></i>Lihat </button>
            </div>
        </div>
    </form>

    @if(!empty(request()->apm) && !empty(request()->nama_pejabat) && !empty(request()->nomor_skvi))
        @if(!empty($data['results']['penjualan']))
        <div id="pdf_body" style="background-color: #fff">
            <p style="position:absolute; margin-left:70%;box-shadow: 0 0 0 1px black;padding: 5px;">{{ request()->nomor_skvi }}</p>
            <p><img src="{{asset('/assets/img/logo2.jpeg')}}" width="110"></p>
            <p>SURAT KETERANGAN VERIFIKASI INDUSTRI</p>
            <p>PERMOHONAN PENETAPAN BERMOTOR RODA EMPAT LISTRIK HYBRID (HYBRID ELECTRIC VEHICLE)</p>
            <p>DALAM RANGKA PELAKSANAAN PROGRAM KENDARAAN BERMOTOR RODA EMPAT </p>
            <p>EMISI KARBON RENDAH (LCEV)</p>
            <p>Berdasarkan:</p>
            <p>1. Peraturan Pemerintah Republik Indonesia  Nomor : 73 Tahun 2019 Jo 74 Tahun 2021</p>
            <p>2. Peraturan Menteri Perindustrian Republik Indonesia  Nomor : 36 Tahun 2021</p>
            <p>3. Keputusan Direktur Jenderal Industri Logam, Mesin, Alat Transportasi, Dan Elektronika Nomor : 20 Tahun 2022</p>

            <hr class="rule">

            <p>DIBERIKAN KEPADA</p>
            <p style="font-size:11px;">{{ !empty($data['apmInformation']->nama_perusahaan_apm) ? $data['apmInformation']->nama_perusahaan_apm : '' }}</p>
            <div class="address">
                <table>
                    <tr>
                        <td style="width:25%">Alamat Kantor</td>
                        <td style="width:4%">:</td>
                        <td>{{ !empty($data['apmInformation']->alamat_kantor) ? $data['apmInformation']->alamat_kantor : '' }}</td>
                    </tr>

                    <tr>
                        <td>Alamat Pabrik</td>
                        <td>:</td>
                        <td>{!! !empty($data['apmInformation']->alamat_pabrik) ? str_replace(['<p>','</p>'],'',$data['apmInformation']->alamat_pabrik) : '' !!}</td>
                    </tr>

                    <tr>
                        <td>NPWP</td>
                        <td>:</td>
                        <td>{{ !empty($data['apmInformation']->npwp_perusahaan) ? $data['apmInformation']->npwp_perusahaan : '' }}</td>
                    </tr>
                </table>
            </div>

            <div class="title">
                <p>UNTUK KENDARAAN BERMOTOR RODA EMPAT LISTRIK HYBRID (HYBRID ELECTRIC VEHICLE)</p>
                <p class="text-left">Dengan Identitas :</p>
            </div>
            {{-- <a href="{{ route('skvi-unduh', ['apm' => request()->apm, 'kapasitas_silinder' => request()->kapasitas_silinder, 'periode' => request()->periode, 'nama_pejabat' => request()->nama_pejabat]) }}" class="btn btn-dark btn-sm float-right btn-unduh"><i class="fa fa-save"></i> Unduh</a> --}}
            <div class="pull-right" data-html2canvas-ignore="true">
            <script>
                var pdf_content = document.getElementById("pdf_body");
                var options = {
                    margin:       1,
                    filename:     '{{$data['apmInformation']->nama_perusahaan_apm}}.pdf',
                    image:        { type: 'png', quality: 1 },
                    html2canvas:  { scale: 4 },
                    jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
                };
            </script>
                <p>
                    <a href="#" onclick="html2pdf(pdf_content, options)" class="btn btn-dark btn-sm float-right ml-2"><i class="fa fa-file-pdf"></i> Unduh PDF</a>
                    {{-- <a href="{{ route('skvi-unduh', ['apm' => request()->apm, 'kapasitas_silinder' => request()->kapasitas_silinder, 'tanggal' => request()->tanggal, 'nama_pejabat' => request()->nama_pejabat]) }}" class="btn btn-dark btn-sm float-right"><i class="fa fa-save"></i> Unduh XLS</a> --}}
                </p>
            </div>

            <table class="table table-condensed table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Merek</th>
                        <th>Jenis</th>
                        <th>Model</th>
                        <th>Tipe</th>
                        <th>Kapasitas Silinder (cc)</th>
                    </tr>
                </thead>
                @if(!empty($data['results']['penjualan']))
                    <tbody>
                        @foreach($data['results']['penjualan'] as $keyJenisKbm => $valueJenisKbm)
                            @foreach($valueJenisKbm as $keyMerek => $valueMerek)
                                @foreach($valueMerek as $keyModel => $valueModel)

                                    @foreach($valueModel as $keyVarian => $valueVarian)
                                        <tr>
                                            <td>{{ $data['no']++ }} </td>
                                            <td>{{ $keyMerek }}</td>
                                            <td>{{ $keyJenisKbm }}</td>
                                            <td>{{ $keyModel }}</td>
                                            <td>{{ $valueVarian['tipe'] }}</td>

                                            <td>{{ number_format($valueVarian['kapasitas_silinder'], 0, '.', '.') }}</td>
                                            @if($loop->first)
                                                <td rowspan="{{ count($valueMerek[$keyModel]) }}">
                                                    {{ number_format(array_sum($data['results']['dataPresentasePembelianLokal'][$keyModel]) / count($data['results']['dataPresentasePembelianLokal'][$keyModel]), 2,',',',') .'%' }}
                                                </td>
                                            @endif
                                            <td>{{ number_format($valueVarian['totals'], 0, '.', '.') }}</td>
                                        </tr>
                                    @endforeach

                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                @endif
            </table>


            <div class="description">
                <p>Telah di verifikasi dan memenuhi persyaratan sesuai dengan ketentuan yang berlaku.</p>
                <p>Rincian hasil verifikasi sebagaimana terlampir merupakan bagian yang tidak terpisahkan dari surat keterangan verifikasi Industri ini.</p>
            </div>


            <div class="signature">
                <p>Jakarta, {{ !empty(request()->tanggal) ?  date_bahasa(request()->tanggal) : date_bahasa(date('Y-m-d')) }}</p>

                <br>
                <p>Manager Project</p>
                <p>PT. Surveyor Indonesia</p>

                <br>
                <br>

                <p>{{ !empty(request()->nama_pejabat) ? request()->nama_pejabat : '' }}</p>
            </div>
        </div>
        @else
            <br>
            <div class="alert alert-warning">Data Not Found</div>
        @endif
    @else
        <br>
        <div class="alert alert-warning">Pilih Data Apm, Input Nama Pejabat</div>
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

    let skvi = {

        init: function() {
            skvi.selectApm();
            skvi.selectKapasitasSilinder();
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
                    skvi.selectPeriode(data.id);
                }
            });
        },

        selectPeriode: function(apm_id) {
            $('.periode').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-periode-cari') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var query = {
                            q: params.term,
                            apm_id: apm_id
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
        },

        selectKapasitasSilinder: function() {
            $('.kapasitas_silinder').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-kapasitas-silinder-cari') }}",
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
        skvi.init();
    });
</script>
@endpush
