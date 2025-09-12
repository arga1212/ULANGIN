<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant; // Ganti Product menjadi ProductVariant
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('info', 'Keranjang Anda kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $discount = 0;
        $totalPrice = $subtotal;
        $voucher = session()->get('voucher');

        if ($voucher) {
            $discount = ($subtotal * $voucher['discount_percent']) / 100;
            $totalPrice = $subtotal - $discount;
        }

        return view('checkout.create', compact('cart', 'subtotal', 'discount', 'totalPrice', 'voucher'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $details) { $subtotal += $details['price'] * $details['quantity']; }

        $totalPrice = $subtotal;
        $voucherSession = session()->get('voucher');

        if ($voucherSession) {
            $dbVoucher = Voucher::where('id', $voucherSession['id'])->where('is_active', true)->whereNull('used_at')->first();
            if ($dbVoucher) {
                $totalPrice = $subtotal - (($subtotal * $dbVoucher->discount_percent) / 100);
            } else {
                session()->forget('voucher');
                return redirect()->route('checkout.create')->with('error', 'Maaf, voucher yang Anda gunakan sudah tidak valid.');
            }
        }

        DB::transaction(function () use ($request, $cart, $totalPrice, $voucherSession) {
            $paymentProofPath = $request->file('payment_proof')->store('proofs', 'public');

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_price' => $totalPrice,
                'voucher_code' => $voucherSession ? $voucherSession['code'] : null,
                'status' => 'waiting',
                'payment_proof' => $paymentProofPath,
            ]);

            // --- LOGIKA PENYIMPANAN ORDER ITEM YANG DIPERBAIKI ---
            foreach ($cart as $variantId => $details) {
                $variant = ProductVariant::find($variantId);
                if ($variant) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $variant->product_id,
                        'product_variant_id' => $variant->id,
                        'size' => $variant->size,
                        'quantity' => $details['quantity'],
                        'price' => $details['price'],
                    ]);

                    // Kurangi stok dari varian
                    $variant->decrement('stock', $details['quantity']);
                }
            }
            // --- AKHIR PERBAIKAN ---

            if ($voucherSession) {
                $voucherToUpdate = Voucher::find($voucherSession['id']);
                $voucherToUpdate->update(['user_id' => Auth::id(), 'used_at' => now()]);
            }
        });

        session()->forget('cart');
        session()->forget('voucher');

        return redirect()->route('my-orders.index')->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    public function applyVoucher(Request $request)
    {
        $request->validate(['voucher_code' => 'required|string']);
        $voucher = Voucher::where('code', $request->voucher_code)->where('is_active', true)->whereNull('used_at')->first();
        if ($voucher) {
            session()->put('voucher', ['id' => $voucher->id, 'code' => $voucher->code, 'discount_percent' => $voucher->discount_percent]);
            return redirect()->back()->with('success', 'Voucher berhasil digunakan!');
        }
        return redirect()->back()->with('error', 'Voucher tidak valid, sudah digunakan, atau tidak aktif.');
    }

    public function removeVoucher()
    {
        session()->forget('voucher');
        return redirect()->back()->with('success', 'Voucher berhasil dihapus.');
    }

    // --- FUNGSI "BELI SEKARANG" YANG DIPERBAIKI ---
    public function buyNow(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $variant = ProductVariant::with('product')->find($request->variant_id);
        $quantity = $request->quantity;

        if ($variant->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        session()->forget('cart');
        session()->forget('voucher'); // Hapus juga voucher lama

        $cart = [];
        $cart[$variant->id] = [
            "product_name" => $variant->product->name,
            "variant_id" => $variant->id,
            "size" => $variant->size,
            "quantity" => $quantity,
            "price" => $variant->product->price,
            "image" => $variant->product->image
        ];
        
        session()->put('cart', $cart);
        return redirect()->route('checkout.create');
    }
}