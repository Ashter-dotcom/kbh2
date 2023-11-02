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
            <li class="breadcrumb-item">View Data</li>
            <li class="breadcrumb-item">H6A</li>
            <li class="breadcrumb-item">{{ $supplier->nama_perusahaan_supplier }}</li>
        </ol>
    </nav>
    @include('component.alert')
    <form action="{{ route('view-data-d5a-lihat') }}" method="GET">
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-10 col-xs-12 col-sm-12 col-lg-10">
                        <label for="supplier">Pilih Perusahaan Supplier</label>
                        <select id="supplier" name="supplier" class="form-control {{ $errors->has('supplier') ? 'is-invalid' : '' }}">
                            <option value="{{$supplier->id}}" selected>{{$supplier->nama_perusahaan_supplier}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <button style="margin-top: 31px;" type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr />
    @include('ViewData.D5A.Table',[ 'supplier' => $supplier, 'profil' => $profil, 'attribute' => $attribute, 'kondisi' => $kondisi, 'periodeTahun' => $periodeTahun ])
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#supplier').select2({
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('master-data-supplier-cari') }}",
                dataType: 'json',
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
