@extends('layouts.admin_layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Permission</h1>

    <form action="{{ route('permission.updatepermission', ['permission_id' => encrypt_decrypt($permission->id)]) }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="ro" placeholder="Permission Name" value="{{ old('name', $permission->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Update</button>
    </form>
@endsection