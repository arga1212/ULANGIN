<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
       $orders = Order::where('user_id', auth()->id())
                    ->with('items.product') // <-- TAMBAHKAN EAGER LOADING INI
                    ->latest()
                    ->paginate(10);

    return view('user.orders.index', compact('orders'));
    }

    public function confirm(Order $order)
{
    // Pastikan user hanya bisa mengkonfirmasi pesanannya sendiri
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }
    // Pastikan hanya pesanan 'dikirim' yang bisa dikonfirmasi
    if ($order->status !== 'dikirim') {
        return redirect()->back()->with('error', 'Pesanan ini tidak bisa dikonfirmasi.');
    }
    
    $order->update(['status' => 'done']);
    
    return redirect()->route('my-orders.index')->with('success', 'Terima kasih telah mengkonfirmasi pesanan Anda!');
}

public function downloadInvoice(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }
    
    // Buat nama file invoice, contoh: INVOICE-INV008.pdf
    $filename = 'INVOICE-INV' . str_pad($order->id, 3, '0', STR_PAD_LEFT) . '.pdf';

    // Load view, kirim data, dan generate PDF
    $pdf = PDF::loadView('invoices.template', compact('order'));

    // Unduh PDF-nya
    return $pdf->download($filename);
}

}