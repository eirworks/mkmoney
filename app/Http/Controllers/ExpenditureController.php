<?php

namespace App\Http\Controllers;

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
}
