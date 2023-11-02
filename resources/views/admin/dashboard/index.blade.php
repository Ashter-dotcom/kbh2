@extends('layouts.admin_layout')

@section('content')
    @include('admin.component.dashboard.navigation')

    @if(request()->tipe_report == 'overview')
        @include('admin.dashboard.chart.overview')
    @endif

    @if(request()->tipe_report == 'pohon-industri')
        @include('admin.dashboard.chart.pohon-industri')
    @endif

    @if(request()->tipe_report == 'statistik-apm')
        @include('admin.dashboard.chart.statistik-apm')
    @endif

    @if(request()->tipe_report == 'statistik-supplier')
        @include('admin.dashboard.chart.statistik-supplier')
    @endif
    
    @if(request()->tipe_report == 'statistik-komponen')
        @include('admin.dashboard.chart.statistik-komponen')
    @endif
@endsection