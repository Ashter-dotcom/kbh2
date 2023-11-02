<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth/login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $email = filter($request->email);
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            return redirect()->intended('admin/report/overview');
        } 

        return redirect()->route('login')->withErrors(['errorLogin' => 'Invalid Username or Password']);
    }


    public function forgot_password_form()
    {
        return view('auth/forgot_password');
    }

    public function forgot_password(ResetPasswordRequest $request)
    {
        $checkIfEmailIsExist = User::where('email', $request->email)->first();

        if($checkIfEmailIsExist) {


            $token = Str::random(64);


            $status = Password::sendResetLink($request->only('email'));
        
            return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
        }
        return redirect()->route('forgotpassword')->withErrors(['errorForgotPassword' => 'Email doesn\'t exist on our system']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

