<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // <-- 1. IMPORT MODEL CATEGORY
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Muat relasi varian DAN kategori untuk efisiensi
        $products = Product::with('variants', 'category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // --- 2. KIRIM DATA KATEGORI KE VIEW ---
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedProduct = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            // --- 3. UBAH VALIDASI CATEGORY MENJADI CATEGORY_ID ---
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480'
        ]);
        
        $request->validate([
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validatedProduct['image'] = $request->file('image')->store('products', 'public');
        }

        DB::transaction(function () use ($validatedProduct, $request) {
            $product = Product::create($validatedProduct);

            foreach ($request->variants as $variantData) {
                if (!empty($variantData['size']) && isset($variantData['stock'])) {
                    $product->variants()->create($variantData);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // --- 4. KIRIM DATA KATEGORI KE VIEW EDIT ---
        $categories = Category::all();
        $product->load('variants');
        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedProduct = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            // --- 5. UBAH VALIDASI CATEGORY MENJADI CATEGORY_ID ---
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480'
        ]);

        $request->validate([
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) { Storage::disk('public')->delete($product->image); }
            $validatedProduct['image'] = $request->file('image')->store('products', 'public');
        }

        DB::transaction(function () use ($request, $product, $validatedProduct) {
            $product->update($validatedProduct);
            
            $variantIdsToKeep = [];
            foreach ($request->variants as $variantData) {
                if (!empty($variantData['size']) && isset($variantData['stock'])) {
                    $variant = $product->variants()->updateOrCreate(
                        ['id' => $variantData['id'] ?? null],
                        ['size' => $variantData['size'], 'stock' => $variantData['stock']]
                    );
                    $variantIdsToKeep[] = $variant->id;
                }
            }
            $product->variants()->whereNotIn('id', $variantIdsToKeep)->delete();
        });

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}