<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessIncomeCSV;
use App\Models\IncomeRecord;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request, Store $store) {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $records = $store->incomeRecords()->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->with(['user'])
            ->get();

        return view('income_records.index', [
            'store' => $store,
            'records' => $records,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function createCsv(Request $request, Store $store)
    {
        return view('income_records.upload', [
            'store' => $store,
        ]);
    }

    public function storeCsv(Request $request, Store $store)
    {
        if ($request->hasFile('csv')) {
            if ($request->file('csv')->isValid()) {
                $filepath = $request->file('csv')->store('csv');

                ProcessIncomeCSV::dispatch($filepath, $store, auth()->id());
            }
        }

        return redirect()->route('stores::income::index', [$store])
            ->with('success', "CSV dalam proses");
    }
}
