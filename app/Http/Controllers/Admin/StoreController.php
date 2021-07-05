<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = Store::latest('id')
            ->when($request->filled('user_id'), function($query) {
                $query->where('user_id', \request()->input('user_id'));
            })
            ->with(['user:id,name'])
            ->paginate();

        return view('admin.stores.index', [
            'stores' => $stores,
        ]);
    }

    public function show(Store $store)
    {
        $store->load(['user:id,name']);
        return view('admin.stores.show', [
            'store' => $store,
        ]);
    }
}
