@extends('layouts.auth_layout')
@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">LCEV 2022 - Forgot Password</h1>
                            </div>
                            @error('errorForgotPassword')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <form class="user" action="{{ route('forgotpassword') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" aria-describedby="email" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button class="btn btn-dark btn-user btn-block" type="submit">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection