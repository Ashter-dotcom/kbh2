@extends('layouts.admin_layout')

@push('style')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Formulir Profil Perusahaan</li>
            <li class="breadcrumb-item">Perusahaan Supplier</li>
        </ol>
    </nav>
    @include('component.alert')
    {{ $dataTable->table(['class' => 'table table-bordered table-striped shadow']) }}
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
