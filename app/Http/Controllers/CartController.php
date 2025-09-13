<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::find($validated['variant_id']);
        $quantity = $validated['quantity'];

        if ($variant->product_id !== $product->id) {
            return redirect()->back()->with('error', 'Varian tidak valid.');
        }

        $cart = session()->get('cart', []);
        $cartKey = $variant->id;

        // Cek stok
        $currentQty = $cart[$cartKey]['quantity'] ?? 0;
        $newQty = $currentQty + $quantity;

        if ($variant->stock < $newQty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi. Sisa: ' . $variant->stock);
        }

        // Tambahkan ke cart
        $cart[$cartKey] = [
            "product_name" => $product->name,
            "variant_id" => $variant->id,
            "size" => $variant->size,
            "quantity" => $newQty,
            "price" => $product->price,
            "image" => $product->image
        ];
        
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function remove($variantId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$variantId]);
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    // HANYA ini yang diperlukan untuk update quantity
    public function updateAndCheckout(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $cart = session()->get('cart', []);
        $errors = [];

        foreach ($quantities as $variantId => $quantity) {
            if (isset($cart[$variantId])) {
                $quantity = max(1, (int)$quantity); // minimal 1
                
                // Cek stok
                $variant = ProductVariant::find($variantId);
                if (!$variant) {
                    unset($cart[$variantId]);
                    $errors[] = "Produk {$cart[$variantId]['product_name']} sudah tidak tersedia.";
                    continue;
                }

                if ($variant->stock < $quantity) {
                    $cart[$variantId]['quantity'] = $variant->stock;
                    $errors[] = "Stok {$cart[$variantId]['product_name']} tidak mencukupi. Disesuaikan menjadi {$variant->stock}.";
                } else {
                    $cart[$variantId]['quantity'] = $quantity;
                }
            }
        }

        session()->put('cart', $cart);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        if (!empty($errors)) {
            return redirect()->route('cart.index')->with('error', implode(' ', $errors));
        }

        return redirect()->route('checkout.create');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }
}