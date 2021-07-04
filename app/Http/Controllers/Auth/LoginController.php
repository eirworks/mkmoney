<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $login = auth()->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($login) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('danger', "Email atau kata sandi salah");
        }

    }

    public function forgotPassword()
    {
        return view('auth.forgot_password', [
            'settings' => setting()->all(),
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
