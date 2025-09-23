<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Menampilkan halaman daftar produk dengan filter.
     */
    public function index(Request $request)
    {
        $allCategories = Category::all();
        $categoryName = null;

        $productsQuery = Product::with('variants', 'category');

        if ($request->filled('search')) {
            $productsQuery->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $productsQuery->where('category_id', $request->category_id);
            $category = Category::find($request->category_id);
            if ($category) {
                $categoryName = $category->name;
            }
        }

        $products = $productsQuery->latest()->paginate(12);

        return view('shop.index', compact('products', 'allCategories', 'categoryName'));
    }

    /**
     * Menampilkan halaman detail untuk satu produk.
     * --- METHOD YANG HILANG ADA DI SINI ---
     */
    public function show(Product $product)
    {
        // Muat relasi varian dan kategori agar bisa diakses di view
        $product->load('variants', 'category', 'ratings.user', 'images');
        
        return view('shop.show', compact('product'));
    }
}