<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest('id')
            ->withCount('stores')
            ->paginate();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function show(User $user)
    {
        $user->loadCount('stores');
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function resetPassword(User $user)
    {
        $user->password = Hash::make("123456");
        $user->save();

        return redirect()->route('admin::users::show', [$user])
            ->with('success', "Kata sandi pengguna telah direset!");
    }
}
