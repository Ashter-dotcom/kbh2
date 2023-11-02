@extends('layouts.admin_layout')

@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    @include('admin.production_form.component.navigation', ['title' => $data['title'], 'breadcrumb' => $data['breadcrumb']])

    <form method="POST" action="{{ route('form_produksi.selling.store-selling', ['model_id' => request()->model_id]) }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nik">NIK :</label>
                    <input type="text" name="nik" class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" id="nik" aria-describedby="nik" placeholder="NIK" value="{{ old('nik') }}">
                    @error('nik')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tanggal_produksi">Tanggal Produksi</label>
                    <input type="text" name="tanggal_produksi" class="form-control {{ $errors->has('tanggal_produksi') ? 'is-invalid' : '' }}" id="tanggal_produksi" placeholder="Tanggal Produksi" value="{{ old('tanggal_produksi') }}">
                    @error('tanggal_produksi')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="tanggal_penjualan">Tanggal Penjualan</label>
                    <input type="text" name="tanggal_penjualan" class="form-control {{ $errors->has('tanggal_penjualan') ? 'is-invalid' : '' }}" id="tanggal_penjualan" placeholder="Tanggal Penjualan" value="{{ old('tanggal_penjualan') }}">
                    @error('tanggal_penjualan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>                        
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="penjualan">Penjualan</label>
                    <select name="penjualan" id="penjualan" class="form-control {{ $errors->has('penjualan') ? 'is-invalid' : '' }}">
                        <option value="">-- Pilih Penjualan --</option>
                        <option value="domestik" {{ old('penjualan') == 'domestik' ? 'selected' : '' }}>Domestik</option>
                        <option value="ekspor" {{ old('penjualan') == 'ekspor' ? 'selected' : '' }}>Ekspor</option>
                    </select>
                    @error('penjualan')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="harga">Harga Satuan</label>
                    <input type="text" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" id="harga" placeholder="Harga Satuan" value="{{ old('harga') }}">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="konsumen">Konsumen</label>
                    <input type="text" name="konsumen" class="form-control {{ $errors->has('konsumen') ? 'is-invalid' : '' }}" id="konsumen" placeholder="Konsumen" value="{{ old('konsumen') }}">
                    @error('konsumen')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>
            </div>            

            <div class="col-md-12">
            <div class="form-group">
                    <label for="konsumen">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="5">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>
            </div>
            
        </div>

        <div class="button-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('form_produksi.selling.index-selling', ['model_id' => request()->model_id]) }}" class="btn btn-default btn-custom-close float-right">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-dark btn-custom-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>    
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $('#tanggal_produksi, #tanggal_penjualan').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            todayHighlight: true
        });
    </script>
@endpush