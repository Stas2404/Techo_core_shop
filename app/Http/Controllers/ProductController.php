<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('Name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('Price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('Price', '<=', $request->max_price);
        }
        if ($request->filled('brands')) {
            $query->whereIn('Brand_id', $request->brands);
        }
        if ($request->filled('categories')) {
            $query->whereIn('Category_id', $request->categories);
        }

        if ($request->filled('specs')) {
            foreach ($request->input('specs') as $specName => $specValues) {
                $query->whereHas('specifications', function ($q) use ($specName, $specValues) {
                    $q->where('Name', $specName)
                      ->whereIn('Value', $specValues);
                });
            }
        }

        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('Price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('Price', 'desc');
            } elseif ($request->sort == 'newest') {
                $query->orderBy('Item_id', 'desc');
            }
        }

        $tempQuery = clone $query;
        $foundIds = $tempQuery->pluck('Item_id');

        $availableSpecs = \App\Models\Specification::whereIn('Item_id', $foundIds)
            ->select('Name', 'Value')
            ->distinct()
            ->orderBy('Value', 'asc')
            ->get()
            ->groupBy('Name');

        $products = $query->get();
        $brands = Brand::all();
        $categories = Category::all();

        return view('shop', compact('products', 'brands', 'categories', 'availableSpecs'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_show', ['product' => $product]);
    }

    public function home()
    {
        $popularProducts = Product::inRandomOrder()->take(4)->get();

        return view('home', compact('popularProducts'));
    }
}