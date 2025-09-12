<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan milik user yang sedang login
        // Urutkan dari yang paling baru
        $orders = Order::where('user_id', auth()->id())
                        ->with('items.product') // Eager load relasi untuk efisiensi
                        ->latest()
                        ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }
}