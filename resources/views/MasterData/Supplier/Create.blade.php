@extends('layouts.admin_layout')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Perusahaan</li>
            <li class="breadcrumb-item">Tambah Perusahaan</li>
        </ol>
    </nav>
    <form action="{{ route('master-data-supplier-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="nama_perusahaan_supplier">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan_supplier" class="form-control {{ $errors->has('nama_perusahaan_supplier') ? 'is-invalid' : '' }}" id="nama_perusahaan_supplier" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan_supplier') }}">
                        @error('nama_perusahaan_supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="keterangan" placeholder="Keterangan">
                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-9 col-xs-12 col-sm-12 col-lg-9">
                        <label for="alamat_pabrik">Alamat Supplier</label>
                        <input type="text" name="alamat_pabrik" class="form-control {{ $errors->has('alamat_pabrik') ? 'is-invalid' : '' }}" id="alamat_pabrik" placeholder="Alamat Supplier">
                        @error('alamat_pabrik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-1 col-sm-1 col-lg-3">
                            <label for="tambah_komponen">Tambah Komponen</label>
                            @include('component.alert')
                            <a href="{{ route('master-data-supplier-create') }}" class="btn btn-dark btn-icon-split float-right tombol-tambah">
                                <span class="icon text-white-100">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text"><b>Tambah Komponen</b></span>
                            </a>
                            @error('alamat_pabrik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>
            </div>
        </div><br />
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                        <label for="kategori_id">Kategori Komponen</label>
                        <select id="kategori_id" name="kategori_id" class="form-control {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}"></select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                        <label for="kategori_id">Nama Komponen</label>
                        <select id="kategori_id" name="kategori_id" class="form-control {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}"></select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                        <label for="nama_perusahaan_apm">Total Kapasitas</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                        <label for="nama_perusahaan_apm">Satuan</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
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
                <b>PIC tiap perusahaan APM</b>
            </div>
            <div class="card-body">
                <div class="form-row">
                    @foreach ($apm as $a)
                        <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                            <label for="pic[{{ $a->id }}][apm_id]">Perusahaan APM</label>
                            <input id="pic[{{ $a->id }}][apm_id]" type="text" name="pic[{{ $a->id }}][apm_id]" class="form-control" value="{{ $a->nama_perusahaan_apm }}" disabled>
                        </div>
                        <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                            <label for="pic[{{ $a->id }}][nama_pic]">Nama PIC</label>
                            <input id="pic[{{ $a->id }}][nama_pic]" type="text" name="pic[{{ $a->id }}][nama_pic]" class="form-control">
                        </div>
                        <div class="form-group col-md-1 col-xs-12 col-sm-12 col-lg-1">
                            <label for="pic[{{ $a->id }}][divisi_pic]">Divisi PIC</label>
                            <input id="pic[{{ $a->id }}][divisi_pic]" type="text" name="pic[{{ $a->id }}][divisi_pic]" class="form-control">
                        </div>
                        <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                            <label for="pic[{{ $a->id }}][email_pic]">Email PIC</label>
                            <input id="pic[{{ $a->id }}][email_pic]" type="text" name="pic[{{ $a->id }}][email_pic]" class="form-control" maxlength="200">
                        </div>
                        <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                            <label for="pic[{{ $a->id }}][no_telp_pic]">No Telp PIC</label>
                            <input id="pic[{{ $a->id }}][no_telp_pic]" type="text" name="pic[{{ $a->id }}][no_telp_pic]" class="form-control">
                        </div>
                        <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                            <label for="pic[{{ $a->id }}][tanggal_kesediaan_diverifikasi]">Tanggal Diverifikasi</label>
                            <input id="pic[{{ $a->id }}][tanggal_kesediaan_diverifikasi]" type="date" name="pic[{{ $a->id }}][tanggal_kesediaan_diverifikasi]" class="form-control" min="1900-01-01" max="2222-12-31">
                        </div>

                    @endforeach
                </div>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-supplier-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
            </div>
        </div>
    </form>
@endsection
