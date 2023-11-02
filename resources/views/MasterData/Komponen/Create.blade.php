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
            <li class="breadcrumb-item">Komponen</li>
            <li class="breadcrumb-item">Tambah</li>
        </ol>
    </nav>

    <form action="{{ route('master-data-komponen-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="kategori_id">Kategori Komponen</label>
                        <select id="kategori_id" name="kategori_id" class="form-control {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}"></select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_komponen">Nama Komponen</label>
                        <input type="text" name="nama_komponen" class="form-control {{ $errors->has('nama_komponen') ? 'is-invalid' : '' }}" id="nama_komponen" placeholder="Nama Komponen" value="{{ old('nama_komponen') }}">
                        @error('nama_komponen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="unit">Satuan / Unit</label>
                        <input type="text" name="unit" class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" id="unit" placeholder="Satuan / Unit" value="{{ old('unit') }}">
                        @error('unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-komponen-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#kategori_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Kategori',
            ajax: {
                url: "{{ route('master-data-komponen-cari') }}",
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
    </script>
@endpush
