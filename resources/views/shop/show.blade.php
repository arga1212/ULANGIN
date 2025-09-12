@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-black transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Toko</span>
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2" x-data="{ 
                    selectedVariantId: null, 
                    selectedStock: null, 
                    quantity: 1,
                    validateQuantity() {
                        if (isNaN(this.quantity) || this.quantity < 1) { this.quantity = 1; }
                        if (this.selectedStock !== null && this.quantity > this.selectedStock) { this.quantity = this.selectedStock; }
                    }
                }">
                <!-- Kolom Gambar -->
                <div class="p-4 sm:p-6">
                    <div class="aspect-w-1 aspect-h-1">
                        <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                </div>

                <!-- Kolom Detail & Aksi -->
                <div class="p-6 sm:p-8 flex flex-col">
                    <h1 class="text-3xl lg:text-4xl font-bold text-black leading-tight">{{ $product->name }}</h1>
                    
                    <!-- Info Kategori & Stok -->
                    <div class="flex items-center flex-wrap gap-x-4 gap-y-2 mt-3 text-sm">
                        <div class="text-gray-600 font-medium">
                            <span>Kategori: {{ $product->category->name ?? 'N/A' }}</span>
                        </div>
                        <span class="text-gray-300 hidden sm:block">|</span>
                        <div class="text-gray-600 font-medium">
                            {{-- Menggunakan total_stock dari semua varian --}}
                            <span>Total Stok: {{ $product->total_stock }}</span>
                        </div>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="mt-6 pt-6 border-t">
                        <h2 class="font-semibold text-lg mb-2 text-gray-800">Deskripsi Produk</h2>
                        <p class="text-gray-600 text-base leading-relaxed whitespace-pre-wrap">{{ $product->description }}</p>
                    </div>

                    <!-- Bagian Aksi (INTEGRASI DENGAN SISTEM VARIAN) -->
                    <div class="mt-auto pt-8">
                        {{-- Form sekarang membungkus semua aksi --}}
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <input type="hidden" name="variant_id" x-model="selectedVariantId">

                            <!-- Pilihan Ukuran -->
                            <div class="mb-4">
                                <h3 class="font-semibold text-gray-800 mb-2">Pilih Ukuran:</h3>
                                @if ($product->variants->where('stock', '>', 0)->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($product->variants as $variant)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="variant_selector" value="{{ $variant->id }}" 
                                                       x-model="selectedVariantId" 
                                                       @change="selectedStock = {{ $variant->stock }}; quantity = 1"
                                                       class="sr-only peer"
                                                       {{ $variant->stock < 1 ? 'disabled' : '' }}>
                                                <div class="px-4 py-2 border rounded-md peer-checked:bg-black peer-checked:text-white peer-checked:border-black peer-disabled:bg-gray-100 peer-disabled:text-gray-400 peer-disabled:cursor-not-allowed hover:border-black transition-colors">
                                                    {{ $variant->size }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="text-xs text-gray-500 mt-2" x-show="selectedVariantId" x-cloak>Stok tersedia: <span x-text="selectedStock"></span></div>
                                @else
                                    <p class="text-red-500">Stok habis untuk semua ukuran.</p>
                                @endif
                            </div>
                            
                            <!-- Input Jumlah -->
                            <div class="flex items-center mb-6" x-show="selectedVariantId && selectedStock > 0" x-cloak>
                                <label for="quantity" class="font-semibold mr-4 text-gray-800">Jumlah:</label>
                                <input type="number" id="quantity" name="quantity" x-model.number="quantity" @input="validateQuantity()" min="1" :max="selectedStock" class="w-20 border-gray-300 rounded-md text-center">
                            </div>

                            <!-- Harga -->
                            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-700">Harga:</span>
                                    <p class="text-3xl font-bold text-black">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="space-y-4">
                                <button type="submit" 
                                       :disabled="!selectedVariantId || selectedStock < 1 || quantity < 1"
                                       class="w-full bg-black text-white font-semibold py-3 px-4 rounded-md hover:bg-gray-800 transition-colors shadow-sm flex items-center justify-center gap-2 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    <i class="fas fa-shopping-cart text-sm"></i>
                                    <span x-show="!selectedVariantId">Pilih Ukuran</span>
                                    <span x-show="selectedVariantId && selectedStock > 0">Tambah ke Keranjang</span>
                                    <span x-show="selectedVariantId && selectedStock < 1">Stok Habis</span>
                                </button>
                                
                                <button type="submit" 
                                       formaction="{{ route('checkout.buyNow') }}"
                                       :disabled="!selectedVariantId || selectedStock < 1 || quantity < 1"
                                       class="w-full bg-white border border-gray-300 text-black font-semibold py-3 px-4 rounded-md hover:bg-gray-100 transition-colors shadow-sm flex items-center justify-center gap-2 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    <i class="fas fa-bolt text-sm"></i>
                                    <span>Beli Sekarang</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection