@extends('layouts.admin_layout')
@section('content')
    <!-- Page Heading -->
    @include('admin.production_form.component.navigation', ['title' => $data['title'], 'breadcrumb' => $data['breadcrumb']])
@endsection

@push('scripts')
    <script>
        window.location.href = $('.model').data('url')
    </script>
@endpush