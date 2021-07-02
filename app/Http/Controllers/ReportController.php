<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function incomeStatement(Store $store, Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $categories = $store->categories()->get();
        $cats = [];
        foreach($categories as $category)
        {
            $cats[] = [
                'category' => $category,
                'sum' => $category->transactions()
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->sum('amount'),
            ];
        }

        $incomeSum = $store->incomeRecords()
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('amount');

        $total = $incomeSum - collect($cats)->sum('sum');

        return view('reports.income_statement', [
            'store' => $store,
            'categories' => $cats,
            'income' => $incomeSum,
            'total' => $total,
        ]);
    }
}
