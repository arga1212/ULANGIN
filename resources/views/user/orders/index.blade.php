@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Pesanan Saya</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            @forelse ($orders as $order)
                <div class="border-b last:border-b-0 mb-6 pb-6 last:mb-0 last:pb-0">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4">
                        <div>
                            <p class="font-bold text-lg">Order #{{ $order->id }}</p>
                            <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="mt-2 sm:mt-0">
                            <span class="font-semibold text-lg">Status:</span>
                            <span class="px-3 py-1 text-sm rounded-full font-semibold
                                @if($order->status == 'waiting') bg-yellow-200 text-yellow-800 @endif
                                @if($order->status == 'process') bg-blue-200 text-blue-800 @endif
                                @if($order->status == 'dikirim') bg-green-200 text-green-800 @endif
                                @if($order->status == 'done') bg-gray-300 text-gray-800 @endif
                            ">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    {{-- --- BLOK NOMOR RESI (SUDAH BENAR) --- --}}
                    @if (($order->status == 'dikirim' || $order->status == 'done') && $order->shipping_receipt)
                    <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg mb-4 text-sm">
                        <p class="font-semibold text-blue-800">Nomor Resi Pengiriman:</p>
                        <p class="text-blue-700 font-mono">{{ $order->shipping_receipt }}</p>
                    </div>
                    @endif
                    
                    <!-- Daftar Produk dalam Pesanan -->
                    <div class="space-y-4 mb-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-16 h-16 object-cover rounded mr-4">
                                    <div>
                                        <p class="font-semibold">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- --- BAGIAN TOTAL YANG DISEMPURNAKAN --- --}}
                    <div class="text-right border-t pt-4">
                        @php $subtotal = $order->items->sum(function($item) { return $item->quantity * $item->price; }); @endphp
                        
                        @if($order->voucher_code)
                            <div class="text-gray-600">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($subtotal) }}</span>
                            </div>
                            <div class="text-green-600">
                                <span>Diskon ({{ $order->voucher_code }}):</span>
                                <span>- Rp {{ number_format($subtotal - $order->total_price) }}</span>
                            </div>
                        @endif

                        <p class="font-bold text-xl mt-1">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-10">
                    <p class="text-xl">Anda belum memiliki riwayat pesanan.</p>
                    <a href="{{ route('shop.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Mulai Belanja
                    </a>
                </div>
            @endforelse
        </div>
        
        @if($orders->hasPages())
        <div class="p-6 bg-gray-50 border-t">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection