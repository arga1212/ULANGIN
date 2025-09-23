<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
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
        $products = Product::with('variants', 'category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Diubah dari 'image' dan sekarang 'required'
        ]);
        
        $request->validate([
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.stock' => 'required|integer|min:0',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi untuk galeri
        ]);

        DB::transaction(function () use ($request, $validatedProduct) {
            // Simpan thumbnail
            if ($request->hasFile('thumbnail')) {
                $validatedProduct['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
            }
            $product = Product::create($validatedProduct);

            // Simpan gambar galeri
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }

            // Simpan varian
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
        $categories = Category::all();
        // Muat semua relasi yang dibutuhkan oleh form
        $product->load('variants', 'images');
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
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Diubah dari 'image'
        ]);

        $request->validate([
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.stock' => 'required|integer|min:0',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        DB::transaction(function () use ($request, $product, $validatedProduct) {
            // Update thumbnail jika ada yang baru
            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama
                if ($product->thumbnail) { Storage::disk('public')->delete($product->thumbnail); }
                $validatedProduct['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
            }
            
            // Tambahkan gambar galeri baru
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }
            
            $product->update($validatedProduct);
            
            // Logika update varian tidak berubah
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
        // Hapus thumbnail
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        // Hapus semua gambar galeri
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}