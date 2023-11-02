@extends('layouts.auth_layout')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-end" style="margin-top:0px;margin-right:50px;">
    <div class="col-xl-3 col-lg-3 col-md-6">
        <div class="card o-hidden border-0 my-5" style="background-color: rgb(0 0 0 / 1%);">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12" style="background-color: rgb(0 0 0 / 1%);">
                        <div class="p-5">
                            @error('errorLogin')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <form class="user" action="{{ route('authenticate') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" aria-describedby="email" placeholder="Username">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row justify-content-center">
                                    <button class="btn btn-dark btn-user" type="submit">Login</button>
                                </div>
                            </form>
                            <!-- <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('forgotpassword-form') }}">Forgot Password?</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection