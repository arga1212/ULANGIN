@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Filter -->
        <header class="mb-8 p-6 bg-white rounded-xl shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Toko Kami</h1>
                    <p class="text-gray-500 mt-1">Temukan produk terbaik pilihan Anda.</p>
                </div>
                
                <!-- Form Filter -->
                <form action="{{ route('shop.index') }}" method="GET" class="w-full md:w-auto">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="text" name="search" class="w-full sm:w-48 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" placeholder="Cari produk..." value="{{ request('search') }}">
                        
                        <select name="category_id" class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                            <option value="">Semua Kategori</option>
                            @foreach($allCategories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="w-full sm:w-auto bg-black text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-search"></i>
                            <span>Cari</span>
                        </button>
                    </div>
                </form>
            </div>
            @if ($categoryName)
                <div class="mt-4 pt-4 border-t">
                    <p class="text-gray-600">Menampilkan hasil untuk kategori: <span class="font-semibold text-black">{{ $categoryName }}</span></p>
                </div>
            @endif
        </header>

        <!-- Product Grid -->
        <main>
            @if($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <a href="{{ route('shop.show', $product) }}" class="bg-white rounded-xl shadow-md overflow-hidden group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="h-48 w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                            
                            <p class="text-lg font-bold text-black mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            {{-- Menampilkan Kategori Produk --}}
                            <div class="text-xs text-gray-500 mt-2 flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-full w-fit">
                                <i class="fas fa-tag"></i>
                                <span>{{ $product->category->name ?? 'N/A' }}</span>
                            </div>
                            
                            {{-- BAGIAN RATING DAN TERJUAL DIHAPUS DARI SINI --}}

                        </div>
                    </a>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-10">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-20 px-6 bg-white rounded-lg shadow-md">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-2xl font-semibold text-gray-700">Produk Tidak Ditemukan</p>
                    <p class="text-gray-500 mt-2">Coba ubah kata kunci pencarian atau filter Anda.</p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection