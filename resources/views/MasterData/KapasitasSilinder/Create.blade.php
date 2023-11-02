@extends('layouts.admin_layout')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Kapasitas Silinder</li>
            <li class="breadcrumb-item">Tambah</li>
        </ol>
    </nav>
    <form action="{{ route('master-data-kapasitas-silinder-store') }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="nama_kelompok">Nama Kelompok Kapasitas Silinder</label>
                        <input type="text" name="nama_kelompok" class="form-control {{ $errors->has('nama_kelompok') ? 'is-invalid' : '' }}" id="nama_kelompok" placeholder="Nama Kelompok Kapasitas Silinder" value="{{ old('nama_kelompok') }}">
                        @error('nama_kelompok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="minimal">Kapasitas Minimal Silinder (CC)</label>
                        <input type="number" name="minimal" class="form-control {{ $errors->has('minimal') ? 'is-invalid' : '' }}" id="minimal" placeholder="Kapasitas Minimal Silinder" value="{{ old('minimal') }}">
                        @error('minimal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                        <label for="maksimal">Kapasitas Maksimal Silinder (CC)</label>
                        <input type="number" name="maksimal" class="form-control {{ $errors->has('maksimal') ? 'is-invalid' : '' }}" id="maksimal" placeholder="Kapasitas Maksimal Silinder" value="{{ old('maksimal') }}">
                        @error('maksimal')
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
                <a href="{{ route('master-data-kapasitas-silinder-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Tambah</button>
            </div>
        </div>
    </form>
@endsection