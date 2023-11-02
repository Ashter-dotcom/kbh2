@extends('layouts.admin_layout')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Periode</li>
            <li class="breadcrumb-item">Ubah - {{$periode->nama_periode}}</li>
        </ol>
    </nav>
    <form action="{{ route('master-data-periode-update', ['id' => $periode->id]) }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_periode">Nama Periode</label>
                        <input type="text" name="nama_periode" class="form-control {{ $errors->has('nama_periode') ? 'is-invalid' : '' }}" id="nama_periode" placeholder="Nama Periode" value="{{ old('nama_periode',$periode->nama_periode) }}">
                        @error('nama_periode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4" id="mulai">
                        <label for="mulai">Mulai Periode</label>
                        <input id="mulai" type="date" name="mulai" class="form-control" value="{{ old('nama_periode',$periode->mulai) }}">
                        @error('mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4" id="selesai">
                        <label for="selesai">Selesai Periode</label>
                        <input id="selesai" type="date" name="selesai" class="form-control" value="{{ old('nama_periode',$periode->selesai) }}">
                        @error('selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="kelompok_kapasitas_silinder">Kelompok Kapasitas Silinder</label>
                        <select multiple id="kelompok_kapasitas_silinder" name="kelompok_kapasitas_silinder[]" class="form-control {{ $errors->has('kelompok_kapasitas_silinder') ? 'is-invalid' : '' }}">
                            @foreach(json_decode($periode->kelompok_kapasitas_silinder) as $kelompok)
                                <?php $key = array_search($kelompok, array_column($kelompokKapasitasSilinder,'id'))?>
                                <option value="{{$kelompok}}" selected>{{$kelompokKapasitasSilinder[$key]['nama_kelompok']}}</option>
                            @endforeach
                        </select>
                        @error('kelompok_kapasitas_silinder')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> -->
                </div>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-periode-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- <script type="text/javascript">
        $('#kelompok_kapasitas_silinder').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Kelompok Kapasitas Silinder',
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
    </script> -->
@endpush
