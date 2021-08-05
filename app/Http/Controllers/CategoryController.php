<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Store $store, Request $request)
    {
        $categories = $store->categories()->latest('id')
            ->with(['parent'])
            ->when($request->filled('type'), function($q) use($request) {
                $q->where('is_expenditure', $request->input('type') == 'expenditure');
            })
            ->paginate(25);

        return view('categories.index', [
            'categories' => $categories,
            'store' => $store,
        ]);
    }

    public function show(Store $store, Category $category)
    {
        $category->loadCount(['transactions']);

        return view('categories.show', [
            'store' => $store,
            'category' => $category,
        ]);
    }

    public function create(Store $store, Request $request)
    {
        $category = new Category();
        $parentCategories = $store->categories()
            ->onlyParent()
            ->where('is_expenditure', $request->input('type') == 'expenditure')
            ->get();

        return view('categories.form', [
            'store' => $store,
            'category' => $category,
            'parent_categories' => $parentCategories,
        ]);
    }


    public function edit(Store $store, Category $category)
    {
        return view('categories.form', [
            'store' => $store,
            'category' => $category,
        ]);
    }

    public function store(Request $request, Store $store)
    {
        $category = new Category($request->only(['name', 'description', 'color', 'parent_id']));
        $category->store_id = $store->id;
        $category->save();

        return redirect()->route('stores::categories::show', [$store, $category]);
    }

    public function update(Request $request, Store $store, Category $category)
    {
        $category->fill($request->only(['name', 'description', 'color', 'parent_id']));
        $category->save();

        return redirect()->route('stores::categories::show', [$store, $category]);
    }

    public function destroy(Store $store, Category $category)
    {
        $category->loadCount('transactions');
        $otherCategories = $store->categories()->where('id', '<>', $category->id)
            ->get();
        return view('categories.delete', [
            'store' => $store,
            'category' => $category,
            'other_categories' => $otherCategories,
        ]);
    }

    public function confirmDestroy(Request $request, Store $store, Category $category)
    {
        if ($request->input('delete_effect') == 'move_transactions') {
            $category->transactions()->update(['category_id' => $request->input('category_target')]);
        }
        else {
            $category->transactions()->delete();
        }
        $category->delete();

        return redirect()->route('stores::categories::index', [$store])
            ->with('success', "Kategori telah dihapus");
    }
}
