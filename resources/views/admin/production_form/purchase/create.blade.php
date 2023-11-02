@extends('layouts.admin_layout')

@push('style')

<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>
    .form-title {
        font-weight:bold;
        font-size:16px;
    }

    .card-header-background {
        background:#44AF9F;
    }

    .card-header-background h6 {
        text-align:center;
        color:#FFFFFF !important;
        font-family: 'STIX Two Text', serif !important;
        font-size:15px;
    }

    .card-body-background {
        background:#DFE6EE !important;
    }
</style>

@endpush


@section('content')


<!-- Page Heading -->
@include('component.alert')
@include('admin.production_form.component.navigation', ['title' => $data['title'], 'period' => $data['period'], 'breadcrumb' => $data['breadcrumb']])


<form action="{{ route('form_produksi.purchase.store-purchase', ['model_id' => request()->model_id, 'period_id' => request()->period_id, 'component_category' => request()->component_category]) }}" method="POST">
<div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-6">
                        <label for="periode">Pilih supplier :</label>
                        <select name="supplier" id="supplier" class="form-control supplier" required>
                            <option value="">-- Pilih supplier --</option>
                        </select>
                        <div class="invalid-feedback">
                            Supplier tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-lg-6 col-xs-2 col-sm-2">
                        <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
@csrf

@if(!empty($data['componentPurchase']))
    <input type="hidden" name="purchase_id" value="{{ $data['componentPurchase']['purchase_id'] }}">
@endif
@foreach($data['components'] as $component)
    <div class="card position-relative mb-10">
        <div class="card-header py-3 card-header-background">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog"></i> Kategori {{ $component['component_category_name'] }} - {{ $component['component_name'] }}</h6>
        </div>
        <div class="card-body card-body-background">
            <div class="row">
                <div class="col-md-12">
                    <p class="form-title">Total Kebutuhan Komponen : </p>
                </div>
                
                @foreach($data['ranges'] as $key => $range) 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ $range }}</label>
                            <input type="text" class="form-control" name="kebutuhan[{{ $component['component_id'] }}][{{ $range }}][]" value="{{ (isset($data['selling'][$range]) ? $component['component_ammount'] * $data['selling'][$range] : $component['component_ammount']) }}"  readonly>
                        </div>
                    </div>
                @endforeach
            
            </div>

            @if(!empty($data['componentSuppliers'][$component['component_name']]))
                @foreach($data['componentSuppliers'][$component['component_name']] as $keyComponent => $componentSupplier)
                    <div class="row">
                        <div class="col-md-12">
                            <p class="form-title">Total Pembelian Lokal {{ $componentSupplier['supplier'] }} <label class="text-danger">{{ $componentSupplier['sub_supplier'] }}</label></p> 
                        </div>
                        @foreach($data['ranges'] as $key => $range) 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{ $range }}</label>
                                    @if(!empty($data['componentPurchase']['pembelian_lokal'][$componentSupplier['component_supplier_id']][$component['component_id']][$componentSupplier['supplier_id']][$range]))
                                        <input type="number" class="form-control" name="pembelian_lokal[{{ $componentSupplier['component_supplier_id'] }}][{{ $component['component_id'] }}][{{ $componentSupplier['supplier_id'] }}][{{ $range }}][]" value="{{ $data['componentPurchase']['pembelian_lokal'][$componentSupplier['component_supplier_id']][$component['component_id']][$componentSupplier['supplier_id']][$range][0] }}">
                                    @else
                                        <input type="number" class="form-control" name="pembelian_lokal[{{ $componentSupplier['component_supplier_id'] }}][{{ $component['component_id'] }}][{{ $componentSupplier['supplier_id'] }}][{{ $range }}][]">
                                    @endif
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <p class="text-danger">Data belum tersedia, harap isi data <a href="{{ route('form_produksi.supplier.create-supplier', ['model_id' => request()->model_id, 'component_category' => request()->component_category]) }}">disini</a></p>
            @endif
        </div>
    </div>
@endforeach
    <div class="button-wrapper">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('form_produksi.purchase.period-purchase', ['model_id' => request()->model_id]) }}" class="btn btn-default btn-custom-close float-right">
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
<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>

<script>
    let deliveryKomponen = {

        init: function() {
            deliveryKomponen.selectSupplier();
        },

        selectSupplier: function() {
                $('.supplier').select2({
                    theme: 'bootstrap4',
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
            }
    }

    $(document).ready(function(){
        deliveryKomponen.init();
    });
</script>

@endpush