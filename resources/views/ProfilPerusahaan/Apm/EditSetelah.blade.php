

@extends('layouts.admin_layout')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Formulir Profil Perusahaan</li>
            <li class="breadcrumb-item">Perusahaan APM</li>
            <li class="breadcrumb-item">{{ $apm->nama_perusahaan_apm }}</li>
            <li class="breadcrumb-item">Setelah Insentif</li>
        </ol>
    </nav>
    @include('component.alert')
    @include('ProfilPerusahaan.Component.Title', ['title' => '12 Bulan Setelah Mendapatkan Insentif'])

    <div class="accordion" id="accordion">
    <form action="{{ route('profil-perusahaan-apm-setelah-insentif-update', ['id'=>$apm->id]) }}" method="GET" class="needs-validation" novalidate>
            <div class="container-fluid card shadow">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <label for="periode">Pilih Periode :</label>
                            <select name="periode" id="periode" class="form-control periode" required>
                                @if(!empty($data['periode']))
                                    <option value="{{ $data['periode']->id }}" selected>{{ $data['periode']->nama_periode }}</option>
                                @else
                                    <option value="">-- Pilih Periode --</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ route('profil-perusahaan-apm-setelah-insentif-update', ['id'=>$apm->id]) }}" method="POST" id="myForm">
            @csrf
            @include('ProfilPerusahaan.Component.FormFieldApm', ['apm' => $apm, 'periodeTahun' => $periodeTahun, 'kondisi' => 'setelah'])
        </form>
    </div>
@endsection

@push('scripts')
<script>
    let FormulirEditSetelah = {
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
    }
    $(document).ready(function(){
        FormulirEditSetelah.init();
    });
</script>
@endpush