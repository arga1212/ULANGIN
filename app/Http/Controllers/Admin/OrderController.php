<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // Ambil semua pesanan, urutkan dari yang paling baru
        $orders = Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // Eager load relasi 'items' dan 'product' untuk setiap item
        // Ini lebih efisien daripada query berulang di view
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengupdate status pesanan.
     */
    public function update(Request $request, Order $order)
    {
          $validated = $request->validate([
        'status' => 'required|in:waiting,process,dikirim,done',
        'shipping_receipt' => 'nullable|string|max:255', // Tambahkan validasi resi
    ]);

    $order->update($validated);

    return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
}
}