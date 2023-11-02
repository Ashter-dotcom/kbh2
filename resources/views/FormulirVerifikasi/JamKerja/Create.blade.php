@extends('layouts.admin_layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

    <style>
        .switch-title {
            margin:5px 0;
        }
        .card-header-background {
            background:#788896;
        }

        .card-header-background h6 {
            text-align:center;
            color:#FFFFFF !important;
            font-family: 'STIX Two Text', serif !important;
            font-size:12px;
        }

        .card-body-background {
            background:#DFE6EE !important;
        }

        .select2-container--bootstrap4 .select2-selection__clear {
            margin-right:20px !important;
            color:#000000;
            width:17px;
            font-weight:bold;
            border:none !important;
            background-color:#ffffff;
        }

        .select2-selection__clear:hover  {
            background-color:#ffffff !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush
@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Formulir Verifikasi</li>
            <li class="breadcrumb-item">Jam Kerja</li>
        </ol>
    </nav>

    <form action="{{ route('formulir-verifikasi-jamkerja-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="supplier_id">Nama Perusahaan Supplier</label>
                        <select id="supplier_id" name="supplier_id" class="form-control {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"></select>
                        @error('supplier_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card position-relative mb-10">
            <div class="card-header py-3 card-header-background">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog"></i> PT. Supplier </h6>
            </div>
            <div class="card-body card-body-background" id="form">
                <div class="row" style="text-align: right">
                    <div class="col">
                        <label>Jika ada Sabtu/Minggu :</label></br>
                        <button class="btn btn-dark" type="button" id="add">
                            <i class="fa fa-plus"></i> Tambah Jam Kerja
                        </button>
                    </div>
                </div></br>
                <section>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nik" style="font-weight: bold">Nama Komponen</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="penjualan">Pilih Hari Kerja</label>
                            <select name="penjualan" id="penjualan" class="form-control {{ $errors->has('penjualan') ? 'is-invalid' : '' }}">
                                <option value="">-- Pilih Hari Kerja --</option>
                                <option value="seninjumat" {{ old('penjualan') == 'seninjumat' ? 'selected' : '' }}>Senin - Jum'at</option>
                                <option value="sabtuminggu" {{ old('penjualan') == 'sabtuminggu' ? 'selected' : '' }}>Sabtu - Minggu</option>
                            </select>
                            @error('penjualan')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nik" style="font-weight: bold">Jam Kerja / Hari</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="text-align: center">
                            <label for="harga">Shift 1</label>
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center">
                        <div class="form-group">
                            <label for="harga">Shift 2</label>
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" style="text-align: center">
                            <label for="konsumen">Shift 3</label>
                            <input type="text" name="konsumen" class="form-control {{ $errors->has('konsumen') ? 'is-invalid' : '' }}" id="konsumen" placeholder="" value="{{ old('konsumen') }}">
                            @error('konsumen')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nik" style="font-weight: bold">Jam Istirahat / Hari</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="text-align: center">
                            <label for="harga">Shift 1</label>
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 1" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 2" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 3" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 4" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center">
                        <div class="form-group">
                            <label for="harga">Shift 2</label>
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 1" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 2" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 3" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 4" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" style="text-align: center">
                            <label for="konsumen">Shift 3</label>
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 1" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 2" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 3" value="{{ old('harga') }}">
                            <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 4" value="{{ old('harga') }}">
                            @error('konsumen')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                </section>
            </div>
        </div></br>
        <div class="row container col-md-12" style="justify-content: center">
            {{-- <div class="col-md-6">
                <a href="{{ route('master-data-merek-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div> --}}
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
            var i = 0;
        $('#add').click(function(){
            ++i;
            $('#form').append(
                '<section>'+
                '<hr>'+
                '<div class="row">'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="penjualan">Pilih Hari Kerja</label>'+
                            '<select name="penjualan" id="penjualan" class="form-control {{ $errors->has('penjualan') ? 'is-invalid' : '' }}">'+
                                '<option value="">-- Pilih Hari Kerja --</option>'+
                                '<option value="seninjumat" {{ old('penjualan') == 'seninjumat' ? 'selected' : '' }}>Senin - Jumat</option>'+
                                '<option value="sabtuminggu" {{ old('penjualan') == 'sabtuminggu' ? 'selected' : '' }}>Sabtu - Minggu</option>'+
                            '</select>'+
                            '@error('penjualan')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-4">'+
                    '</div>'+
                '</div>'+

                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<label for="nik" style="font-weight: bold">Jam Kerja / Hari</label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group" style="text-align: center">'+
                            '<label for="harga">Shift 1</label>'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="" value="{{ old('harga') }}">'+
                            '@error('harga')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4" style="text-align: center">'+
                        '<div class="form-group">'+
                            '<label for="harga">Shift 2</label>'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="" value="{{ old('harga') }}">'+
                            '@error('harga')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-4">'+
                        '<div class="form-group" style="text-align: center">'+
                            '<label for="konsumen">Shift 3</label>'+
                            '<input type="text" name="konsumen" class="form-control {{ $errors->has('konsumen') ? 'is-invalid' : '' }}" id="konsumen" placeholder="" value="{{ old('konsumen') }}">'+
                            '@error('konsumen')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<label for="nik" style="font-weight: bold">Jam Istirahat / Hari</label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group" style="text-align: center">'+
                            '<label for="harga">Shift 1</label>'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 1" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 2" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 3" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 4" value="{{ old('harga') }}">'+
                            '@error('harga')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4" style="text-align: center">'+
                        '<div class="form-group">'+
                            '<label for="harga">Shift 2</label>'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 1" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 2" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 3" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 4" value="{{ old('harga') }}">'+
                            '@error('harga')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-4">'+
                        '<div class="form-group" style="text-align: center">'+
                            '<label for="konsumen">Shift 3</label>'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 1" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 2" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 3" value="{{ old('harga') }}">'+
                            '<input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Istirahat 4" value="{{ old('harga') }}">'+
                            '@error('konsumen')'+
                                '<div class="invalid-feedback">'+
                                    '{{ $message}}'+
                                '</div>'+
                            '@enderror'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                    '<button type="button" class="btn btn-danger remove-form-row">Remove</button>'+
                    '</div>'+
                '</div>'+
                '</section>'
                );
        });

        $(document).on('click','.remove-form-row',function(){
            $(this).parents('SECTION').remove();
        });

        $('#supplier_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Perusahaan Supplier',
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
    </script>
@endpush
