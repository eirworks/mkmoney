<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index(Request $request, Store $store)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $types = [
            'cash' => "Kas",
            'income' => "Pendapatan",
            'costs' => "Biaya",
        ];
        return view('ledger.index', [
            'types' => $types,
            'store' => $store,
            'month' => $month,
            'year' => $year,
        ]);
    }
}
