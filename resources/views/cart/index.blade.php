@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-10 text-center text-gray-800 tracking-tight">
            🛒 Keranjang Belanja
        </h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($cart))
            <form action="{{ route('cart.updateAndCheckout') }}" method="POST">
                @csrf
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <!-- Daftar Item Keranjang -->
                    <div class="lg:w-2/3">
                        <div class="bg-white rounded-2xl shadow-lg p-6 divide-y divide-gray-200">
                            @foreach ($cart as $variantId => $details)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-6 gap-4">
                                    
                                    <!-- Gambar Produk -->
                                    <div class="flex items-center gap-4 flex-1">
                                        <img class="w-20 h-20 object-cover rounded-lg shadow-sm border" 
                                             src="{{ asset('storage/' . $details['image']) }}" 
                                             alt="{{ $details['product_name'] }}">
                                        
                                        <div>
                                            <h3 class="font-semibold text-lg text-gray-800">{{ $details['product_name'] }}</h3>
                                            <p class="text-sm text-gray-500">Ukuran: {{ $details['size'] }}</p>
                                            <p class="text-sm text-gray-600 font-medium">
                                                Rp {{ number_format($details['price']) }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Kontrol jumlah & subtotal -->
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-6 w-full sm:w-auto justify-between">
                                        <div class="flex items-center gap-2">
                                            <label class="text-sm text-gray-600">Jumlah:</label>
                                            @php $variant = \App\Models\ProductVariant::find($variantId); @endphp
                                            <input type="number" 
                                                name="quantities[{{ $variantId }}]" 
                                                value="{{ $details['quantity'] }}" 
                                                min="1" 
                                                max="{{ $variant->stock ?? 999 }}" 
                                                class="w-20 px-3 py-2 border rounded-lg text-center focus:ring-2 focus:ring-black focus:outline-none"
                                                data-price="{{ $details['price'] }}"
                                                onchange="updateSubtotal({{ $variantId }}, this)">
                                        </div>
                                        
                                        <div class="text-right mt-3 sm:mt-0">
                                            <p class="font-bold text-gray-800 text-lg" id="subtotal-{{ $variantId }}">
                                                Rp {{ number_format($details['price'] * $details['quantity']) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Tombol hapus -->
                                    <a href="{{ route('cart.remove', $variantId) }}" 
                                       class="text-red-500 hover:text-red-700 text-sm font-medium transition">
                                        Hapus
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ringkasan & Checkout -->
                    <div class="lg:w-1/3">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                            <h2 class="text-xl font-bold mb-6 text-gray-800">Ringkasan Belanja</h2>
                            
                            @php $totalPrice = 0; @endphp
                            @foreach ($cart as $details) 
                                @php $totalPrice += $details['price'] * $details['quantity']; @endphp 
                            @endforeach
                            
                            <div class="flex justify-between items-center text-2xl font-extrabold mb-8 text-gray-900">
                                <span>Total</span>
                                <span id="total-price">Rp {{ number_format($totalPrice) }}</span>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-black to-gray-800 text-white font-semibold py-3 px-4 rounded-xl shadow-md hover:opacity-90 transition mb-4">
                                Lanjut ke Checkout
                            </button>
                            
                            <a href="{{ route('shop.index') }}" 
                               class="w-full block text-center bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-xl hover:bg-gray-200 transition">
                                Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="text-center py-20">
                <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Keranjang Belanja Kosong</h2>
                    <p class="text-gray-600 mb-8">Anda belum menambahkan produk apapun.</p>
                    <a href="{{ route('shop.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-black text-white font-semibold rounded-xl hover:bg-gray-800 shadow-md transition">
                        Mulai Belanja
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function updateSubtotal(variantId, input) {
    const price = parseFloat(input.dataset.price);
    const quantity = parseInt(input.value) || 0;
    const subtotal = price * quantity;

    // Update subtotal per item
    document.getElementById('subtotal-' + variantId).textContent = 
        'Rp ' + subtotal.toLocaleString('id-ID');

    // Update total semua item
    let grandTotal = 0;
    document.querySelectorAll('input[name^="quantities"]').forEach(input => {
        const qty = parseInt(input.value) || 0;
        const itemPrice = parseFloat(input.dataset.price) || 0;
        grandTotal += qty * itemPrice;
    });

    document.getElementById('total-price').textContent = 
        'Rp ' + grandTotal.toLocaleString('id-ID');
}
</script>
@endsection
