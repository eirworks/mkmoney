<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'stores' => Store::latest('id')->take(5)->withCount('transactions')->get(),
            'users' => User::latest('id')->take(5)->withCount('stores')->get(),
            'menus' => $this->menus(),
        ]);
    }

    private function menus()
    {
        return [
            [
                'name' => "Kelola Pengguna",
                'url' => route('admin::users::index'),
            ],
            [
                'name' => "Kelola Bisnis",
                'url' => route('admin::stores::index'),
            ],
//            [
//                'name' => "Pengaturan",
//                'url' => "#",
//            ],
        ];
    }
}
