<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = new User($request->only(['name', 'email']));
        $user->password = Hash::make($request->input('password'));
        $user->role = User::ROLE_USER;
        $user->save();

        auth()->login($user);

        return redirect()->route('dashboard')
            ->with('success', "Selamat datang, ".$user->name);
    }
}
