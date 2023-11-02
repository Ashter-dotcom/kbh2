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
            <li class="breadcrumb-item">Model</li>
            <li class="breadcrumb-item">Ubah - {{$model->nama_model}}</li>
        </ol>
    </nav>
    <form action="{{ route('master-data-model-update', ['id' => $model->id]) }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="apm_id">Nama Perusahaan APM</label>
                        <select id="apm_id" name="apm_id" class="form-control {{ $errors->has('apm_id') ? 'is-invalid' : '' }}" value="{{ old('apm_id',$model->apm_id) }}">
                        <option value="{{$model->apm_id}}" selected>{{$model->masterDataApm->nama_perusahaan_apm}}</option>
                        </select>
                        @error('apm_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                        <label for="merek_id">Nama Merek Produk</label>
                        <select id="merek_id" name="merek_id" class="form-control {{ $errors->has('merek_id') ? 'is-invalid' : '' }}" value="{{ old('merek_id',$model->merek_id) }}">
                            @if ($model->masterDataMerek)
                                <option value="{{$model->merek_id}}" selected>{{$model->masterDataMerek->merek}}</option>
                            @endif
                        </select>
                        @error('merek_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-2">
                        <label for="nama_model">Nama Model</label>
                        <input type="text" name="nama_model" class="form-control {{ $errors->has('nama_model') ? 'is-invalid' : '' }}" id="nama_model" placeholder="Nama Model" value="{{ old('nama_model',$model->nama_model) }}">
                        @error('nama_model')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="jenis_kbm">Jenis KMB</label>
                        <select name="jenis_kbm" class="form-control {{ $errors->has('jenis_kbm') ? 'is-invalid' : '' }}">
                            <option value="">-- Pilih Jenis KMB --</option>
                            <option value="Penumpang 4 x 2" {{ old('jenis_kbm',$model->jenis_kbm) == 'Penumpang 4 x 2' ? 'selected' : '' }}>Penumpang 4 x 2</option>
                            <option value="Penumpang 4 x 4" {{ old('jenis_kbm',$model->jenis_kbm) == 'Penumpang 4 x 4' ? 'selected' : '' }}>Penumpang 4 x 4</option>
                        </select>
                        @error('jenis_kbm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="nama_tipe">Nama Tipe</label>
                        <select name="nama_tipe" class="form-control {{ $errors->has('nama_tipe') ? 'is-invalid' : '' }}">
                            <option value="">-- Pilih Tipe Transmisi --</option>
                            <option value="Manual" {{ old('nama_tipe',$model->nama_tipe) == 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="Otomatis" {{ old('nama_tipe',$model->nama_tipe) == 'Otomatis' ? 'selected' : '' }}>Otomatis</option>
                        </select>
                        @error('nama_tipe')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="nama_varian">Nama Varian</label>
                        <input type="text" name="nama_varian" class="form-control {{ $errors->has('nama_varian') ? 'is-invalid' : '' }}" id="nama_varian" placeholder="Nama Varian" value="{{ old('nama_varian',$model->nama_varian) }}">
                        @error('nama_varian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="nama_kapasitas_silinder">Kapasitas Silinder</label>
                        <input type="number" name="nama_kapasitas_silinder" class="form-control {{ $errors->has('nama_kapasitas_silinder') ? 'is-invalid' : '' }}" id="nama_kapasitas_silinder" placeholder="Kapasitas Silinder" value="{{ old('nama_kapasitas_silinder',$model->nama_kapasitas_silinder) }}">
                        @error('nama_kapasitas_silinder')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
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

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-2">
                        <label for="rencana_produksi_2022">Rencana Produksi</label>
                        <input type="number" name="rencana_produksi_2022" class="form-control {{ $errors->has('rencana_produksi_2022') ? 'is-invalid' : '' }}" id="rencana_produksi_2022" placeholder="Rencana Produksi 2022" value="{{ old('rencana_produksi_2022',$model->rencana_produksi_2022) }}">
                        @error('rencana_produksi_2022')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-2">
                        <label for="rencana_produksi_2023">Stok Persediaan</label>
                        <input type="number" name="rencana_produksi_2023" class="form-control {{ $errors->has('rencana_produksi_2023') ? 'is-invalid' : '' }}" id="rencana_produksi_2023" placeholder="Rencana Produksi 2023" value="{{ old('rencana_produksi_2023',$model->rencana_produksi_2023) }}">
                        @error('rencana_produksi_2023')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>
        </div><br />

        <div class="container-fluid card shadow">
            <div class="card-header text-center">
                <b>Komponen yang digunakan</b>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php $urutan = 1;?>
                @foreach ($kategori as $k)
                    @if ($urutan == 1)
                    <li class="nav-item">
                        <a class="nav-link active" id="id-{{$k->id}}" data-toggle="tab" href="#link-id-{{$k->id}}" role="tab" aria-controls="control-id-{{$k->id}}" aria-selected="true">{{$k->nama_kategori_komponen}}</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" id="id-{{$k->id}}" data-toggle="tab" href="#link-id-{{$k->id}}" role="tab" aria-controls="control-id-{{$k->id}}" aria-selected="false">{{$k->nama_kategori_komponen}}</a>
                    </li>
                    @endif
                <?php $urutan++;?>
                @endforeach
                </ul>
                <div class="tab-content">
                    <br />
                    <?php $urutan = 1;?>
                    @foreach ($kategori as $kat)
                        <div class="tab-pane fade show {{ ($urutan == 1) ? 'active' : '' }}" id="link-id-{{$kat->id}}" role="tabpanel" aria-labelledby="tab-{{$kat->id}}">
                            @foreach ($komponen as $k)
                            @if ($k->masterDataKomponen->masterDataKategoriKomponen->id == $kat->id)
                            <div class="form-row">
                                <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                                    <label for="komponen[{{ $k->id }}][kategori]">Kategori Komponen</label>
                                    <input id="komponen[{{ $k->id }}][kategori]" type="text" name="komponen[{{ $k->id }}][kategori]" class="form-control" value="{{ $k->masterDataKomponen->masterDataKategoriKomponen->nama_kategori_komponen }}" disabled>
                                </div>
                                <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                                    <label for="komponen[{{ $k->id }}][nama]">Nama Komponen</label>
                                    <input id="komponen[{{ $k->id }}][nama]" type="text" name="komponen[{{ $k->id }}][nama]" class="form-control" value="{{ $k->masterDataKomponen->nama_komponen }}" disabled>
                                </div>
                                <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                                    <label for="komponen[{{ $k->id }}][menggunakan]">Menggunakan Komponen Ini?</label>
                                    <select id="komponen[{{ $k->id }}][menggunakan]" name="komponen[{{ $k->id }}][menggunakan]" class="form-control" required>
                                        <option value="">-- Menggunakan Komponen Ini? --</option>
                                        <option value="0" {{ old('$k->menggunakan',$k->menggunakan) == '0' ? 'selected' : '' }}>TIDAK</option>
                                        <option value="1" {{ old('$k->menggunakan',$k->menggunakan) == '1' ? 'selected' : '' }}>YA</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                                    <label for="komponen[{{ $k->id }}][jumlah]">Jumlah Komponen</label>
                                    <input id="komponen[{{ $k->id }}][jumlah]" type="number" name="komponen[{{ $k->id }}][jumlah]" class="form-control" placeholder="0" value="{{$k->jumlah}}" required>
                                </div> -->
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <?php $urutan++;?>
                    @endforeach
                </div>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-model-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Ubah</button>
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
        }).on('select2:select', function (e) {
            var data = e.params.data;

            if(data.id != undefined) {
                selectMerek(data.id);
            }
        });
        selectMerek("{{$model->apm_id}}")
        function selectMerek(id) {
            $('#merek_id').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Merek Produk',
                ajax: {
                    url: "{{ route('master-data-merek-cari') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params){
                        return {
                            q: (params.term)?params.term:'',
                            apmId: id
                        }
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
        }
        $('#periode').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Periode',
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
        })    
                
    </script>
@endpush
