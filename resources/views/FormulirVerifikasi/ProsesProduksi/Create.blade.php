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
            <li class="breadcrumb-item">Formulir Verifikasi</li>
            <li class="breadcrumb-item">Proses Produksi</li>
            <!-- <li class="breadcrumb-item">Tambah</li> -->
        </ol>
    </nav>

    <form action="{{ route('formulir-verifikasi-prosesproduksi-store', ['component_category' => request()->component_category]) }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="supplier_id">Nama Perusahaan</label>
                        <select id="supplier_id" name="supplier_id" class="form-control {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"></select>
                        @error('supplier_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="merek">Nama Komponen</label>
                        <input type="text" name="merek" class="form-control {{ $errors->has('merek') ? 'is-invalid' : '' }}" id="merek" placeholder="Nama Komponen" value="{{ old('merek') }}">
                        @error('merek')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <table class ="table table-bordered" id="table">
                    <tr>
                        <th>Nama Mesin</th>
                        <th>Foto Mesin</th>
                        <th>Proses</th>
                        <th>Foto Proses</th>
                        <th>Waktu Proses</th>
                        <th>Jumlah Operator</th>
                        <th>Jumlah Mesin</th>
                        <th>Keterangan</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="inputs[0]['namamesin']" placeholder="" class="form-control"></td>
                        <td><input type="file" name="inputs[0]['fotomesin']" placeholder="" class="form-control"></td>
                        <td><input type="text" name="inputs[0]['proses']" placeholder="" class="form-control"></td>
                        <td><input type="file" name="inputs[0]['fotoproses']" placeholder="" class="form-control"></td>
                        <td><input type="text" name="inputs[0]['waktuproses']" placeholder="" class="form-control"></td>
                        <td><input type="text" name="inputs[0]['jumlahoperator']" placeholder="" class="form-control"></td>
                        <td><input type="text" name="inputs[0]['jumlahmesin']" placeholder="" class="form-control"></td>
                        <td><input type="text" name="inputs[0]['keterangan']" placeholder="" class="form-control"></td>
                    </tr>
                    </br>
                </table>
                <button type="button" name="add" id="add"class="btn btn-dark btn-block shadow">Tambah Proses</button>
            </div>
            <br/>
        <div class="form-row">
            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="fotogedung">Foto Gedung</label>
                <input type="file" name="fotogedung" placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="fotorawmaterial">Foto Raw Material</label>
                <input type="file" name="fotorawmaterial" placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="fotogedung">Foto Inventaris</label>
                <input type="file" name="fotoinventaris" placeholder="" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="bahanbaku">Bahan Baku</label>
                <input type="text" name="bahanbaku" placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="negaraasal">Negara Asal</label>
                <input type="text" name="negaraasal" placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="spesifikasi">Spesifikasi</label>
                <input type="text" name="spesifikasi" placeholder="" class="form-control">
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-4">
                <label for="surveyor">Surveyor</label>
                <input type="text" name="surveyor" placeholder="" class="form-control">
        </div>
        </div>
        <br />
        <br />

        <br />
        <div class="col-md-12">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">

        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(
                '<tr>'+
                    '<td>'+
                        '<input type="text" name="inputs['+i+'][namamesin]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="file" name="inputs['+i+'][fotomesin]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="inputs['+i+'][proses]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="file" name="inputs['+i+'][fotoproses]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="inputs['+i+'][waktuproses]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="inputs['+i+'][jumlahoperator]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="inputs['+i+'][jumlahmesin]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="inputs['+i+'][keterangan]" placeholder="" class="form-control"/>'+
                    '</td>'+
                    '<td>'+
                        '<button type="button" class="btn btn-danger remove-table-row">Remove</button>'+
                    '</td>'+
                    '</tr>'
                );
        });

        $(document).on('click','.remove-table-row',function(){
            $(this).parents('tr').remove();
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
