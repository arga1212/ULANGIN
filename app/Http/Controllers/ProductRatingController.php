<?php
namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    public function create(OrderItem $order_item)
    {
        // Validasi: Pastikan item ini milik user yang login, statusnya 'done', dan belum diulas
        if ($order_item->order->user_id !== Auth::id() || $order_item->order->status !== 'done' || $order_item->rating) {
            abort(403, 'Anda tidak bisa memberikan ulasan untuk item ini.');
        }
        return view('ratings.create', ['orderItem' => $order_item]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $orderItem = OrderItem::with('order')->find($validated['order_item_id']);

        // Validasi ulang untuk keamanan
        if ($orderItem->order->user_id !== Auth::id() || $orderItem->order->status !== 'done' || $orderItem->rating) {
            return redirect()->route('my-orders.index')->with('error', 'Gagal menyimpan ulasan.');
        }

        ProductRating::create([
            'user_id' => Auth::id(),
            'product_id' => $orderItem->product_id,
            'order_item_id' => $orderItem->id,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        return redirect()->route('my-orders.index')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}