@push('style')


<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>
    .switch-title {
        margin:5px 0;
    }
    .card-header-background {
        background:#788896;
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

	.select2-container--bootstrap4 .select2-selection__clear {
		margin-right:20px !important;
		color:#000000;
		width:17px;
		font-weight:bold;
		border:none !important;
		background-color:#ffffff;
	}

	.select2-selection__clear:hover  {
		background-color:#ffffff !important;
	}
</style>

@endpush


@if(!empty($lists))
<form class="needs-validation" name="myform" method="POST" action="{{ route('form_produksi.supplier.update-supplier', ['model_id' => request()->model_id, 'component_category' => request()->component_category]) }}" novalidate>
@else
<form class="needs-validation" name="myform" method="POST" action="{{ route('form_produksi.supplier.store-supplier', ['model_id' => request()->model_id, 'component_category' => request()->component_category]) }}" novalidate>
@endif
    @csrf

    @if(!empty($components))
        @foreach($components as $component)

            @if(!empty($lists[$component['component_id']]['data_supplier']))
                @foreach($lists[$component['component_id']]['data_supplier'] as $list)
                    <input type="hidden" name="id[data_supplier][{{ $component['component_id'] }}][]" value="{{ $list['id'] }}">
                @endforeach
            @endif

            @if(!empty($lists[$component['component_id']]['data_inhouse'])) 
                <input type="hidden" name="id[data_inhouse][{{ $component['component_id'] }}][]" value="{{ $lists[$component['component_id']]['data_inhouse']['id'] }}">
            @endif

            <div class="card position-relative mb-10">
                <div class="card-header py-3 card-header-background">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog"></i> Kategori {{ $component['component_category_name'] }}  - Komponen {{ $component['component_name'] }} - Jumlah {{ $component['component_ammount'] }}</h6>
                </div>
                <div class="card-body card-body-background">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="switch-title">Inhouse ?</p>
                            <label class="switch">
                                @if(!empty($lists[$component['component_id']]['data_inhouse']))
                                    <input type="checkbox" class="inhouse" name="inhouse[{{ $component['component_id'] }}][]" onclick="Form.inHouse(this, '{{ $component['component_id'] }}')" {{ $lists[$component['component_id']]['data_inhouse']['in_house'] == 1 ? 'checked' : '' }}>
                                @else
                                    <input type="checkbox" class="inhouse" name="inhouse[{{ $component['component_id'] }}][]" onclick="Form.inHouse(this, '{{ $component['component_id'] }}')">
                                @endif
                                
                                <span class="slider round"></span>
                            </label>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="actual_component_name_inhouse">Nama Komponen Aktual:</label>
                                @if(!empty($lists[$component['component_id']]['data_inhouse']))
                                    <input type="text" class="form-control" id="actual_component_name_inhouse-{{ $component['component_id'] }}" name="actual_component_name_inhouse[{{ $component['component_id'] }}][]" value="{{ $lists[$component['component_id']]['data_inhouse']['actual_component_name'] }}" maxlength="200" required>
                                    <div class="invalid-feedback">
                                        Nama Komponen Aktual Wajib Diisi
                                    </div>
                                @else
                                    <input type="text" class="form-control" id="actual_component_name_inhouse-{{ $component['component_id'] }}" name="actual_component_name_inhouse[{{ $component['component_id'] }}][]" maxlength="200" required readonly>
                                    <div class="invalid-feedback">
                                        Nama Komponen Aktual Wajib Diisi
                                    </div>
                                @endif
                            </div> 
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                                    <button class="btn btn-dark" type="button" onclick="Form.addForm('{{ $component['component_id'] }}')">
                                        <i class="fa fa-plus"></i>Tambah Supplier
                                    </button>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="wrapper-supplier-{{$component['component_id'] }}">
                        <div class="row {{ $component['component_id'] }}-0">
                            @if(!empty($lists[$component['component_id']]['data_supplier']))
                                @foreach($lists[$component['component_id']]['data_supplier'] as $supplier)
                                
                                    <div class="col-md-4 {{ $supplier['id'] }}">
                                        <div class="form-group">
                                            <label for="actual_component_name-{{ $component['component_id'] }}">Nama Komponen Aktual :</label>
                                            <input type="text" id="actual_component_name-{{ $component['component_id'] }}" name="actual_component_name[{{ $component['component_id'] }}][]" value="{{ $supplier['actual_component_name'] }}" class="form-control" maxlength="200" required>
                                            <div class="invalid-feedback">
                                                Nama Komponen Aktual Wajib Diisi
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 {{ $supplier['id'] }}">
                                        <div class="form-group">
                                            <label>Supplier :</label>
                                            <select name="supplier_id[{{ $component['component_id'] }}][]" class="form-control supplier" required>
                                                <option value="">-- Pilih Supplier --</option>
                                                <option value="{{ $supplier['supplier_id'] }}" selected>{{ $supplier['supplier_name'] }}</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Supplier Wajib Diisi
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 {{ $supplier['id'] }}">
                                        <label>Sub Kontraktor :</label>
                                        <div class="input-group">
                                            <select name="sub_supplier_id[{{ $component['component_id'] }}][]" class="form-control sub_kontraktor">
                                                <option value="">-- Pilih Sub Kontraktor --</option>
                                                <option value="{{ $supplier['sub_supplier_id'] }}" selected>{{ $supplier['sub_supplier_name'] }}</option>
                                            </select>

                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="button" onclick="Form.removeFormAjax('{{ $supplier['id'] }}', '{{ $supplier['delete_url'] }}')">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>          
                </div>    
            </div>
        @endforeach
        <div class="button-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark btn-custom-success btn-custom"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>    
        </div>
    @else
        <br>
        <div class="alert alert-warning">Data Belum Tersedia</div>    
    @endif
    
</form>

@push('scripts')
    <script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>


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

    <script type="text/javascript">
        let number = 0;
    
        let Form = {

            init: function() {
                Form.select2Supplier();
				Form.select2SubKontraktor();
            },

            inHouse: function(status, param) {
                if(status.checked == true) {
                    $('#actual_component_name_inhouse-'+param).prop('readonly', false);
                } else {
                    $('#actual_component_name_inhouse-'+param).prop('readonly', true);
                }
            },

            addForm: function(componentId) {

                number += 1

                let html = '<div class="row '+componentId+'-'+number+'">'+

                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="actual_component_name-'+componentId+'">Nama Komponen Aktual :</label>'+
                            '<input type="text" id="actual_component_name-'+componentId+'" name="actual_component_name['+componentId+'][]" class="form-control" maxlength="200" required>'+
                            '<div class="invalid-feedback">'+
                                'Nama Komponen Aktual Wajib Diisi'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="supplier_id-'+componentId+'" >Supplier :</label>'+
                            '<select name="supplier_id['+componentId+'][]" class="form-control supplier" required>'+
                                '<option value="">-- Pilih Supplier --</option>'+
                            '</select>'+
                            '<div class="invalid-feedback">'+
                                'Supplier Wajib Diisi'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label>Sub Kontraktor :</label>'+
                        '<div class="input-group">'+
                            '<select name="sub_supplier_id['+componentId+'][]" class="form-control sub_kontraktor">'+
                                '<option value="">-- Pilih Sub Kontraktor --</option>'+
                            '</select>'+
                            '<div class="input-group-append">'+
                                '<button class="btn btn-danger" type="button" onclick="Form.removeForm(`'+componentId+'-'+number+'`)">'+
                                    '<i class="fa fa-minus"></i>'+
                                '</button>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';

                $('.wrapper-supplier-'+componentId).append(html);

                Form.select2Supplier();
				Form.select2SubKontraktor();
            },

            removeForm: function(componentId){
                $('.'+componentId).remove();
            },

            removeFormAjax: function(id, url) {
                Swal.fire({
                    title: 'Ingin menghapus data supplier ?',
                    text: '',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "blue",
                    confirmButtonText: "Konfirmasi.",
                    cancelButtonText: "Batal.",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        return $.ajax({
                            url: url,
                            type:'POST', 
                            cache:false, 
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data){
                                $('.'+id).remove();
                            }
                        });
                    },
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        Global.responseMessageWithSwal("Data supplier behasil dihapus");
                    }
                });
            },

            select2Supplier: function() {
                $('.supplier').select2({
					placeholder: "Pilih Supplier",
					allowClear: true,
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
            },

			select2SubKontraktor: function() {
                $('.sub_kontraktor').select2({
					placeholder: "Pilih Sub Kontraktor",
					allowClear: true,
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
            Form.init();
        });
    </script>
@endpush