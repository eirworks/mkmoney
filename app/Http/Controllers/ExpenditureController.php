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
}
