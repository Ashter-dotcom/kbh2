@extends('layouts.admin_layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Update Profile</h1>
    @include('component.alert')
    <form action="{{ route('profileupdate', ['user_id' => encrypt_decrypt($user->id)]) }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                <label for="nmae">Name</label>
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Nama" value="{{ old('name',$user->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Email" value="{{ old('email',$user->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 col-xs-12 col-sm-12 col-lg-4">
                <label for="status">Status</label>
                <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                <label for="nmae">Password (Leave blank if not change)</label>
                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 col-xs-12 col-sm-12 col-lg-6">
                <label for="nmae">Confirmation Password</label>
                <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" placeholder="Confimation Password">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection