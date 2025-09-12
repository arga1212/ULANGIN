<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Ambil 5 produk terbaru sebagai produk unggulan/favorit
        $featuredProducts = Product::with('category', 'variants')->latest()->take(5)->get();
        
        // Kirim kedua variabel ke view 'home'
        return view('home', compact('categories', 'featuredProducts'));
    }
}