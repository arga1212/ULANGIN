@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-black mb-3">Profil Saya</h1>
            <p class="text-gray-600 text-lg">Kelola informasi personal dan pengaturan akun Anda</p>
        </div>

        <!-- Main Profile Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8 border border-gray-200">
            <!-- Profile Header -->
            <div class="relative bg-black px-8 py-16">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
                
                <div class="relative flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    <!-- Avatar -->
                    <div class="relative">
                        @if(Auth::user()->profile_image)
                            <img class="h-32 w-32 rounded-3xl object-cover border-4 border-white/20 shadow-2xl" 
                                 src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                                 alt="{{ Auth::user()->name }}">
                        @else
                            <img class="h-32 w-32 rounded-3xl object-cover border-4 border-white/20 shadow-2xl" 
                                 src="{{ 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=FFFFFF&background=1F2937&size=256' }}" 
                                 alt="{{ Auth::user()->name }}">
                        @endif
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gray-600 border-4 border-white rounded-full"></div>
                    </div>
                    
                    <!-- User Info -->
                    <div class="text-center sm:text-left flex-1">
                        <h2 class="text-3xl font-bold text-white mb-2">{{ $user->name }}</h2>
                        <p class="text-white/80 text-lg mb-4">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-sm rounded-full">
                                {{ Auth::user()->is_admin ? 'Administrator' : 'Member' }}
                            </span>
                            @if($user->email_verified_at)
                                <span class="px-3 py-1 bg-white/30 backdrop-blur-sm text-white text-sm rounded-full">
                                    <i class="fas fa-check mr-1"></i>Terverifikasi
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="sm:absolute top-6 right-6">
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white text-gray-900 rounded-2xl font-semibold transition-all duration-300 hover:bg-gray-100 hover:scale-105 hover:shadow-xl">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-black">Informasi Personal</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="group p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</p>
                                        <p class="text-black font-semibold text-lg">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 mb-1">Alamat Email</p>
                                        <p class="text-black font-semibold">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center">
                                <i class="fas fa-cog text-white text-sm"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-black">Informasi Akun</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="group p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-{{ $user->email_verified_at ? 'black' : 'gray-400' }} rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas {{ $user->email_verified_at ? 'fa-check-circle' : 'fa-times-circle' }} text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 mb-1">Status Verifikasi</p>
                                        <p class="font-semibold {{ $user->email_verified_at ? 'text-black' : 'text-gray-600' }}">
                                            {{ $user->email_verified_at ? 'Email Terverifikasi' : 'Belum Terverifikasi' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="group p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-calendar-alt text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 mb-1">Bergabung Sejak</p>
                                        <p class="text-black font-semibold">{{ $user->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(Auth::user()->is_admin)
                {{-- STATS UNTUK ADMIN --}}
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-users text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
                                    <p class="text-3xl font-bold text-black">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-black"></div>
                </div>

                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gray-700 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-box text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Produk</p>
                                    <p class="text-3xl font-bold text-black">{{ $totalProducts }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gray-700"></div>
                </div>

                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden sm:col-span-2 lg:col-span-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gray-800 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-receipt text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Pesanan</p>
                                    <p class="text-3xl font-bold text-black">{{ $totalOrders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gray-800"></div>
                </div>
            @else
                {{-- STATS UNTUK USER BIASA --}}
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden sm:col-span-2 lg:col-span-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-receipt text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Pesanan</p>
                                    <p class="text-3xl font-bold text-black">{{ $userTotalOrders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-black"></div>
                </div>

                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gray-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-shopping-cart text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Item di Keranjang</p>
                                    <p class="text-3xl font-bold text-black">{{ $cartItemCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gray-600"></div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection