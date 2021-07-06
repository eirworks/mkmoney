<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use WithFaker;

    public function __construct() {
        $this->setUpFaker();
    }

    public function index(Request $request)
    {
        $stores = auth()->user()->stores()->latest('updated_at')->paginate();

        return view('stores.index', [
            'stores' => $stores,
            'max_stores' => User::MAX_STORE,
            'store_count' => auth()->user()->stores()->count()
        ]);
    }

    public function show(Store $store, Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        return view('stores.show', [
            'store' => $store,
            'categories' => $this->statExpenditure($store, $request),
            'records' => $this->statIncome($store, $request),
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function create()
    {
        $store = new Store();

        return view('stores.form', [
            'store' => $store
        ]);
    }

    public function edit(Store $store)
    {

        return view('stores.form', [
            'store' => $store
        ]);
    }

    public function store(Request $request)
    {
        $store = new Store($request->only(['name', 'type']));
        if ($request->hasFile('image')) {
            $store->image = $request->file('image')->store('stores/logo');
        } else {
            $store->image = "";
        }
        $store->user_id = auth()->id();
        $store->settings = [];
        $store->save();

        return redirect()->route('stores::show', [
            $store,
        ]);
    }

    public function update(Request $request, Store $store)
    {
        $store->fill($request->only(['name', 'type']));
        if ($request->hasFile('image')) {
            $store->image = $request->file('image')->store('stores/logo');
        } else {
            $store->image = "";
        }
        $store->save();

        return redirect()->route('stores::show', [
            $store,
        ]);
    }

    public function setDefaultStore(Store $store)
    {
        auth()->user()->store_id = $store->id;
        auth()->user()->save();

        return redirect()->route('stores::index')
            ->with('success', $store->name." telah dijadikan bisnis utama.");
    }

    private function statExpenditure(Store $store, Request $request) {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $categories = $store->categories()->get();
        $cats = [];

        foreach($categories as $category)
        {
            $cats[] = [
                'sum' => $category->transactions()
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->sum('amount'),
                'category' => $category,
                'color' => $this->faker->rgbCssColor,
            ];
        }

        return $cats;
    }

    private function statIncome(Store $store, Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $records = $store->incomeRecords()
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        return $records;
    }
}
