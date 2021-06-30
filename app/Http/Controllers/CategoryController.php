<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Store $store)
    {
        $categories = $store->categories()->latest('id')->paginate(25);

        return view('categories.index', [
            'categories' => $categories,
            'store' => $store,
        ]);
    }
}
