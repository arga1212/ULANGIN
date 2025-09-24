@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Back Navigation -->
    <div class="border-b border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-black transition-colors text-sm font-medium">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Main Product Section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            
            <!-- Product Images -->
            <div class="space-y-4" x-data="{ mainImage: '{{ asset('storage/' . $product->thumbnail) }}' }">
                <!-- Main Image -->
                <div class="aspect-square bg-gray-50 rounded-2xl overflow-hidden">
                    <img :src="mainImage" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transition-all duration-300">
                </div>

                <!-- Image Thumbnails -->
                <div class="grid grid-cols-5 gap-3">
                    <!-- Main thumbnail -->
                    <button @click="mainImage = '{{ asset('storage/' . $product->thumbnail) }}'" 
                            class="aspect-square rounded-xl overflow-hidden border-2 transition-all duration-200"
                            :class="mainImage === '{{ asset('storage/' . $product->thumbnail) }}' ? 'border-black' : 'border-gray-200 hover:border-gray-400'">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                             class="w-full h-full object-cover">
                    </button>
                    
                    <!-- Gallery thumbnails -->
                    @foreach ($product->images as $image)
                    <button @click="mainImage = '{{ asset('storage/' . $image->path) }}'" 
                            class="aspect-square rounded-xl overflow-hidden border-2 transition-all duration-200"
                            :class="mainImage === '{{ asset('storage/' . $image->path) }}' ? 'border-black' : 'border-gray-200 hover:border-gray-400'">
                        <img src="{{ asset('storage/' . $image->path) }}" 
                             class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <!-- Category & Title -->
                <div class="space-y-3">
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full">
                        {{ $product->category->name ?? 'N/A' }}
                    </span>
                    <h1 class="text-3xl lg:text-4xl font-bold text-black leading-tight">
                        {{ $product->name }}
                    </h1>
                    <p class="text-2xl lg:text-3xl font-bold text-black">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Description -->
                <div class="space-y-3 py-6 border-t border-gray-100">
                    <h2 class="font-semibold text-lg text-black">Deskripsi Produk</h2>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-wrap">
                        {{ $product->description }}
                    </div>
                </div>

                <!-- Product Actions -->
                <div class="pt-6 border-t border-gray-100">
                    @php
                        $isPortfolio = ($product->category && $product->category->slug === 'custom-personal-order');
                    @endphp

                    @if ($isPortfolio)
                        <!-- Portfolio/Custom Product -->
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-gray-500 mt-0.5"></i>
                                <div>
                                    <p class="text-gray-700 font-medium mb-1">Produk Custom</p>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        Ini adalah contoh produk custom. Tertarik? 
                                        <a href="https://wa.me/6285136844527?text=Halo%20kak%20saya%20mau%20tanya%20tentang%20produk%20{{ $product->name }}" 
                                           class="font-semibold text-black hover:underline">Hubungi kami!</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Regular Product -->
                        <div x-data="{ 
                                selectedVariantId: null, 
                                selectedStock: null, 
                                quantity: 1,
                                validateQuantity() {
                                    if (isNaN(this.quantity) || this.quantity < 1) { this.quantity = 1; }
                                    if (this.selectedStock !== null && this.quantity > this.selectedStock) { this.quantity = this.selectedStock; }
                                }
                            }" class="space-y-6">
                            
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="variant_id" x-model="selectedVariantId">

                                <!-- Size Selection -->
                                <div class="space-y-3">
                                    <h3 class="font-semibold text-black">Pilih Ukuran</h3>
                                    @if ($product->variants->where('stock', '>', 0)->count() > 0)
                                        <div class="grid grid-cols-4 gap-2">
                                            @foreach ($product->variants as $variant)
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="variant_selector" value="{{ $variant->id }}" 
                                                           x-model="selectedVariantId" 
                                                           @change="selectedStock = {{ $variant->stock }}; quantity = 1"
                                                           class="sr-only peer"
                                                           {{ $variant->stock < 1 ? 'disabled' : '' }}>
                                                    <div class="h-12 flex items-center justify-center border border-gray-200 rounded-xl text-sm font-medium peer-checked:bg-black peer-checked:text-white peer-checked:border-black peer-disabled:bg-gray-100 peer-disabled:text-gray-400 peer-disabled:cursor-not-allowed hover:border-gray-400 transition-all duration-200">
                                                        {{ $variant->size }}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div class="text-sm text-gray-500" x-show="selectedVariantId" x-cloak>
                                            Stok tersedia: <span x-text="selectedStock" class="font-medium"></span>
                                        </div>
                                    @else
                                        <p class="text-sm text-red-500 bg-red-50 p-3 rounded-xl">
                                            Stok habis untuk semua ukuran.
                                        </p>
                                    @endif
                                </div>
                                
                                <!-- Quantity Selection -->
                                <div class="flex items-center gap-4" x-show="selectedVariantId && selectedStock > 0" x-cloak>
                                    <label class="font-semibold text-black">Jumlah</label>
                                    <input type="number" name="quantity" x-model.number="quantity" @input="validateQuantity()" 
                                           min="1" :max="selectedStock" 
                                           class="w-20 h-12 border border-gray-200 rounded-xl text-center font-medium focus:border-black focus:ring-0 focus:outline-none">
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    <button type="submit" :disabled="!selectedVariantId || selectedStock < 1 || quantity < 1" 
                                            class="w-full h-14 bg-black text-white font-semibold rounded-2xl hover:bg-gray-800 transition-all duration-200 shadow-sm flex items-center justify-center gap-2 disabled:bg-gray-300 disabled:cursor-not-allowed">
                                        <i class="fas fa-shopping-cart text-sm"></i>
                                        <span x-show="!selectedVariantId">Pilih Ukuran</span>
                                        <span x-show="selectedVariantId && selectedStock > 0">Tambah ke Keranjang</span>
                                        <span x-show="selectedVariantId && selectedStock < 1">Stok Habis</span>
                                    </button>
                                    
                                    <button type="submit" formaction="{{ route('checkout.buyNow') }}" 
                                            :disabled="!selectedVariantId || selectedStock < 1 || quantity < 1" 
                                            class="w-full h-14 bg-white border border-gray-200 text-black font-semibold rounded-2xl hover:bg-gray-50 transition-all duration-200 flex items-center justify-center gap-2 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed">
                                        <i class="fas fa-bolt text-sm"></i>
                                        <span>Beli Sekarang</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Reviews Section -->
    <div class="border-t border-gray-100 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-black mb-8">Ulasan Pelanggan</h2>
                
                @if ($product->ratings->isNotEmpty())
                    <!-- Rating Summary -->
                    <div class="bg-white rounded-2xl p-6 mb-6">
                        <div class="flex items-center gap-6 mb-6">
                            <div class="text-4xl font-bold text-black">
                                {{ number_format($product->ratings->avg('rating'), 1) }}
                            </div>
                            <div>
                                <div class="flex items-center text-yellow-400 mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-lg {{ $i <= round($product->ratings->avg('rating')) ? '' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-500">
                                    Berdasarkan {{ $product->ratings->count() }} ulasan
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="space-y-4">
                        @foreach ($product->ratings as $rating)
                        <div class="bg-white rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <img src="{{ 'https://ui-avatars.com/api/?name='.urlencode($rating->user->name).'&background=000000&color=ffffff&size=40' }}" 
                                     class="w-10 h-10 rounded-full flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-black">{{ $rating->user->name }}</p>
                                        <div class="flex items-center text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= $rating->rating ? '' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    @if($rating->review)
                                    <p class="text-gray-600 mb-2">{{ $rating->review }}</p>
                                    @endif
                                    <p class="text-xs text-gray-400">{{ $rating->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- No Reviews State -->
                    <div class="bg-white rounded-2xl p-8 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-star text-gray-400 text-xl"></i>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada ulasan untuk produk ini</p>
                        <p class="text-gray-400 text-sm mt-1">Jadilah yang pertama memberikan ulasan!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection