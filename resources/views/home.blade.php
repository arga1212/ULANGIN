@extends ('layouts.app')

@section ('content')

<!-- Hero Section with Enhanced Animations -->
<header class="relative h-[60vh] md:h-[80vh] bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('images/banner1.png') }}'); filter: grayscale(100%);">
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-black/60"></div>
    
    <!-- Animated particles background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="particles-container">
            <div class="particle particle-0"></div>
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
            <div class="particle particle-5"></div>
            <div class="particle particle-6"></div>
            <div class="particle particle-7"></div>
            <div class="particle particle-8"></div>
            <div class="particle particle-9"></div>
            <div class="particle particle-10"></div>
            <div class="particle particle-11"></div>
            <div class="particle particle-12"></div>
            <div class="particle particle-13"></div>
            <div class="particle particle-14"></div>
            <div class="particle particle-15"></div>
            <div class="particle particle-16"></div>
            <div class="particle particle-17"></div>
            <div class="particle particle-18"></div>
            <div class="particle particle-19"></div>
        </div>
    </div>
    
    <div class="relative h-full flex items-center justify-center text-center px-4 z-10">
        <div class="animate-fade-in-up">
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-extrabold text-white tracking-tight drop-shadow-2xl mb-6 leading-tight">
                Rework Your Style
            </h1>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up-delay-2">
                <a href="{{ route('shop.index') }}" class="hero-btn primary">
                    <span>Jelajahi Koleksi Kami</span>
                    <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-scroll-indicator"></div>
        </div>
    </div>
</header>

<!-- Stats Section -->
<!-- <section class="bg-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="stats-item">
                <div class="text-3xl md:text-4xl font-bold mb-2 counter" data-target="1000">0</div>
                <p class="text-gray-300 text-sm uppercase tracking-wider">Pakaian Terselamatkan</p>
            </div>
            <div class="stats-item">
                <div class="text-3xl md:text-4xl font-bold mb-2 counter" data-target="50">0</div>
                <p class="text-gray-300 text-sm uppercase tracking-wider">UMKM Partner</p>
            </div>
            <div class="stats-item">
                <div class="text-3xl md:text-4xl font-bold mb-2 counter" data-target="500">0</div>
                <p class="text-gray-300 text-sm uppercase tracking-wider">Pelanggan Puas</p>
            </div>
            <div class="stats-item">
                <div class="text-3xl md:text-4xl font-bold mb-2 counter" data-target="95">0</div>
                <p class="text-gray-300 text-sm uppercase tracking-wider">Rating Positif</p>
            </div>
        </div>
    </div>
</section> -->

<div class="bg-gray-50">
    <!-- Features Section with Enhanced Design -->
    <section class="py-20 sm:py-24" id="features">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-black mb-4">Keunggulan Kami</h2>
                <div class="w-24 h-1 bg-black mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Menghadirkan solusi fashion berkelanjutan dengan kualitas terbaik dan desain yang memukau
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="feature-card group">
                    <div class="feature-icon-container">
                        <div class="feature-icon">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Rework Unik & Personal</h3>
                        <p class="feature-description">Setiap produk punya desain khas dan bisa dikustom sesuai gaya kamu.</p>
                        <div class="feature-hover-effect"></div>
                    </div>
                </div>
                
                <!-- Feature Card 2 -->
                <div class="feature-card group">
                    <div class="feature-icon-container">
                        <div class="feature-icon">
                            <i class="fas fa-leaf text-2xl"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Ramah Lingkungan</h3>
                        <p class="feature-description">Ubah pakaian bekas jadi fashion baru—gaya keren tanpa buang-buang.</p>
                        <div class="feature-hover-effect"></div>
                    </div>
                </div>
                
                <!-- Feature Card 3 -->
                <div class="feature-card group">
                    <div class="feature-icon-container">
                        <div class="feature-icon">
                            <i class="fas fa-handshake text-2xl"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Kolaborasi UMKM Lokal</h3>
                        <p class="feature-description">Desain dari UMKM Lokal yang keren dan inovatif.</p>
                        <div class="feature-hover-effect"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section (New Addition) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-black mb-4">Cara Kerja Rework</h2>
                <div class="w-24 h-1 bg-black mx-auto mb-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="process-step text-center">
                    <div class="process-number">01</div>
                    <h3 class="text-xl font-bold text-black mb-3">Pilih Desain</h3>
                    <p class="text-gray-600">Browse koleksi desain dari UMKM partner kami</p>
                </div>
                <div class="process-step text-center">
                    <div class="process-number">02</div>
                    <h3 class="text-xl font-bold text-black mb-3">Kirim Pakaian</h3>
                    <p class="text-gray-600">Kirim pakaian bekas yang ingin di-rework</p>
                </div>
                <div class="process-step text-center">
                    <div class="process-number">03</div>
                    <h3 class="text-xl font-bold text-black mb-3">Proses Rework</h3>
                    <p class="text-gray-600">Tim ahli mengubah pakaian sesuai desain pilihan</p>
                </div>
                <div class="process-step text-center">
                    <div class="process-number">04</div>
                    <h3 class="text-xl font-bold text-black mb-3">Terima Hasil</h3>
                    <p class="text-gray-600">Dapatkan fashion baru dengan gaya personal</p>
                </div>
            </div>
        </div>
    </section>

     <!-- Process Section (New Addition) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-black mb-4">Cara Memberi Produk Non-Custom</h2>
                <div class="w-24 h-1 bg-black mx-auto mb-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="process-step text-center">
                    <div class="process-number">01</div>
                    <h3 class="text-xl font-bold text-black mb-3">Masuk website kami</h3>
                    <p class="text-gray-600">Browse koleksi desain dari kami</p>
                </div>
                <div class="process-step text-center">
                    <div class="process-number">02</div>
                    <h3 class="text-xl font-bold text-black mb-3">Pilih Produk </h3>
                    <p class="text-gray-600">Pilih Produk yang ingin ada beli</p>
                </div>
                <div class="process-step text-center">
                    <div class="process-number">03</div>
                    <h3 class="text-xl font-bold text-black mb-3">Checkout & Bayar</h3>
                    <p class="text-gray-600">Silahkan Lakukan proses checkout</p>
                </div>
                <div class="process-step text-center">
                    <div class="process-number">04</div>
                    <h3 class="text-xl font-bold text-black mb-3">Terima Hasil & Tunggu Produk anda</h3>
                    <p class="text-gray-600">Dapatkan fashion baru dengan gaya personal</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section with Enhanced Design -->
    <section class="py-20 sm:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-black mb-4">Kategori Pilihan</h2>
                <div class="w-24 h-1 bg-black mx-auto mb-6"></div>
                <p class="text-xl text-gray-600">Temukan style yang sesuai dengan kepribadianmu</p>
            </div>
            
            @if ($categories->isNotEmpty())
            <div class="relative px-16">
                <button class="scroll-btn scroll-btn-enhanced left-4" onclick="scrollContainer('category-grid', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="category-grid" class="flex gap-8 overflow-x-auto pb-6 scroll-smooth snap-x snap-mandatory custom-scrollbar scroll-pl-8">
                    @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category_id' => $category->id]) }}" class="category-card group flex-none w-80">
                        <div class="relative rounded-2xl overflow-hidden shadow-xl">
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" 
                                 class="h-96 w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-2xl font-bold tracking-wide mb-2 transform transition-transform group-hover:translate-y-0 translate-y-2">
                                    {{ $category->name }}
                                </h3>
                                <div class="flex items-center text-white/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-sm">Lihat Koleksi</span>
                                    <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1"></i>
                                </div>
                            </div>
                            <div class="category-overlay"></div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <button class="scroll-btn scroll-btn-enhanced right-4" onclick="scrollContainer('category-grid', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Favorite Products Section with Enhanced Design -->
    <section class="py-20 sm:py-24 bg-white" id="BiggestRating">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-black mb-4">Barang Favorit Kami</h2>
                <div class="w-24 h-1 bg-black mx-auto mb-6"></div>
                <p class="text-xl text-gray-600">Produk pilihan dengan rating tertinggi dari pelanggan</p>
            </div>
            
            @if($featuredProducts->isEmpty())
                <div class="text-center py-24 px-6 bg-gray-50 rounded-2xl">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-200 rounded-full mb-6">
                        <i class="fas fa-star text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Produk Favorit</h3>
                    <p class="text-lg text-gray-600 max-w-md mx-auto">
                        Produk favorit akan muncul di sini berdasarkan rating dan ulasan pelanggan
                    </p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($featuredProducts as $product)
                    <a href="{{ route('shop.show', $product) }}" class="product-card group">
                        <div class="product-image-container">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="product-image">
                            <div class="product-overlay">
                                <div class="product-overlay-content">
                                    <i class="fas fa-eye text-white text-xl"></i>
                                    <span class="text-white text-sm font-semibold mt-2">Lihat Detail</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title" title="{{ $product->name }}">{{ $product->name }}</h3>
                            <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="product-stock">
                                <i class="fas fa-box text-black"></i>
                                <span class="ml-2">Stok: {{ $product->total_stock }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Testimonial Section (New Addition) -->
    <!-- <section class="py-20 bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Apa Kata Mereka</h2>
                <div class="w-24 h-1 bg-white mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="testimonial-stars">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                        <p class="testimonial-text">"Hasil rework-nya amazing banget! Jaket lama jadi kelihatan premium dan unik. Definitely will order again!"</p>
                        <div class="testimonial-author">
                            <strong>Sarah M.</strong>
                            <span>Jakarta</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="testimonial-stars">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                        <p class="testimonial-text">"Konsep sustainable fashion yang keren! Baju bekas jadi stylish dan berkualitas. Love it!"</p>
                        <div class="testimonial-author">
                            <strong>Rizki A.</strong>
                            <span>Bandung</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="testimonial-stars">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                        <p class="testimonial-text">"Tim yang profesional dan hasil yang memuaskan. Rework jadi solusi fashion yang eco-friendly!"</p>
                        <div class="testimonial-author">
                            <strong>Maya L.</strong>
                            <span>Surabaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- CTA Section (New Addition) -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Mulai Rework Journey-mu?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan orang yang sudah merasakan pengalaman fashion berkelanjutan bersama kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#BiggestRating" class="cta-btn primary">
                    Mulai Sekarang
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    /* Enhanced Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { 
        display: none; 
    }
    .custom-scrollbar { 
        -ms-overflow-style: none; 
        scrollbar-width: none; 
    }
    
    /* Enhanced Scroll Buttons */
    .scroll-btn-enhanced {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 30;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        border-radius: 50%;
        width: 3.5rem;
        height: 3.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        color: rgb(55, 65, 81);
        transition: all 0.3s ease;
    }
    
    .scroll-btn-enhanced:hover {
        background: black;
        color: white;
        transform: translateY(-50%) scale(1.1);
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes scrollIndicator {
        0%, 100% { 
            transform: translateY(0); 
        }
        50% { 
            transform: translateY(6px); 
        }
    }
    
    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
        }
        33% { 
            transform: translateY(-10px) rotate(3deg); 
        }
        66% { 
            transform: translateY(5px) rotate(-3deg); 
        }
    }
    
    .animate-fade-in-up { 
        animation: fadeInUp 0.8s ease-out; 
    }
    .animate-fade-in-up-delay { 
        animation: fadeInUp 0.8s ease-out 0.2s both; 
    }
    .animate-fade-in-up-delay-2 { 
        animation: fadeInUp 0.8s ease-out 0.4s both; 
    }
    .animate-scroll-indicator { 
        animation: scrollIndicator 2s infinite; 
    }
    
    /* Particles */
    .particles-container {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .particle {
        position: absolute;
        background: white;
        border-radius: 50%;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
    }
    
    .particle-0 { width: 3px; height: 3px; left: 10%; top: 20%; animation-delay: 0s; }
    .particle-1 { width: 4px; height: 4px; left: 25%; top: 60%; animation-delay: 1s; }
    .particle-2 { width: 2px; height: 2px; left: 40%; top: 30%; animation-delay: 2s; }
    .particle-3 { width: 5px; height: 5px; left: 65%; top: 80%; animation-delay: 0.5s; }
    .particle-4 { width: 3px; height: 3px; left: 80%; top: 15%; animation-delay: 3s; }
    .particle-5 { width: 4px; height: 4px; left: 15%; top: 70%; animation-delay: 1.5s; }
    .particle-6 { width: 2px; height: 2px; left: 90%; top: 45%; animation-delay: 4s; }
    .particle-7 { width: 6px; height: 6px; left: 35%; top: 85%; animation-delay: 2.5s; }
    .particle-8 { width: 3px; height: 3px; left: 70%; top: 25%; animation-delay: 5s; }
    .particle-9 { width: 4px; height: 4px; left: 55%; top: 55%; animation-delay: 3.5s; }
    .particle-10 { width: 2px; height: 2px; left: 5%; top: 40%; animation-delay: 1.2s; }
    .particle-11 { width: 5px; height: 5px; left: 85%; top: 75%; animation-delay: 4.5s; }
    .particle-12 { width: 3px; height: 3px; left: 20%; top: 10%; animation-delay: 2.8s; }
    .particle-13 { width: 4px; height: 4px; left: 60%; top: 90%; animation-delay: 0.8s; }
    .particle-14 { width: 2px; height: 2px; left: 45%; top: 5%; animation-delay: 3.8s; }
    .particle-15 { width: 6px; height: 6px; left: 75%; top: 50%; animation-delay: 1.8s; }
    .particle-16 { width: 3px; height: 3px; left: 30%; top: 95%; animation-delay: 4.2s; }
    .particle-17 { width: 4px; height: 4px; left: 95%; top: 35%; animation-delay: 2.2s; }
    .particle-18 { width: 2px; height: 2px; left: 50%; top: 65%; animation-delay: 5.5s; }
    .particle-19 { width: 5px; height: 5px; left: 12%; top: 82%; animation-delay: 3.2s; }
    
    /* Hero Buttons */
    .hero-btn {
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.125rem;
        border-radius: 9999px;
        transition: all 0.3s ease;
        transform: scale(1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-btn:hover {
        transform: scale(1.05);
    }
    
    .hero-btn.primary {
        background: white;
        color: black;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .hero-btn.primary:hover {
        background: black;
        color: white;
    }
    
    .hero-btn.secondary {
        border: 2px solid white;
        color: white;
    }
    
    .hero-btn.secondary:hover {
        background: white;
        color: black;
    }
    
    /* Stats */
    .stats-item {
        transform: scale(1);
        transition: all 0.5s ease;
    }
    
    .stats-item:hover {
        transform: scale(1.1);
    }
    
    /* Feature Cards */
    .feature-card {
        position: relative;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        transform: scale(1);
        transition: all 0.5s ease;
    }
    
    .feature-card:hover {
        transform: scale(1.05);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
    }
    
    .feature-icon-container {
        padding: 2rem 2rem 1rem 2rem;
    }
    
    .feature-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 4rem;
        width: 4rem;
        border-radius: 50%;
        background: black;
        color: white;
        margin: 0 auto;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(6deg);
    }
    
    .feature-content {
        padding: 1rem 2rem 2rem 2rem;
        position: relative;
    }
    
    .feature-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: rgb(17, 24, 39);
        margin-bottom: 0.75rem;
        text-align: center;
    }
    
    .feature-description {
        color: rgb(75, 85, 99);
        text-align: center;
        line-height: 1.625;
    }
    
    .feature-hover-effect {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0.25rem;
        background: black;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .feature-card:hover .feature-hover-effect {
        transform: scaleX(1);
    }
    
    /* Process Steps */
    .process-step {
        transform: scale(1);
        transition: all 0.5s ease;
    }
    
    .process-step:hover {
        transform: scale(1.05);
    }
    
    .process-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 4rem;
        height: 4rem;
        background: black;
        color: white;
        font-size: 1.25rem;
        font-weight: 700;
        border-radius: 50%;
        margin-bottom: 1.5rem;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Category Cards */
    .category-card {
        transform: scale(1);
        transition: all 0.5s ease;
    }
    
    .category-card:hover {
        transform: scale(1.05);
    }
    
    .category-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0);
        transition: all 0.3s ease;
    }
    
    .category-card:hover .category-overlay {
        background: rgba(0, 0, 0, 0.2);
    }
    
    /* Product Cards */
    .product-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transform: scale(1) translateY(0);
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(1) translateY(-0.5rem);
    }
    
    .product-image-container {
        position: relative;
        overflow: hidden;
    }
    
    .product-image {
        height: 12rem;
        width: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.5s ease;
    }
    
    .product-card:hover .product-image {
        filter: grayscale(0%);
        transform: scale(1.1);
    }
    
    .product-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .product-card:hover .product-overlay {
        opacity: 1;
    }
    
    .product-overlay-content {
        text-align: center;
        transform: translateY(1rem);
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .product-overlay-content {
        transform: translateY(0);
    }
    
    .product-info {
        padding: 1.5rem;
    }
    
    .product-title {
        font-weight: 700;
        color: rgb(17, 24, 39);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-bottom: 0.5rem;
        font-size: 1.125rem;
    }
    
    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: black;
        margin-bottom: 0.75rem;
    }
    
    .product-stock {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: rgb(107, 114, 128);
        padding-top: 0.75rem;
        border-top: 1px solid rgb(243, 244, 246);
    }
    
    /* Testimonials */
    .testimonial-card {
        background: rgb(31, 41, 55);
        border-radius: 1rem;
        padding: 2rem;
        transform: scale(1);
        transition: all 0.3s ease;
    }
    
    .testimonial-card:hover {
        transform: scale(1.05);
        background: rgb(55, 65, 81);
    }
    
    .testimonial-stars {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .testimonial-text {
        color: rgb(209, 213, 219);
        text-align: center;
        margin-bottom: 1.5rem;
        font-style: italic;
        font-size: 1.125rem;
        line-height: 1.625;
    }
    
    .testimonial-author {
        text-align: center;
    }
    
    .testimonial-author strong {
        display: block;
        color: white;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .testimonial-author span {
        color: rgb(156, 163, 175);
        font-size: 0.875rem;
    }
    
    /* CTA Buttons */
    .cta-btn {
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.125rem;
        border-radius: 9999px;
        transition: all 0.3s ease;
        transform: scale(1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .cta-btn:hover {
        transform: scale(1.05);
    }
    
    .cta-btn.primary {
        background: white;
        color: black;
    }
    
    .cta-btn.primary:hover {
        background: rgb(229, 231, 235);
    }
    
    .cta-btn.secondary {
        border: 2px solid white;
        color: white;
    }
    
    .cta-btn.secondary:hover {
        background: white;
        color: black;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .scroll-btn-enhanced { 
            display: none; 
        }
        .hero-btn { 
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
        }
        .particle { 
            display: none; 
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Enhanced scroll function
    function scrollContainer(containerId, direction) {
        const container = document.getElementById(containerId);
        const scrollAmount = container.clientWidth * 0.85;
        
        container.scrollBy({
            left: direction === 'left' ? -scrollAmount : scrollAmount,
            behavior: 'smooth'
        });
    }
    
    // Counter animation
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    }
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.querySelector('.counter')) {
                    animateCounters();
                }
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats when visible
        const statsSection = document.querySelector('.stats-item');
        if (statsSection) {
            const section = statsSection.closest('section');
            if (section) observer.observe(section);
        }
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endpush 
@endsection