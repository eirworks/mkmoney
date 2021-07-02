<?php

namespace App\Http\Controllers;

use App\Models\IncomeRecord;
use App\Models\Store;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request, Store $store) {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $records = $store->incomeRecords()->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        return view('income_records.index', [
            'records' => $records,
            'month' => $month,
            'year' => $year,
        ]);
    }
}
