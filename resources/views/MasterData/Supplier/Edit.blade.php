@extends('layouts.admin_layout')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Perusahaan</li>
            <li class="breadcrumb-item">Ubah - {{$supplier->nama_perusahaan_supplier}}</li>
        </ol>
    </nav>
    <form action="{{ route('master-data-supplier-update', ['id' => $supplier->id]) }}" method="POST">
        @csrf
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="nama_perusahaan_supplier">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan_supplier" class="form-control {{ $errors->has('nama_perusahaan_supplier') ? 'is-invalid' : '' }}" id="nama_perusahaan_supplier" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan_supplier',$supplier->nama_perusahaan_supplier) }}">
                        @error('nama_perusahaan_supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="keterangan" placeholder="Keterangan" value="{{ old('keterangan',$supplier->keterangan) }}">
                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <label for="alamat_pabrik">Alamat Supplier</label>
                        <input type="text" name="alamat_pabrik" class="form-control {{ $errors->has('alamat_pabrik') ? 'is-invalid' : '' }}" id="alamat_pabrik" placeholder="Alamat Supplier" value="{{ old('alamat_pabrik',$supplier->alamat_pabrik) }}">
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
            <div class="card-header text-center">
                <b>PIC tiap perusahaan APM</b>
            </div>
            <div class="card-body">
                <div class="form-row">
                    @foreach ($apm as $a)
                        @if(array_search($a->id, array_column(json_decode(json_encode($a->masterDataSupplierPic),TRUE),'apm_id')) !== false)
                            @foreach ($a->masterDataSupplierPic as $p)
                                <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                                    <label for="pic[{{ $p->id }}][apm_id]">Perusahaan APM</label>
                                    <input id="pic[{{ $p->id }}][apm_id]" type="text" name="pic[{{ $p->id }}][apm_id]" class="form-control" value="{{ $a->nama_perusahaan_apm }}" disabled>

                                    <input id="pic[{{ $p->id }}][apm_id]" type="hidden" name="pic[{{ $p->id }}][apm_id]" value="{{ $a->id }}">
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                    <label for="pic[{{ $p->id }}][nama_pic]">Nama PIC</label>
                                    <input id="pic[{{ $p->id }}][nama_pic]" type="text" name="pic[{{ $p->id }}][nama_pic]" class="form-control" value="{{$p->nama_pic}}">
                                </div>
                                <div class="form-group col-md-1 col-xs-12 col-sm-12 col-lg-1">
                                    <label for="pic[{{ $p->id }}][divisi_pic]">Divisi PIC</label>
                                    <input id="pic[{{ $p->id }}][divisi_pic]" type="text" name="pic[{{ $p->id }}][divisi_pic]" class="form-control" value="{{$p->divisi_pic}}">
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                    <label for="pic[{{ $p->id }}][email_pic]">Email PIC</label>
                                    <input id="pic[{{ $p->id }}][email_pic]" type="text" name="pic[{{ $p->id }}][email_pic]" class="form-control" value="{{$p->email_pic}}" maxlength="200">
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                    <label for="pic[{{ $p->id }}][no_telp_pic]">No Telp PIC</label>
                                    <input id="pic[{{ $p->id }}][no_telp_pic]" type="text" name="pic[{{ $p->id }}][no_telp_pic]" class="form-control" value="{{$p->no_telp_pic}}">
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                    <label for="pic[{{ $p->id }}][tanggal_kesediaan_diverifikasi]">Tanggal Diverifikasi</label>
                                    <input id="pic[{{ $p->id }}][tanggal_kesediaan_diverifikasi]" type="date" name="pic[{{ $p->id }}][tanggal_kesediaan_diverifikasi]" class="form-control"  value="{{ date('Y-m-d', strtotime($p->tanggal_kesediaan_diverifikasi) )}}" min="1900-01-01" max="2222-12-31">
                                </div>
                            @endforeach
                        @else
                            <div class="form-group col-md-3 col-xs-12 col-sm-12 col-lg-3">
                                <label for="pic[{{ $a->id }}][apm_id]">Perusahaan APM</label>
                                <input id="pic[{{ $a->id }}][apm_id]" type="text" name="pic[{{ $a->id }}][apm_id]" class="form-control" value="{{ $a->nama_perusahaan_apm }}" disabled>

                                <input id="pic[{{ $a->id }}][apm_id]" type="hidden" name="pic[{{ $a->id }}][apm_id]" value="{{ $a->id }}">
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
                                <input id="pic[{{ $a->id }}][email_pic]" type="text" name="pic[{{ $a->id }}][email_pic]" class="form-control">
                            </div>
                            <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <label for="pic[{{ $a->id }}][no_telp_pic]">No Telp PIC</label>
                                <input id="pic[{{ $a->id }}][no_telp_pic]" type="text" name="pic[{{ $a->id }}][no_telp_pic]" class="form-control">
                            </div>
                            <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <label for="pic[{{ $a->id }}][tanggal_kesediaan_diverifikasi]">Tanggal Diverifikasi</label>
                                <input id="pic[{{ $a->id }}][tanggal_kesediaan_diverifikasi]" type="date" name="pic[{{ $a->id }}][tanggal_kesediaan_diverifikasi]" class="form-control" min="1900-01-01" max="2222-12-31">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div><br />
        <div class="row container col-md-12">
            <div class="col-md-6">
                <a href="{{ route('master-data-supplier-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Ubah</button>
            </div>
        </div>
    </form>
@endsection