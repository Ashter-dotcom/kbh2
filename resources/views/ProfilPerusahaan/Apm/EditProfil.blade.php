@extends('layouts.admin_layout')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Formulir Profil Perusahaan</li>
            <li class="breadcrumb-item">Perusahaan APM</li>
            <li class="breadcrumb-item">{{ $apm->nama_perusahaan_apm }}</li>
            <li class="breadcrumb-item">Profil Perusahaan APM</li>
        </ol>
    </nav>
    @include('component.alert')
    @include('ProfilPerusahaan.Component.Title', ['title' => 'Profil Perusahaan APM'])

    <div class="accordion" id="accordion">
        <form action="{{ route('profil-perusahaan-apm-profil-apm-update', ['id'=>$apm->id]) }}" method="POST">
            @csrf
            @include('ProfilPerusahaan.Component.FormFieldApm', ['apm' => $apm, 'periodeTahun' => $periodeTahun, 'kondisi' => 'sebelum'])
        </form>
    </div>
@endsection
