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
            <li class="breadcrumb-item">Merek Produk</li>
            <li class="breadcrumb-item">Tambah</li>
        </ol>
    </nav>

    <form action="{{ route('master-data-merek-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="apm_id">Nama Perusahaan APM</label>
                        <select id="apm_id" name="apm_id" class="form-control {{ $errors->has('apm_id') ? 'is-invalid' : '' }}"></select>
                        @error('apm_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="merek">Nama Merek Produk</label>
                        <input type="text" name="merek" class="form-control {{ $errors->has('merek') ? 'is-invalid' : '' }}" id="merek" placeholder="Nama Merek Produk" value="{{ old('merek') }}">
                        @error('merek')
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
                <a href="{{ route('master-data-merek-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#apm_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Perusahaan APM',
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
    </script>
@endpush