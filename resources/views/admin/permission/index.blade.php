@extends('layouts.admin_layout')


@push('style')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800">Izin</h1>
    @include('component.alert')
    <a href="{{ route('permission.createpermission') }}" class="btn btn-dark btn-icon-split float-right tombol-tambah">
        <span class="icon text-white-100">
            <i class="fa fa-plus"></i>
        </span>
        <span class="text"><b>Tambah Izin</b></span>
    </a>
    {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
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
                    dataTableID = "permissions-table";

                Swal.fire({
                    title: textConfirm,
                    text: '',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "blue",
                    confirmButtonText: "Confirm.!",
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
                        Global.responseMessageWithSwal("Your data has been deleted");
                    }
                });
            });
        });

    </script>

    {!! $dataTable->scripts() !!}
@endpush
