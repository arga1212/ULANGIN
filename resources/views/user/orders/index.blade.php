@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center text-black">Riwayat Pesanan Saya</h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-6">
            @forelse ($orders as $order)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    {{-- Card Header --}}
                    <div class="p-4 sm:p-6 bg-gray-50 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2">
                            <div>
                                <p class="font-bold text-lg text-gray-800">Order #{{ $order->id }}</p>
                                <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="px-3 py-1 text-xs rounded-full font-semibold
                                    @if($order->status == 'waiting') bg-yellow-100 text-yellow-800 border border-yellow-200 @endif
                                    @if($order->status == 'process') bg-blue-100 text-blue-800 border border-blue-200 @endif
                                    @if($order->status == 'dikirim') bg-green-100 text-green-800 border border-green-200 @endif
                                    @if($order->status == 'done') bg-gray-100 text-gray-600 border border-gray-200 @endif
                                ">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-4 sm:p-6 space-y-4">
                        @if ($order->shipping_receipt)
                        <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg text-sm">
                            <p class="font-semibold text-blue-800">Nomor Resi Pengiriman:</p>
                            <p class="text-blue-700 font-mono mt-1">{{ $order->shipping_receipt }}</p>
                        </div>
                        @endif
                        
                        @foreach($order->items as $item)
                            <div class="flex items-start sm:items-center justify-between">
                                <div class="flex items-start sm:items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}" class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500">Ukuran: {{ $item->size }}</p> 
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        @if ($order->status == 'done')
                                            <div class="mt-2">
                                                @if ($item->rating)
                                                    <p class="text-xs text-green-600 font-semibold inline-flex items-center gap-1"><i class="fas fa-check-circle"></i> Ulasan diberikan</p>
                                                @else
                                                    <a href="{{ route('ratings.create', $item->id) }}" class="text-xs text-blue-600 hover:underline font-semibold">Beri Ulasan</a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <p class="font-semibold text-gray-800 text-sm sm:text-base whitespace-nowrap">
                                    Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    {{-- --- CARD FOOTER YANG DIPERBAIKI TOTAL --- --}}
                    <div class="p-4 sm:p-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4">
                            {{-- Kolom Kiri: Tombol Aksi --}}
                            <div class="w-full sm:w-auto text-center sm:text-left">
                                @if ($order->status == 'dikirim')
                                    <form action="{{ route('my-orders.confirm', $order) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg text-sm">
                                            <i class="fas fa-check-circle mr-2"></i> Konfirmasi Diterima
                                        </button>
                                    </form>
                                @endif

                                @if ($order->status == 'done')
                                    <a href="{{ route('my-orders.invoice', $order) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-black text-white font-semibold rounded-lg text-sm">
                                        <i class="fas fa-download mr-2"></i> Unduh Invoice
                                    </a>
                                @endif
                            </div>

                            {{-- Kolom Kanan: Rincian Harga --}}
                            <div class="w-full sm:w-auto text-right space-y-1 text-sm">
                                @php $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->price); @endphp
                                @if($order->voucher_code)
                                    <div class="text-gray-600 flex justify-between sm:justify-end gap-4">
                                        <span>Subtotal:</span>
                                        <span class="font-semibold w-32 text-left">Rp {{ number_format($subtotal) }}</span>
                                    </div>
                                    <div class="text-green-600 flex justify-between sm:justify-end gap-4">
                                        <span>Diskon ({{ $order->voucher_code }}):</span>
                                        <span class="font-semibold w-32 text-left">- Rp {{ number_format($subtotal - $order->total_price) }}</span>
                                    </div>
                                @endif
                                <div class="text-gray-800 font-bold text-base flex justify-between sm:justify-end gap-4">
                                    <span>Total:</span>
                                    <span class="w-32 text-left">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center bg-white p-16 rounded-xl shadow-lg border border-gray-100">
                    <i class="fas fa-receipt text-6xl text-gray-300 mb-4"></i>
                    <p class="text-2xl font-semibold text-gray-700">Anda Belum Memiliki Pesanan</p>
                    <p class="text-gray-500 mt-2">Semua pesanan Anda akan muncul di sini.</p>
                    <a href="{{ route('shop.index') }}" class="mt-8 inline-block bg-black text-white font-semibold text-lg px-8 py-3 rounded-lg shadow-md hover:bg-gray-800 transition-colors duration-300">
                        Mulai Belanja
                    </a>
                </div>
            @endforelse
        </div>
        
        @if($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection