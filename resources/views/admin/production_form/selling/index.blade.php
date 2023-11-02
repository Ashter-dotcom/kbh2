@extends('layouts.admin_layout')


@push('style')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>

        .text {
            font-size:14px;
        }
    </style>
@endpush


@section('content')
    <!-- Page Heading -->
    @include('component.alert')

    @include('admin.production_form.component.navigation', ['title' => $data['title'], 'breadcrumb' => $data['breadcrumb']])
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <a href="{{ asset('assets/file/format-upload.xlsx') }}" class="btn btn-dark btn-icon-split tombol-tambah">
                <span class="icon text-white-100">
                    <i class="fa fa-file"></i>
                </span>
                <span class="text"><b>Format Unggahan</b></span>
            </a>
        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
            <a href="javascript:void(0)" class="btn btn-dark btn-icon-split tombol-tambah" data-toggle="modal" data-target="#importFile">
                <span class="icon text-white-100">
                    <i class="fa fa-save"></i>
                </span>
                <span class="text"><b>Upload Nomor Identifikasi Kendaraan</b></span>
            </a>
        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
            <a href="{{ route('form_produksi.selling.create-selling', ['model_id' => request()->model_id]) }}" class="btn btn-dark btn-icon-split tombol-tambah">
                <span class="icon text-white-100">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text"><b>Tambah  Nomor Identifikasi Kendaraan</b></span>
            </a>
        </div>
    </div>

    <hr>

    <!-- Modal -->
    <div class="modal fade" id="importFile" tabindex="-1" role="dialog" aria-labelledby="importFile" aria-hidden="true"  data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form action="{{ route('form_produksi.selling.import', ['model_id' => request()->model_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importFile">Import File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="selling" class="form-control-file" accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-dark"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                    dataTableID = "selling-table";

                Swal.fire({
                    title: textConfirm,
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
                        Global.responseMessageWithSwal("Data Produksi & Penjualan berhasil dihapus");
                    }
                });
            });
        });

    </script>

    {!! $dataTable->scripts() !!}
@endpush