@extends ('layouts.app')

@section ('content')

<!-- Hero Section with Enhanced Animations - Monochrome Theme -->
<header class="relative h-[60vh] md:h-[80vh] bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('images/banner1.png') }}'); filter: grayscale(100%);">
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-black/70"></div>
    
    <!-- Animated particles background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="particles-container">
            @for ($i = 0; $i < 20; $i++)
                <div class="particle particle-{{ $i }}"></div>
            @endfor
        </div>
    </div>
    
    <div class="relative h-full flex items-center justify-center text-center px-4 z-10">
        <div class="animate-fade-in-up max-w-4xl">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter drop-shadow-2xl mb-6 leading-tight">
                Rework Your Style
            </h1>
            <p class="text-lg md:text-xl text-white/90 font-light mb-8 max-w-2xl mx-auto leading-relaxed">
                Transform old clothes into unique fashion statements
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up-delay-2">
                <a href="{{ route('shop.index') }}" class="hero-btn primary group">
                    <span>Jelajahi Koleksi</span>
                    <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-white/40 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white/60 rounded-full mt-2 animate-scroll-indicator"></div>
        </div>
    </div>
</header>

<div class="bg-white">
    <!-- About Section - What is ULANGIN? -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Apa itu ULANGIN?</h2>
                <div class="w-20 h-0.5 bg-gray-900 mx-auto mb-6"></div>
                <div class="max-w-4xl mx-auto">
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed font-light">
                        <strong class="font-bold text-gray-900">ULANGIN</strong> adalah gerakan fashion berkelanjutan yang mengolah pakaian lama menjadi karya baru yang unik, stylish, dan ramah lingkungan. Melalui proses rework seperti patchwork, bordir, dan redesign, kami memberi napas baru pada pakaian bekas sekaligus mengurangi limbah tekstil.
                    </p>
                    <p class="text-base md:text-lg text-gray-600 mt-4 font-light">
                        Bersama penjahit lokal, kami menciptakan produk fashion yang tidak hanya bernilai, tapi juga membawa dampak positif bagi lingkungan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why ULANGIN Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Kenapa ULANGIN?</h2>
                <div class="w-20 h-0.5 bg-gray-900 mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $features = [
                    ['icon' => 'fas fa-user-circle', 'title' => 'Unique & Personal', 'desc' => 'Setiap produk memiliki desain khas dan dapat dikustomisasi sesuai dengan gaya personal Anda.'],
                    ['icon' => 'fas fa-leaf', 'title' => 'Eco-Friendly', 'desc' => 'Mengurangi limbah tekstil dengan mengubah pakaian bekas menjadi fashion statement baru.'],
                    ['icon' => 'fas fa-handshake', 'title' => 'Local Collaboration', 'desc' => 'Berkolaborasi dengan penjahit dan UMKM lokal untuk menciptakan ekonomi berkelanjutan.'],
                    ['icon' => 'fas fa-tags', 'title' => 'Affordable & Stylish', 'desc' => 'Fashion berkualitas dengan harga terjangkau tanpa mengorbankan gaya dan kualitas.']
                ];
                @endphp
                
                @foreach($features as $feature)
                <div class="feature-card-modern group">
                    <div class="feature-icon-modern">
                        <i class="{{ $feature['icon'] }} text-3xl"></i>
                    </div>
                    <div class="feature-content-modern">
                        <h3 class="feature-title-modern">{{ $feature['title'] }}</h3>
                        <p class="feature-description-modern">{{ $feature['desc'] }}</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Donation Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Cara Donasi</h2>
                <div class="w-20 h-0.5 bg-gray-900 mx-auto mb-6"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto font-light">
                    Punya baju lama yang sudah tidak terpakai? Jangan dibuang! Donasikan melalui ULANGIN dan biarkan kami memberi napas baru pada pakaianmu 🌿
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @php
                $steps = [
                    ['num' => '01', 'icon' => 'fas fa-map-marker-alt', 'title' => 'Datang ke Booth', 'desc' => 'Serahkan pakaianmu di open booth ULANGIN setiap minggu'],
                    ['num' => '02', 'icon' => 'fas fa-clipboard-check', 'title' => 'Seleksi & Pencatatan', 'desc' => 'Tim ULANGIN akan menyeleksi pakaian sesuai kriteria'],
                    ['num' => '03', 'icon' => 'fas fa-ticket-alt', 'title' => 'Voucher Diskon', 'desc' => 'Dapatkan apresiasi berupa voucher diskon untuk belanja produk ULANGIN'],
                    ['num' => '04', 'icon' => 'fas fa-magic', 'title' => 'Proses Rework', 'desc' => 'Pakaianmu akan diolah kembali menjadi produk fashion baru yang keren & eco-friendly']
                ];
                @endphp
                
                @foreach($steps as $step)
                <div class="donation-step group">
                    <div class="step-number">{{ $step['num'] }}</div>
                    <div class="step-icon">
                        <i class="{{ $step['icon'] }} text-2xl"></i>
                    </div>
                    <h3 class="step-title">{{ $step['title'] }}</h3>
                    <p class="step-description">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="https://www.instagram.com/ulangin.id/" class="cta-btn-modern primary">
                    <span>Informasi Booth Kami</span>
                    <i class="fas fa-info-circle ml-3"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Donate to ULANGIN is Different Section - Monochrome Theme -->
    <section class="py-20 bg-gray-100 relative overflow-hidden">
        <!-- Background Pattern - Monochrome -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-32 h-32 bg-gray-300 rounded-full"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-gray-400 rounded-full"></div>
            <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-gray-300 rounded-full"></div>
            <div class="absolute bottom-10 right-1/3 w-36 h-36 bg-gray-400 rounded-full"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-900 rounded-full mb-6 transform rotate-12 hover:rotate-0 transition-all duration-500">
                    <i class="fas fa-heart text-3xl text-white"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">
                    Kenapa Donasi ke <span class="text-gray-800">ULANGIN</span> Berbeda?
                </h2>
                <div class="w-24 h-1 bg-gray-900 mx-auto mb-6 rounded-full"></div>
                <p class="text-lg md:text-xl text-gray-700 max-w-5xl mx-auto font-light leading-relaxed">
                    Donasi baju di ULANGIN bukan sekadar <strong class="text-gray-900">"oper limbah"</strong> — tapi benar-benar 
                    <strong class="text-gray-800">mengubahnya jadi sesuatu yang bermanfaat</strong>. 
                    Setiap pakaian yang kamu berikan:
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
                @php
                $benefits = [
                    ['icon' => 'fas fa-recycle', 'color' => 'bg-gray-800', 'title' => 'Mengurangi Limbah Tekstil', 'desc' => 'Kami menyortir, mencuci, dan merework baju bekas agar tidak berakhir di TPA. Setiap donasi = satu langkah menyelamatkan bumi! 🌍'],
                    ['icon' => 'fas fa-gift', 'color' => 'bg-gray-700', 'title' => 'Mendapatkan Voucher Diskon', 'desc' => 'Sebagai apresiasi, donatur mendapat voucher khusus untuk produk ULANGIN. Berbagi kebaikan, dapat keuntungan! 🎁'],
                    ['icon' => 'fas fa-hands-helping', 'color' => 'bg-gray-800', 'title' => 'Mendukung UMKM Lokal', 'desc' => 'Setiap produk dikerjakan bersama penjahit & pengrajin lokal, menghidupkan ekonomi sekitar. Support lokal, impact global! 🏘️'],
                    ['icon' => 'fas fa-briefcase', 'color' => 'bg-gray-700', 'title' => 'Membuka Lapangan Kerja Baru', 'desc' => 'Dengan donasimu, kamu ikut membantu terciptanya peluang kerja di industri kreatif. Satu donasi, ribuan manfaat! 💼'],
                    ['icon' => 'fas fa-graduation-cap', 'color' => 'bg-gray-800', 'title' => 'Ikut Edukasi Lingkungan', 'desc' => 'Lewat ULANGIN, kamu jadi bagian dari gerakan <strong>slow fashion</strong> yang peduli bumi. Bersama-sama kita ciptakan masa depan yang lebih hijau dan berkelanjutan! 🌱✨', 'span' => 'lg:col-span-2 xl:col-span-2']
                ];
                @endphp
                
                @foreach($benefits as $benefit)
                <div class="why-donate-card group {{ $benefit['span'] ?? '' }}">
                    <div class="why-donate-icon-wrapper">
                        <div class="why-donate-icon {{ $benefit['color'] }}">
                            <i class="{{ $benefit['icon'] }} text-2xl"></i>
                        </div>
                        <div class="check-mark">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="why-donate-content">
                        <h3 class="why-donate-title">{{ $benefit['title'] }}</h3>
                        <p class="why-donate-description">{!! $benefit['desc'] !!}</p>
                    </div>
                    <div class="why-donate-hover-effect"></div>
                </div>
                @endforeach
            </div>
            
            <!-- Call to Action -->
            <div class="text-center">
                <div class="inline-block bg-white rounded-3xl p-8 shadow-xl border border-gray-100 mb-8">
                    <p class="text-xl font-bold text-gray-900 mb-4">
                        Siap jadi bagian dari perubahan? 
                    </p>
                    <p class="text-base text-gray-600 mb-6">
                        Donasikan bajumu sekarang dan rasakan dampak positifnya! 
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="https://www.instagram.com/ulangin.id/" class="cta-btn-special primary">
                            <span>Mulai Donasi Sekarang</span>
                            <i class="fas fa-heart ml-3 text-white"></i>
                        </a>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-users mr-2"></i>
                            <span>Bergabung dengan 1000+ donatur lainnya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Animation Elements - Monochrome -->
        <div class="floating-elements">
            @php
            $floatingIcons = ['fas fa-leaf text-gray-400', 'fas fa-heart text-gray-400', 'fas fa-recycle text-gray-400', 'fas fa-star text-gray-400'];
            @endphp
            
            @foreach($floatingIcons as $index => $iconClass)
            <div class="floating-element floating-{{ $index + 1 }}">
                <i class="{{ $iconClass }}"></i>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Custom Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Cara Custom</h2>
                <div class="w-20 h-0.5 bg-gray-900 mx-auto mb-6"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto font-light">
                    Mau baju lamamu naik level? Dengan layanan custom rework, kamu bisa mengubah pakaian lama jadi desain baru sesuai gayamu sendiri ✨
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @php
                $customSteps = [
                    ['num' => '01', 'icon' => 'fas fa-palette', 'title' => 'Diskusi dengan kami terkait desain', 'desc' => 'Lihat inspirasi desain (patchwork, bordir, sablon, redesign) di katalog ULANGIN'],
                    ['num' => '02', 'icon' => 'fas fa-shipping-fast', 'title' => 'Bawa / Kirim', 'desc' => 'Serahkan pakaian lama yang ingin di-custom'],
                    ['num' => '03', 'icon' => 'fas fa-cut', 'title' => 'Proses Rework', 'desc' => 'Tim ULANGIN bersama penjahit lokal akan mengolah pakaian sesuai request'],
                    ['num' => '04', 'icon' => 'fas fa-star', 'title' => 'Terima Hasil', 'desc' => 'Nikmati baju baru dengan gaya personal yang unik dan ramah lingkungan']
                ];
                @endphp
                
                @foreach($customSteps as $step)
                <div class="custom-step group">
                    <div class="custom-step-inner">
                        <div class="step-number-custom">{{ $step['num'] }}</div>
                        <div class="step-icon-custom">
                            <i class="{{ $step['icon'] }} text-2xl"></i>
                        </div>
                        <h3 class="step-title-custom">{{ $step['title'] }}</h3>
                        <p class="step-description-custom">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="https://wa.me/6285136844527?text=Halo%20kak%20saya%20mau%20tanya%20tentang%20produk%20ULANGIN" 
                   class="cta-btn-modern primary">
                    <span>Ingin Custom? Hubungi Kami!</span>
                    <i class="fas fa-comment ml-3"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Kategori Pilihan</h2>
                <div class="w-20 h-0.5 bg-gray-900 mx-auto mb-6"></div>
                <p class="text-base md:text-lg text-gray-600 font-light">Temukan style yang sesuai dengan kepribadianmu</p>
            </div>
            
            @if (isset($categories) && $categories->isNotEmpty())
            <div class="relative px-16">
                <button class="scroll-btn-modern left-4" onclick="scrollContainer('category-grid', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="category-grid" class="flex gap-8 overflow-x-auto pb-6 scroll-smooth snap-x snap-mandatory custom-scrollbar scroll-pl-8">
                    @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category_id' => $category->id]) }}" class="category-card-modern group flex-none w-80">
                        <div class="category-image-container">
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" 
                                 class="category-image">
                            <div class="category-overlay-modern"></div>
                            <div class="category-content">
                                <h3 class="category-title">{{ $category->name }}</h3>
                                <div class="category-cta">
                                    <span>Lihat Koleksi</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <button class="scroll-btn-modern right-4" onclick="scrollContainer('category-grid', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Favorite Products Section -->
    <section class="py-20 bg-gray-100" id="BiggestRating">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Barang Favorit</h2>
                <div class="w-20 h-0.5 bg-gray-900 mx-auto mb-6"></div>
                <p class="text-base md:text-lg text-gray-600 font-light">Produk pilihan dengan rating tertinggi dari pelanggan</p>
            </div>
            
            @if(isset($featuredProducts) && $featuredProducts->isEmpty())
                <div class="text-center py-24 px-6 bg-white rounded-3xl border border-gray-100">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <i class="fas fa-star text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Produk Favorit</h3>
                    <p class="text-lg text-gray-600 max-w-md mx-auto font-light">
                        Produk favorit akan muncul di sini berdasarkan rating dan ulasan pelanggan
                    </p>
                </div>
            @elseif(isset($featuredProducts))
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($featuredProducts as $product)
                    <a href="{{ route('shop.show', $product) }}" class="product-card-modern group">
                        <div class="product-image-modern">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" 
                                 class="product-img">
                            <div class="product-overlay-modern">
                                <div class="product-overlay-content-modern">
                                    <i class="fas fa-eye text-white text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="product-info-modern">
                            <h3 class="product-title-modern">{{ $product->name }}</h3>
                            <p class="product-price-modern">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="product-stock-modern">
                                <span>Stok: {{ $product->total_stock }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white text-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mb-6 tracking-tight">Ingin Bekerja Sama? Hubungi Kami!</h2>
            <p class="text-lg md:text-xl text-gray-700 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
                Rework your clothes, refresh your style.<br>
                <span class="text-gray-900 font-bold">ULANGIN</span> — where old threads become new stories
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6285136844527?text=Halo%20kak%20saya%20mau%20tanya%20tentang%20produk%20ULANGIN" 
                   target="_blank" class="cta-btn-modern primary">
                    <span>Mulai Sekarang</span>
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </section>
</div>

@endsection

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
    
    /* Modern Scroll Buttons */
    .scroll-btn-modern {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 30;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .scroll-btn-modern:hover {
        background: white;
        color: black;
        border-color: black;
        transform: translateY(-50%) scale(1.1);
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(40px); 
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
            transform: translateY(8px); 
        }
    }
    
    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
        }
        33% { 
            transform: translateY(-15px) rotate(2deg); 
        }
        66% { 
            transform: translateY(8px) rotate(-2deg); 
        }
    }

    @keyframes floatingElement {
        0%, 100% { 
            transform: translateY(0px) translateX(0px) rotate(0deg); 
        }
        25% { 
            transform: translateY(-20px) translateX(10px) rotate(5deg); 
        }
        50% { 
            transform: translateY(-10px) translateX(-15px) rotate(-3deg); 
        }
        75% { 
            transform: translateY(-25px) translateX(5px) rotate(8deg); 
        }
    }

    @keyframes pulse {
        0%, 100% { 
            transform: scale(1); 
        }
        50% { 
            transform: scale(1.05); 
        }
    }

    @keyframes slideInFromLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInFromRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .animate-fade-in-up { 
        animation: fadeInUp 1s ease-out; 
    }
    .animate-fade-in-up-delay { 
        animation: fadeInUp 1s ease-out 0.3s both; 
    }
    .animate-fade-in-up-delay-2 { 
        animation: fadeInUp 1s ease-out 0.6s both; 
    }
    .animate-scroll-indicator { 
        animation: scrollIndicator 2.5s infinite; 
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
        background: white; /* Kept white for contrast against dark hero */
        border-radius: 50%;
        opacity: 0.08;
        animation: float 8s ease-in-out infinite;
    }
    
    .particle-0 { width: 4px; height: 4px; left: 8%; top: 15%; animation-delay: 0s; }
    .particle-1 { width: 6px; height: 6px; left: 22%; top: 65%; animation-delay: 1.2s; }
    .particle-2 { width: 3px; height: 3px; left: 38%; top: 25%; animation-delay: 2.4s; }
    .particle-3 { width: 8px; height: 8px; left: 68%; top: 85%; animation-delay: 0.8s; }
    .particle-4 { width: 4px; height: 4px; left: 85%; top: 12%; animation-delay: 3.6s; }
    .particle-5 { width: 5px; height: 5px; left: 12%; top: 75%; animation-delay: 1.8s; }
    .particle-6 { width: 3px; height: 3px; left: 92%; top: 48%; animation-delay: 4.8s; }
    .particle-7 { width: 7px; height: 7px; left: 32%; top: 88%; animation-delay: 3s; }
    .particle-8 { width: 4px; height: 4px; left: 72%; top: 22%; animation-delay: 6s; }
    .particle-9 { width: 5px; height: 5px; left: 58%; top: 58%; animation-delay: 4.2s; }
    .particle-10 { width: 3px; height: 3px; left: 3%; top: 38%; animation-delay: 1.4s; }
    .particle-11 { width: 6px; height: 6px; left: 88%; top: 78%; animation-delay: 5.4s; }
    .particle-12 { width: 4px; height: 4px; left: 18%; top: 8%; animation-delay: 3.4s; }
    .particle-13 { width: 5px; height: 5px; left: 62%; top: 92%; animation-delay: 0.6s; }
    .particle-14 { width: 3px; height: 3px; left: 48%; top: 3%; animation-delay: 4.6s; }
    .particle-15 { width: 8px; height: 8px; left: 78%; top: 52%; animation-delay: 2.2s; }
    .particle-16 { width: 4px; height: 4px; left: 28%; top: 96%; animation-delay: 5.2s; }
    .particle-17 { width: 5px; height: 5px; left: 96%; top: 32%; animation-delay: 2.6s; }
    .particle-18 { width: 3px; height: 3px; left: 52%; top: 68%; animation-delay: 6.6s; }
    .particle-19 { width: 6px; height: 6px; left: 8%; top: 84%; animation-delay: 3.8s; }
    
    /* Hero Buttons */
    .hero-btn {
        padding: 1rem 2.25rem; /* Adjusted for smaller text */
        font-weight: 600;
        font-size: 1rem; /* Adjusted font size */
        border-radius: 50px;
        transition: all 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.025em;
    }
    
    .hero-btn:hover {
        transform: translateY(-2px);
    }
    
    .hero-btn.primary {
        background: white;
        color: black;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .hero-btn.primary:hover {
        background: black;
        color: white;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    }
    
    /* Modern Feature Cards */
    .feature-card-modern {
        position: relative;
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .feature-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .feature-icon-modern {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 4.5rem;
        height: 4.5rem;
        background: black;
        color: white;
        border-radius: 50%;
        margin: 0 auto 2rem auto;
        transition: all 0.3s ease;
    }
    
    .feature-card-modern:hover .feature-icon-modern {
        transform: scale(1.1);
        background: #333;
    }
    
    .feature-content-modern {
        text-align: center;
    }
    
    .feature-title-modern {
        font-size: 1.25rem; /* Adjusted to text-xl */
        font-weight: 700;
        color: black;
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }
    
    .feature-description-modern {
        color: #666;
        line-height: 1.6;
        font-weight: 400;
        font-size: 1rem; /* Adjusted to text-base */
    }
    
    .feature-hover-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: black;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .feature-card-modern:hover .feature-hover-line {
        transform: scaleX(1);
    }
    
    /* Donation Steps */
    .donation-step {
        text-align: center;
        padding: 2rem 1.5rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .donation-step:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }
    
    .step-number {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 2.5rem;
        height: 2.5rem;
        background: black;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
    }
    
    .step-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 4rem;
        height: 4rem;
        background: #f8f8f8;
        border-radius: 50%;
        margin: 2rem auto 1.5rem auto;
        color: black;
        transition: all 0.3s ease;
    }
    
    .donation-step:hover .step-icon {
        background: black;
        color: white;
        transform: scale(1.1);
    }
    
    .step-title {
        font-size: 1.125rem; /* Adjusted to text-lg */
        font-weight: 700;
        color: black;
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }
    
    .step-description {
        color: #666;
        line-height: 1.6;
        font-size: 0.875rem; /* Adjusted to text-sm */
    }

    /* Why Donate Styles - Monochrome */
    .why-donate-card {
        position: relative;
        background: white;
        border-radius: 24px;
        padding: 2.5rem 2rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        overflow: hidden;
        animation: slideInFromLeft 0.8s ease-out;
    }

    .why-donate-card:nth-child(even) {
        animation: slideInFromRight 0.8s ease-out;
    }

    .why-donate-card:nth-child(n+4) {
        animation-delay: 0.2s;
    }

    .why-donate-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border-color: rgba(0, 0, 0, 0.3); /* Monochrome border on hover */
    }

    .why-donate-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 5rem;
        height: 5rem;
        margin: 0 auto 2rem auto;
    }

    .why-donate-icon {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        /* Background color will be set directly in blade with 'bg-gray-X' */
    }

    .why-donate-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        background: inherit;
        border-radius: 50%;
        filter: blur(8px);
        opacity: 0.3;
        transform: scale(1.2);
        transition: all 0.4s ease;
    }

    .why-donate-card:hover .why-donate-icon {
        transform: rotate(10deg) scale(1.1);
        animation: pulse 2s infinite;
    }

    .why-donate-card:hover .why-donate-icon::before {
        transform: scale(1.5);
        opacity: 0.5;
    }

    .check-mark {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 1.5rem;
        height: 1.5rem;
        background: black; /* Monochrome checkmark */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        transform: scale(0);
        transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .why-donate-card:hover .check-mark {
        transform: scale(1);
    }

    .why-donate-content {
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .why-donate-title {
        font-size: 1.25rem; /* Adjusted to text-xl */
        font-weight: 800;
        color: #1F2937; /* Monochrome text color */
        margin-bottom: 1.25rem;
        letter-spacing: -0.025em;
        line-height: 1.3;
        /* Removed background-clip text gradient */
        -webkit-text-fill-color: initial; /* Reset fill color */
    }

    .why-donate-description {
        color: #6B7280;
        line-height: 1.7;
        font-size: 1rem; /* Adjusted to text-base */
        font-weight: 400;
    }

    .why-donate-hover-effect {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.05); /* Monochrome hover effect */
        border-radius: 24px;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .why-donate-card:hover .why-donate-hover-effect {
        opacity: 1;
    }

    /* Special CTA Button - Monochrome */
    .cta-btn-special {
        padding: 1.25rem 2.5rem; /* Adjusted size */
        font-weight: 700;
        font-size: 1.125rem; /* Adjusted size */
        border-radius: 60px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.025em;
        position: relative;
        overflow: hidden;
    }

    .cta-btn-special.primary {
        background: black; /* Monochrome background */
        color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); /* Monochrome shadow */
        border: 2px solid transparent;
    }

    .cta-btn-special.primary::before {
        content: '';
        position: absolute;
        inset: 0;
        background: #333; /* Darker monochrome for hover */
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .cta-btn-special.primary:hover::before {
        opacity: 1;
    }

    .cta-btn-special.primary:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); /* Monochrome shadow */
    }

    .cta-btn-special span {
        position: relative;
        z-index: 2;
    }

    .cta-btn-special i {
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease;
    }

    .cta-btn-special:hover i {
        transform: scale(1.2);
    }

    /* Floating Elements - Monochrome */
    .floating-elements {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .floating-element {
        position: absolute;
        font-size: 1.5rem;
        opacity: 0.1;
        animation: floatingElement 6s ease-in-out infinite;
    }

    .floating-1 {
        top: 10%;
        left: 8%;
        animation-delay: 0s;
    }

    .floating-2 {
        top: 20%;
        right: 12%;
        animation-delay: 1.5s;
    }

    .floating-3 {
        bottom: 25%;
        left: 15%;
        animation-delay: 3s;
    }

    .floating-4 {
        bottom: 15%;
        right: 8%;
        animation-delay: 4.5s;
    }
    
    /* Custom Steps */
    .custom-step {
        position: relative;
    }
    
    .custom-step-inner {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        text-align: center;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }
    
    .custom-step:hover .custom-step-inner {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .step-number-custom {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        width: 2rem;
        height: 2rem;
        background: black;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
    }
    
    .step-icon-custom {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 4.5rem;
        height: 4.5rem;
        background: #f8f8f8;
        border-radius: 50%;
        margin: 0 auto 2rem auto;
        color: black;
        transition: all 0.3s ease;
    }
    
    .custom-step:hover .step-icon-custom {
        background: black;
        color: white;
        transform: scale(1.1);
    }
    
    .step-title-custom {
        font-size: 1.125rem; /* Adjusted to text-lg */
        font-weight: 700;
        color: black;
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }
    
    .step-description-custom {
        color: #666;
        line-height: 1.6;
        font-size: 0.875rem; /* Adjusted to text-sm */
    }
    
    /* Modern Category Cards */
    .category-card-modern {
        transform: scale(1);
        transition: all 0.4s ease;
    }
    
    .category-card-modern:hover {
        transform: scale(1.02);
    }
    
    .category-image-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    
    .category-image {
        height: 24rem;
        width: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.5s ease;
    }
    
    .category-card-modern:hover .category-image {
        filter: grayscale(0%); /* Keep this effect for a nice reveal */
        transform: scale(1.05);
    }
    
    .category-overlay-modern {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.3) 50%, transparent 100%);
    }
    
    .category-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 2rem;
        color: white;
    }
    
    .category-title {
        font-size: 1.25rem; /* Adjusted to text-xl */
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }
    
    .category-cta {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }
    
    .category-card-modern:hover .category-cta {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Modern Product Cards */
    .product-card-modern {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .product-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .product-image-modern {
        position: relative;
        overflow: hidden;
    }
    
    .product-img {
        height: 14rem;
        width: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.5s ease;
    }
    
    .product-card-modern:hover .product-img {
        filter: grayscale(0%); /* Keep this effect for a nice reveal */
        transform: scale(1.1);
    }
    
    .product-overlay-modern {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .product-card-modern:hover .product-overlay-modern {
        opacity: 1;
    }
    
    .product-overlay-content-modern {
        transform: translateY(10px);
        transition: transform 0.3s ease;
    }
    
    .product-card-modern:hover .product-overlay-content-modern {
        transform: translateY(0);
    }
    
    .product-info-modern {
        padding: 1.5rem;
    }
    
    .product-title-modern {
        font-weight: 700;
        color: black;
        font-size: 1.125rem; /* Adjusted to text-lg */
        margin-bottom: 0.75rem;
        letter-spacing: -0.025em;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .product-price-modern {
        font-size: 1.25rem; /* Adjusted to text-xl */
        font-weight: 700;
        color: black;
        margin-bottom: 0.75rem;
    }
    
    .product-stock-modern {
        font-size: 0.875rem; /* Adjusted to text-sm */
        color: #666;
        padding-top: 0.75rem;
        border-top: 1px solid #f0f0f0;
    }
    
    /* Modern CTA Buttons */
    .cta-btn-modern {
        padding: 1rem 2.25rem; /* Adjusted size */
        font-weight: 600;
        font-size: 1rem; /* Adjusted size */
        border-radius: 50px;
        transition: all 0.4s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.025em;
    }
    
    .cta-btn-modern:hover {
        transform: translateY(-2px);
    }
    
    .cta-btn-modern.primary {
        background: black;
        color: white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .cta-btn-modern.primary:hover {
        background: #333;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    }
    
    .cta-btn-modern.secondary {
        background: white;
        color: black;
        border: 2px solid black;
    }
    
    .cta-btn-modern.secondary:hover {
        background: black;
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .scroll-btn-modern { 
            display: none; 
        }
        .hero-btn { 
            font-size: 0.875rem; /* text-sm */
            padding: 0.875rem 1.75rem;
        }
        .particle { 
            display: none; 
        }
        .feature-card-modern {
            padding: 2rem 1.5rem;
        }
        .donation-step {
            padding: 1.5rem 1rem;
        }
        .custom-step-inner {
            padding: 2rem 1.5rem;
        }
        .step-number {
            width: 2rem;
            height: 2rem;
            font-size: 0.75rem;
        }
        .step-number-custom {
            width: 1.75rem;
            height: 1.75rem;
            font-size: 0.75rem;
        }
        .why-donate-card {
            padding: 2rem 1.5rem;
            animation: zoomIn 0.8s ease-out;
        }
        .why-donate-icon-wrapper {
            width: 4rem;
            height: 4rem;
        }
        .why-donate-title {
            font-size: 1.125rem; /* text-lg */
        }
        .cta-btn-special {
            padding: 1rem 2rem;
            font-size: 1rem;
        }
        .floating-element {
            font-size: 1.25rem;
        }

        /* Adjust section paddings for smaller screens */
        .py-20 {
            padding-top: 3.5rem !important;
            padding-bottom: 3.5rem !important;
        }
        .py-24 {
            padding-top: 4rem !important;
            padding-bottom: 4rem !important;
        }
    }
    
    @media (max-width: 640px) {
        /* General H1 for Hero */
        .text-4xl { font-size: 2.25rem !important; line-height: 1.2; } /* sm:text-4xl for H1 */
        
        /* General H2 for sections */
        .text-3xl { font-size: 2rem !important; line-height: 1.25; } /* sm:text-3xl for H2 */
        
        /* Intro paragraphs */
        .text-lg { font-size: 1rem !important; } /* sm:text-base for intro P */
        .text-xl { font-size: 1.125rem !important; } /* sm:text-lg for intro P */
        
        .grid-cols-4 {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
        
        .grid-cols-5 {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .category-image {
            height: 18rem; /* Smaller height for categories on small screens */
        }

        .product-img {
            height: 10rem; /* Smaller height for products on small screens */
        }
    }
</style>

<script>
function scrollContainer(containerId, direction) {
    const container = document.getElementById(containerId);
    // Adjust scroll amount based on screen size or card width
    const cardWidth = container.querySelector('.category-card-modern')?.offsetWidth || 320; // 320px for w-80
    const scrollAmount = cardWidth + 32; // card width + gap (2rem = 32px)
    
    if (direction === 'left') {
        container.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    } else {
        container.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const categoryGrid = document.getElementById('category-grid');
    if (categoryGrid) {
        // Add smooth scrolling behavior
        categoryGrid.style.scrollBehavior = 'smooth';
    }
});
</script>
@endpush