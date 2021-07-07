<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessExpenditureCSV;
use App\Models\Store;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    public function index(Store $store)
    {
        return view('expenditure.index', [
            'store' => $store,
        ]);
    }

    public function createCsv(Store $store)
    {
        return view('expenditures.upload', [
            'store' => $store
        ]);
    }

    public function storeCsv(Request $request, Store $store)
    {
        if ($request->hasFile('csv'))
        {
            $file = $request->file('csv');

            if ($file->isValid())
            {
                $filepath = $request->file('csv')->store('csv');

                ProcessExpenditureCSV::dispatch($filepath, $store);
            }
        }

        return redirect()->route('stores::expenditures::createCsv', [$store])
            ->with('success', "Transaksi pengeluaran sedang diproses!");
    }

    public function deleteTransactions(Store $store)
    {
        return view('expenditures.delete', [
            'store' => $store,
        ]);
    }

    public function destroyTransactions(Store $store, Request $request)
    {
        $store->transactions()
            ->when($request->input('period') == 'current_month', function($q) {
                \Debugbar::debug("delete current month");
                $q->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            })
            ->when($request->input('period') == 'selected_month', function($q) use($request) {
                \Debugbar::debug("delete selected month");
                \Debugbar::debug($request->only(['month', 'year']));
                $q->whereMonth('created_at', $request->input('month'))
                    ->whereYear('created_at', $request->input('year'));
            })
            ->delete();

        return redirect()->route('stores::show', [$store])
            ->with('success', "Transaksi telah dihapus");
    }
}
