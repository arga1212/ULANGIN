@extends ('layouts.app')

@section ('content')

<!-- Hero Section -->
<header class="relative h-[60vh] md:h-[80vh] bg-cover bg-center" style="background-image: url('{{ asset('images/banner1.png') }}'); filter: grayscale(100%);">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative h-full flex items-center justify-center text-center px-4">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight drop-shadow-lg">
            Rework Your Style
        </h1>
    </div>
</header>

<br>
<br>
<div class="bg-gray-100">

    <!-- Features Section -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-black mb-12 text-center">Keunggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Kartu Keunggulan 1 --}}
                <div class="flex items-center p-6 bg-white rounded-xl shadow-md border border-gray-200">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-black text-white">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Rework Unik & Personal</h3>
                        <p class="text-sm text-gray-600 mt-1">Setiap produk punya desain khas dan bisa dikustom sesuai gaya kamu.</p>
                    </div>
                </div>
                {{-- Kartu Keunggulan 2 --}}
                <div class="flex items-center p-6 bg-white rounded-xl shadow-md border border-gray-200">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-black text-white">
                        <i class="fas fa-store text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Ramah Lingkungan</h3>
                        <p class="text-sm text-gray-600 mt-1">Ubah pakaian bekas jadi fashion baru—gaya keren tanpa buang-buang.</p>
                    </div>
                </div>
                {{-- Kartu Keunggulan 3 --}}
                <div class="flex items-center p-6 bg-white rounded-xl shadow-md border border-gray-200">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-black text-white">
                        <i class="fas fa-tag text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Kolaborasi UMKM Lokal</h3>
                        <p class="text-sm text-gray-600 mt-1">Desain dari UMKM Lokal yang keren dan inovatif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-black mb-12 text-center">Kategori Pilihan</h2>
            @if ($categories->isNotEmpty())
            <div class="relative px-12">
                <button class="scroll-btn left-0" onclick="scrollContainer('category-grid', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="category-grid" class="flex gap-6 overflow-x-auto pb-4 scroll-smooth snap-x snap-mandatory custom-scrollbar scroll-pl-6">
                    @foreach($categories as $category)
                    {{-- PERBAIKAN: Menggunakan route 'shop.index' dengan parameter slug kategori --}}
<a href="{{ route('shop.index', ['category_id' => $category->id]) }}" ...>                        <div class="relative rounded-xl overflow-hidden shadow-lg transform group-hover:scale-105 transition-all duration-300">
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="h-80 w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-white text-xl font-bold tracking-wide">{{ $category->name }}</h3>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <button class="scroll-btn right-0" onclick="scrollContainer('category-grid', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Favorite Products Section -->
    <section class="py-16 sm:py-20" id="BiggestRating">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-black mb-12 text-center">Barang Favorit Kami</h2>
            {{-- PERBAIKAN: Menggunakan variabel $featuredProducts --}}
            @if($featuredProducts->isEmpty())
                <div class="text-center py-16 px-6 bg-white rounded-lg shadow-sm">
                    <i class="fas fa-star text-5xl text-gray-300 mb-4"></i>
                    <p class="text-lg text-gray-600">Belum ada produk favorit saat ini.</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($featuredProducts as $product)
                    {{-- PERBAIKAN: Menggunakan route 'shop.show' --}}
                    <a href="{{ route('shop.show', $product) }}" class="bg-white rounded-xl shadow-md overflow-hidden group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-48 w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                            <p class="text-lg font-bold text-black mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="flex items-center text-sm text-gray-500 mt-2 pt-2 border-t">
                                <i class="fas fa-box text-black"></i>
                                {{-- PERBAIKAN: Menggunakan total_stock dari varian --}}
                                <span class="ml-1 font-semibold">Stok: {{ $product->total_stock }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Customer Service & Location Sections -->
    {{-- (Kode untuk section ini bisa di-copy-paste langsung tanpa perubahan, kecuali untuk route jika perlu) --}}
    
</div>

{{-- CSS dan JS untuk scroll button --}}
@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar { display: none; }
    .custom-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .scroll-btn {
        @apply absolute top-1/2 -translate-y-1/2 z-20 bg-white/70 backdrop-blur-sm rounded-full w-12 h-12 flex items-center justify-center shadow-lg text-gray-700 hover:bg-black hover:text-white transition-all duration-300;
    }
    @media (max-width: 768px) {
        .scroll-btn { display: none; }
    }
</style>
@endpush

@push('scripts')
<script>
    function scrollContainer(containerId, direction) {
        const container = document.getElementById(containerId);
        const scrollAmount = container.clientWidth * 0.8;
        
        container.scrollBy({
            left: direction === 'left' ? -scrollAmount : scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
@endpush 
@endsection