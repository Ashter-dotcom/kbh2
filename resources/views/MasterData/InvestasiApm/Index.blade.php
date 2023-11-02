@extends('layouts.admin_layout')

@push('style')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Referensi Data</li>
            <li class="breadcrumb-item">Investasi APM</li>
        </ol>
    </nav>
    @include('component.alert')
    <a href="{{ route('master-data-investasi-apm-create') }}" class="btn btn-dark btn-icon-split float-right tombol-tambah">
        <span class="icon text-white-100">
            <i class="fa fa-plus"></i>
        </span>
        <span class="text"><b>Tambah Investasi APM</b></span>
    </a>
    {{ $dataTable->table(['class' => 'table table-bordered table-striped shadow']) }}
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-item', function (e) {
                let self = $(this),
                    url = self.attr('data-action'),
                    method = self.attr('data-method'),
                    params = {
                        "_token": "{{ csrf_token() }}"
                    },
                    textConfirm = self.attr('title'),
                    dataTableID = "apm-table";

                Swal.fire({
                    title: textConfirm,
                    text: '',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "red",
                    confirmButtonText: "Konfirmasi",
                    cancelButtonText: "Batal",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        return $.ajax({
                            url:url, type:method, typeData:'json',  cache:false, data:params,
                            success: function(data){
                                if (typeof window.LaravelDataTables !== "undefined" && typeof window.LaravelDataTables[dataTableID] !== "undefined"){
                                    (window.LaravelDataTables[dataTableID]).draw();
                                }
                            }
                        });
                    },
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        Global.responseMessageWithSwal("Data Anda sudah terhapus");
                    }
                });
            });
        });

    </script>

    {!! $dataTable->scripts() !!}
@endpush
