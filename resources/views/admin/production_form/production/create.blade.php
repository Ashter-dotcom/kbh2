@extends('layouts.admin_layout')

@push('style')

<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>
    .btn-custom {
        margin-top:1.8em;
    }

    .card-header-background {
        background:#44AF9F;
    }

    .card-header-background h6 {
        text-align:center;
        color:#FFFFFF !important;
        font-family: 'STIX Two Text', serif !important;
        font-size:12px;
    }

    .card-body-background {
        background:#DFE6EE !important;
    }

    .actual_component_title {
        margin:0;
        padding:5px 0;
        font-weight:bold;
        color:#000000;
        font-family: 'STIX Two Text', serif !important;
    }
    
</style>

@endpush

@section('content')
    <!-- Page Heading -->
    @include('component.alert')
    @include('admin.production_form.component.navigation', ['title' => $data['title'], 'breadcrumb' => $data['breadcrumb']])

    <!-- <form action="{{ route('form_produksi.production.create-production', ['model_id' => request()->model_id]) }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                        <label for="periode">Pilih Periode :</label>
                        <select name="Periode" id="period" class="form-control supplier" required>
                            <option value="">-- Pilih Periode --</option>
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
    </form> -->

    <form action="{{ route('form_produksi.production.create-production', ['model_id' => request()->model_id, 'period_id' => request()->period_id]) }}" method="GET" class="needs-validation" novalidate>
        <div class="container-fluid card shadow">
            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                        <label id="periode">Pilih supplier :</label>
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
    </form>

    @if(!empty($data['suppliers']['data']))
        <form action="{{ route('form_produksi.production.store-production', ['model_id' => request()->model_id,'period_id' => request()->period_id, 'supplier' => request()->supplier, 'page' => request()->page]) }}" method="POST">
            @csrf
            @foreach($data['suppliers']['data'] as $key => $suppliers)
                <div class="card position-relative mb-10">
                    <div class="card-header py-3 card-header-background">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cart-arrow-down"></i> {{ $suppliers[0]['supplier_name'] }}</h6>
                    </div>
                    <div class="card-body card-body-background">
                        @foreach($suppliers as $supplier)
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                    <p class="actual_component_title"> Total Produksi {{ $supplier['component_name'] }} ( {{ $supplier['actual_component_name'] }} ) <span style="color:red !important"> {{ $supplier['sub_supplier_name'] }} </span> :</p>
                                    <div class="row">
                                        <div class="form-group col-md-4 stock-awal">
                                            <label>Stock Awal (Januari)</label>
                                            @if (!empty($data['productionSuppliers'][$supplier['id']]['stock']))
                                                <input type="text" name="stock[{{ $supplier['id'] }}]" class="form-control" value="{{ $data['productionSuppliers'][$supplier['id']]['stock'] }}">
                                            @else
                                                <input type="text" name="stock[{{ $supplier['id'] }}]" class="form-control">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 stock-awal part-number">
                                            <label>Part Number</label>
                                            <input type="text" name="part_number[{{ $supplier['id'] }}][0]" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xs-2 col-sm-2">
                                            <button id="addPartNumber" type="button" class="btn btn-success btn-custom btn-block shadow"><i class="fa fa-plus"></i> Tambah Part Number</button>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label> Stock Awal (Januari)</label>
                                                @if(!empty($data['productionSuppliers'][$supplier['id']]['stock']))
                                                    <input type="text" name="stock[{{ $supplier['id'] }}]" class="form-control" value="{{ $data['productionSuppliers'][$supplier['id']]['stock'] }}">
                                                @else
                                                    <input type="text" name="stock[{{ $supplier['id'] }}]" class="form-control">
                                                @endif

                                            </div>
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                @foreach($data['periods'] as $period)
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> {{ $period['bulan'] }} <sup>{{ $period['tahun'] }}</sup> </label>
                                            @if(!empty($data['productionSuppliers'][$supplier['id']]['produksi'][$period['bulan']]))
                                                <input type="text" name="produksi[{{ $supplier['id'] }}][{{ $period['bulan'] }}]" class="form-control" value="{{ $data['productionSuppliers'][$supplier['id']]['produksi'][$period['bulan']] }}">
                                            @else
                                                <input type="text" name="produksi[{{ $supplier['id'] }}][{{ $period['bulan'] }}]" class="form-control" value="0">
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{ $data['suppliers']['pagination']->appends(['supplier' => request()->supplier])->links('pagination.bootstrap') }}

            <div class="button-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark btn-custom-success btn-custom"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <p class="text-center text-danger">Data belum tersedia, harap isi data <a href="{{ route('form_produksi.supplier.index-supplier', ['model_id' => request()->model_id]) }}">disini</a>
    @endif
@endsection

@push('scripts')
<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>

<!-- <script>
    let productionSupplier = {

        init: function() {
            productionSupplier.selectPeriode();
        },

        selectSupplier: function() {
                $('.period').select2({
                    theme: 'bootstrap4',
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
                });
            }
    }

    $(document).ready(function(){
        productionSupplier.init();
    });
</script> -->
<!-- <script>
    let productionSupplier = {

        init: function() {
            productionSupplier.selectSupplier();
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
        productionSupplier.init();
    });
</script> -->
<script>
    $(document).ready(function() {
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
    });
</script>
<!-- Add this script to your Blade template -->
<script>
    $(document).ready(function() {
        let partNumberCount = 1; // Initialize the count

        // Handle the click event of the "Tambah Part Number" button
        $('#addPartNumber').click(function(e) {
            e.preventDefault();

            console.log('Button clicked'); // Check if the button click event is triggered

            const $clonedPartNumber = $('.part-number:first').clone();

            console.log('Cloned field:', $clonedPartNumber); // Check if the cloning is working

            // Increment the name attribute to ensure unique field names
            $clonedPartNumber.find('input').attr('name', 'part_number[' + partNumberCount + ']');

            // Clear the input value in the cloned field
            $clonedPartNumber.find('input').val('');

            // Append the cloned field group to the container
            $('.part-number:last').after($clonedPartNumber);

            partNumberCount++;
        });

    });
</script>

@endpush

