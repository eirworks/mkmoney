<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = auth()->user()->stores()->latest('updated_at')->paginate();

        return view('stores.index', [
            'stores' => $stores,
        ]);
    }
}
