@extends('layouts.admin_layout')
@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Perusahaan APM</li>
            <li class="breadcrumb-item">Tambah</li>
        </ol>
    </nav>

    <form action="{{ route('master-data-apm-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="slug">Label Menu (Slug)</label>
                        <input type="text" name="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slug" placeholder="Label Menu" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_perusahaan_apm">Nama Perusahaan APM</label>
                        <input type="text" name="nama_perusahaan_apm" class="form-control {{ $errors->has('nama_perusahaan_apm') ? 'is-invalid' : '' }}" id="nama_perusahaan_apm" placeholder="Nama Perusahaan APM" value="{{ old('nama_perusahaan_apm') }}">
                        @error('nama_perusahaan_apm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="npwp_perusahaan">NPWP Perusahaan</label>
                        <input type="text" name="npwp_perusahaan" class="form-control {{ $errors->has('npwp_perusahaan') ? 'is-invalid' : '' }}" id="npwp_perusahaan" placeholder="NPWP Perusahaan">
                        @error('npwp_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="no_telp_kantor">No. Telp Kantor</label>
                        <input type="text" name="no_telp_kantor" class="form-control {{ $errors->has('no_telp_kantor') ? 'is-invalid' : '' }}" id="no_telp_kantor" placeholder="No. Telp Kantor">
                        @error('no_telp_kantor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="tanggal_kesediaan_diverifikasi">Tanggal Kesediaan Diverifikasi</label>
                        <input type="date" name="tanggal_kesediaan_diverifikasi" class="form-control {{ $errors->has('tanggal_kesediaan_diverifikasi') ? 'is-invalid' : '' }}" id="tanggal_kesediaan_diverifikasi" placeholder="Tanggal Kesediaan">
                        @error('tanggal_kesediaan_diverifikasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <div class="form-group col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <label for="alamat_pabrik">Alamat Pabrik</label>
                            <textarea type="text" name="alamat_pabrik" class="ckeditor form-control {{ $errors->has('alamat_pabrik') ? 'is-invalid' : '' }}" id="alamat_pabrik" placeholder="Alamat Pabrik"></textarea>
                            @error('alamat_pabrik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <div class="form-group col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <label for="alamat_kantor">Alamat Kantor</label>
                            <textarea type="text" name="alamat_kantor" class="form-control {{ $errors->has('alamat_kantor') ? 'is-invalid' : '' }}" id="alamat_kantor" placeholder="Alamat Kantor" rows="4"></textarea>
                            @error('alamat_kantor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                            <label for="nama_pic">Nama PIC</label>
                            <input type="text" name="nama_pic" class="form-control {{ $errors->has('nama_pic') ? 'is-invalid' : '' }}" id="nama_pic" placeholder="Nama PIC">
                            @error('nama_pic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                            <label for="divisi_pic">Divisi PIC</label>
                            <input type="text" name="divisi_pic" class="form-control {{ $errors->has('divisi_pic') ? 'is-invalid' : '' }}" id="divisi_pic" placeholder="Divisi PIC">
                            @error('divisi_pic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
                            <label for="email_pic">Email PIC</label>
                            <input type="email" name="email_pic" class="form-control {{ $errors->has('email_pic') ? 'is-invalid' : '' }}" id="email_pic" placeholder="Email PIC">
                            @error('email_pic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
                            <label for="no_telp_pic">No Telp PIC</label>
                            <input type="text" name="no_telp_pic" class="form-control {{ $errors->has('no_telp_pic') ? 'is-invalid' : '' }}" id="no_telp_pic" placeholder="No Telp PIC">
                            @error('no_telp_pic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-apm-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'alamat_pabrik' );
    </script>
@endpush
