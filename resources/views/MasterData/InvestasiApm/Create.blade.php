@extends('layouts.admin_layout')
@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Investasi APM</li>
            <li class="breadcrumb-item">Tambah</li>
        </ol>
    </nav>

    <form action="{{ route('master-data-investasi-apm-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                <label for="apm_id">Nama Perusahaan APM</label>
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <select id="apm_id" name="apm_id" class="form-control {{ $errors->has('apm_id') ? 'is-invalid' : '' }}"></select>
                        @error('apm_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div><br />
    </form>

    <form action="{{ route('master-data-investasi-apm-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <a href="" class="btn btn-dark btn-icon-split float-right tombol-tambah">
                            <span class="icon text-white-100">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text"><b>Tambah Periode</b></span>
                        </a>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <section>
                <div class="form-row">
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="kategori_id">Pilih Periode</label>
                        <select id="kategori_id" name="kategori_id" class="form-control {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}"></select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Rencana Investasi</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Realisasi Investasi</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Rencana Kegiatan</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Realisasi Kegiatan</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Data Pendukung</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Realisasi Data Pendukung</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Keterangan</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Keterangan Realisasi</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                </section>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-investasi-apm-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
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
                '<div class="col-md-4">'+
                        '<div class="form-group">'+
                        '</div>'+
                    '</div>'+
                '<div class="form-row">'+
                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="kategori_id">Pilih Periode</label>'+
                        '<select id="kategori_id" name="kategori_id" class="form-control {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}"></select>'+
                        '@error('kategori_id')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Rencana Investasi</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Realisasi Investasi</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Rencana Kegiatan</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Realisasi Kegiatan</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Data Pendukung</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Realisasi Data Pendukung</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Keterangan</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+

                    '<div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">'+
                        '<label for="nama_perusahaan_apm">Keterangan Realisasi</label>'+
                        '<input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="" value="{{ old('nama_perusahaan_apm') }}">'+
                        '@error('nama_perusahaan_apm')'+
                            '<div class="invalid-feedback">'+
                                '{{ $message }}'+
                            '</div>'+
                        '@enderror'+
                    '</div>'+
                '</div>'+
                '</section>'+
                );
        });

        $(document).on('click','.remove-form-row',function(){
            $(this).parents('SECTION').remove();
        });

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

    <!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'alamat_pabrik' );
    </script> -->
@endpush
