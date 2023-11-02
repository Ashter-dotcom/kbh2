@extends('layouts.admin_layout')
@section('content')
    
    <!-- Page Heading -->
    @include('component.alert')
    @include('admin.production_form.component.navigation', ['title' => $data['title'], 'breadcrumb' => $data['breadcrumb']])
    @include('admin.production_form.supplier.form', ['components' => $data['components'], 'lists' => $data['lists']])
@endsection