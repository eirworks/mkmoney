<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = auth()->user()->stores()->latest('updated_at')->paginate();

        return view('stores.index', [
            'stores' => $stores,
            'max_stores' => User::MAX_STORE,
            'store_count' => auth()->user()->stores()->count()
        ]);
    }

    public function show(Store $store)
    {
        $transactions = $store->transactions()
            ->limit(25)->latest('id')->get();

        return view('stores.show', [
            'store' => $store,
            'transactions' => $transactions,
        ]);
    }

    public function setDefaultStore(Store $store)
    {
        auth()->user()->store_id = $store->id;
        auth()->user()->save();

        return redirect()->route('stores::index')
            ->with('success', $store->name." telah dijadikan bisnis utama.");
    }
}
