<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index(Request $request, Store $store)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $startingBalance = $store->transactions()
            ->whereDate('created_at', '<', now()->month($month)->year($year)->startOfMonth())
            ->sum('amount');

        $transactions = $store->transactions()
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        return view('journal.index', [
            'transactions' => $transactions,
            'store' => $store,
            'month' => $month,
            'year' => $year,
            'starting_balance' => $startingBalance,
        ]);
    }
}
