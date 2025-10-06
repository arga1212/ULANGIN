@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center text-black">Riwayat Pesanan Saya</h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-6">
            @forelse ($orders as $order)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 overflow-hidden transition-shadow duration-300">
                    {{-- Card Header --}}
                    <div class="p-5 sm:p-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                            <div>
                                <p class="font-bold text-xl text-gray-900">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-sm text-gray-600 mt-1">📅 {{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-block px-4 py-2 text-xs rounded-full font-bold uppercase tracking-wide
                                    @if($order->status == 'waiting') bg-yellow-100 text-yellow-700 border-2 border-yellow-300 @endif
                                    @if($order->status == 'process') bg-blue-100 text-blue-700 border-2 border-blue-300 @endif
                                    @if($order->status == 'dikirim') bg-green-100 text-green-700 border-2 border-green-300 @endif
                                    @if($order->status == 'done') bg-gray-100 text-gray-700 border-2 border-gray-300 @endif
                                    @if($order->status == 'cancelled') bg-red-100 text-red-700 border-2 border-red-300 @endif
                                ">{{ $order->status }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-5 sm:p-6 space-y-5">
                        @if ($order->shipping_receipt)
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                            <p class="font-bold text-blue-900 text-sm mb-1">📦 Nomor Resi Pengiriman</p>
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-blue-800 font-mono font-semibold">{{ $order->shipping_receipt }}</p>
                                <button onclick="copyToClipboard('{{ $order->shipping_receipt }}')" 
                                        class="text-blue-600 hover:text-blue-800 transition-colors" 
                                        title="Salin nomor resi">
                                    <i class="far fa-copy text-lg"></i>
                                </button>
                            </div>
                        </div>
                        @endif
                        
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}" 
                                         class="w-20 h-20 object-cover rounded-lg flex-shrink-0 shadow-sm" 
                                         alt="{{ $item->product->name }}">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-900 truncate">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="inline-block bg-white px-2 py-1 rounded text-xs font-medium mr-2">Size: {{ $item->size }}</span>
                                            <span class="inline-block bg-white px-2 py-1 rounded text-xs font-medium">Qty: {{ $item->quantity }}</span>
                                        </p>
                                        @if ($order->status == 'done')
                                            <div class="mt-2">
                                                @if ($item->rating)
                                                    <p class="text-xs text-green-600 font-semibold inline-flex items-center gap-1">
                                                        <i class="fas fa-check-circle"></i> Ulasan diberikan
                                                    </p>
                                                @else
                                                    <a href="{{ route('ratings.create', $item->id) }}" 
                                                       class="text-xs text-blue-600 hover:text-blue-800 font-bold underline">
                                                        Beri Ulasan
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <p class="font-bold text-gray-900 text-base whitespace-nowrap">
                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="p-5 sm:p-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            {{-- Action Buttons --}}
                            <div class="w-full sm:w-auto">
                                @if ($order->status == 'dikirim')
                                    <form action="{{ route('my-orders.confirm', $order) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" 
                                                class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg text-sm shadow-md hover:shadow-lg transition-all">
                                            <i class="fas fa-check-circle mr-2"></i> Konfirmasi Diterima
                                        </button>
                                    </form>
                                @endif

                                @if ($order->status == 'done')
                                    <a href="{{ route('my-orders.invoice', $order) }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gray-900 hover:bg-black text-white font-bold rounded-lg text-sm shadow-md hover:shadow-lg transition-all">
                                        <i class="fas fa-download mr-2"></i> Unduh Invoice
                                    </a>
                                @endif
                            </div>

                            {{-- Price Summary --}}
                            <div class="w-full sm:w-auto bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                @php $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->price); @endphp
                                @if($order->voucher_code)
                                    <div class="space-y-1 mb-2 pb-2 border-b border-gray-200 text-sm">
                                        <div class="flex justify-between gap-8 text-gray-600">
                                            <span>Subtotal:</span>
                                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between gap-8 text-green-600">
                                            <span class="font-medium">Diskon ({{ $order->voucher_code }}):</span>
                                            <span class="font-bold">-Rp {{ number_format($subtotal - $order->total_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="flex justify-between items-center gap-8">
                                    <span class="text-gray-800 font-bold">Total:</span>
                                    <span class="text-xl font-black text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center bg-white p-16 rounded-xl shadow-lg border border-gray-200">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-receipt text-5xl text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h2>
                    <p class="text-gray-500 mb-8">Semua pesanan Anda akan muncul di sini</p>
                    <a href="{{ route('shop.index') }}" 
                       class="inline-block bg-black text-white font-bold text-base px-8 py-3 rounded-lg shadow-md hover:bg-gray-800 hover:shadow-lg transition-all">
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

{{-- Script --}}
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        const notification = document.createElement('div');
        notification.className = 'fixed bottom-8 right-8 bg-green-600 text-white px-6 py-3 rounded-lg shadow-xl z-50 flex items-center gap-2';
        notification.innerHTML = '<i class="fas fa-check-circle"></i><span class="font-semibold">Nomor resi berhasil disalin!</span>';
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 2500);
    });
}
</script>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection