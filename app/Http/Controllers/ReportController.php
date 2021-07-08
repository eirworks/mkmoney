<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Carbon\CarbonPeriod;
use Faker\Generator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use WithFaker;

    public function __construct() {
        $this->setUpFaker();
    }

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

    public function statExpenditure(Store $store, Request $request) {
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
                'color' => $category->color,
            ];
        }

        debug($cats);

        return view('reports.expenditure_stats', [
            'categories' => $cats,
            'store' => $store,
            'month' => $month,
            'year' => $year
        ]);
    }

    public function statIncome(Request $request, Store $store)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $records = $store->incomeRecords()
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        return view('reports.income_stats', [
            'records' => $records,
            'store' => $store,
            'month' => $month,
            'year' => $year
        ]);
    }
}
