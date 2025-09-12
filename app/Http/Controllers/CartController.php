<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Menambahkan item ke keranjang.
     */
    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::find($validated['variant_id']);
        $quantity = $validated['quantity'];

        if ($variant->product_id !== $product->id) {
            return redirect()->back()->with('error', 'Varian tidak valid untuk produk ini.');
        }

        $cart = session()->get('cart', []);
        $cartKey = $variant->id;

        $currentQuantityInCart = $cart[$cartKey]['quantity'] ?? 0;
        $newTotalQuantity = $currentQuantityInCart + $quantity;

        if ($variant->stock < $newTotalQuantity) {
            return redirect()->back()->with('error', 'Stok untuk ukuran ini tidak mencukupi. Sisa stok: ' . $variant->stock);
        }

        $cart[$cartKey] = [
            "product_name" => $product->name,
            "variant_id" => $variant->id,
            "size" => $variant->size,
            "quantity" => $newTotalQuantity,
            "price" => $product->price,
            "image" => $product->image
        ];
        
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function remove($variantId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            session()->put('cart', $cart);
            // Ubah link hapus di view menjadi tombol form dengan method POST jika ingin lebih aman,
            // tapi untuk sekarang link GET tidak masalah.
            return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
        }
        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    /**
     * Mengupdate semua jumlah di keranjang lalu redirect ke checkout.
     * Ini menggantikan fungsi update() yang lama.
     */
    public function updateAndCheckout(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $cart = session()->get('cart', []);
        $errorMessages = [];

        foreach ($quantities as $variantId => $quantity) {
            if (isset($cart[$variantId])) {
                // Pastikan kuantitas valid (minimal 1)
                $quantity = max(1, (int)$quantity);

                $variant = ProductVariant::find($variantId);
                // Cek stok
                if ($variant && $variant->stock < $quantity) {
                    $originalQuantity = $cart[$variantId]['quantity'];
                    // Batasi ke jumlah stok maksimum
                    $cart[$variantId]['quantity'] = $variant->stock;
                    // Kumpulkan pesan error untuk ditampilkan
                    $errorMessages[] = 'Stok untuk ' . $cart[$variantId]['product_name'] . ' (Ukuran: ' . $cart[$variantId]['size'] . ') tidak mencukupi, jumlah disesuaikan dari ' . $originalQuantity . ' menjadi ' . $variant->stock . '.';
                } else {
                     // Update jumlah di keranjang jika stok aman
                    $cart[$variantId]['quantity'] = $quantity;
                }
            }
        }

        // Simpan keranjang yang sudah di-update ke session
        session()->put('cart', $cart);

        // Jika ada pesan error, redirect kembali ke keranjang untuk menampilkannya
        if (!empty($errorMessages)) {
            return redirect()->route('cart.index')->with('error', implode("\n", $errorMessages));
        }

        // Jika semua aman, arahkan ke halaman checkout
        return redirect()->route('checkout.create');
    }
}