<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.form', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $user->fill($request->only(['name', 'email']));
        if ($request->filled('password'))
        {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('profile::edit')
            ->with('success', "Profil anda telah disimpan");
    }
}
