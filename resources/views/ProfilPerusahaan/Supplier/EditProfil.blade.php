@extends('layouts.admin_layout')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Formulir Profil Perusahaan</li>
            <li class="breadcrumb-item">Perusahaan Supplier</li>
            <li class="breadcrumb-item">{{ $supplier->nama_perusahaan_supplier }}</li>
            <li class="breadcrumb-item">Profil Perusahaan Supplier</li>
        </ol>
    </nav>
    @include('component.alert')
    @include('ProfilPerusahaan.Component.Title', ['title' => 'Profil Perusahaan Supplier'])

    <div class="accordion" id="accordion">
        <form action="{{ route('profil-perusahaan-supplier-profil-supplier-update', ['id'=>$supplier->id]) }}" method="POST">
            @csrf
            @include('ProfilPerusahaan.Component.FormFieldSupplier', ['supplier' => $supplier, 'periodeTahun' => $periodeTahun, 'kondisi' => 'sebelum'])
        </form>
    </div>
@endsection
