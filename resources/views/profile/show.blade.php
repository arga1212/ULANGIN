@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-black mb-2">Profil Saya</h1>
            <p class="text-gray-600">Kelola informasi personal dan pengaturan akun Anda.</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Profile Header -->
            <div class="relative bg-black px-8 py-12">
                <div class="flex flex-col items-center text-center">
                    <!-- Avatar -->
                    <div class="mb-4">
                        @if(Auth::user()->profile_image)
                            <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
                        @else
                            <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg" src="{{ 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=FFFFFF&background=1F2937&size=256' }}" alt="{{ Auth::user()->name }}">
                        @endif
                    </div>
                    
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $user->name }}</h2>
                </div>
                
                <!-- Edit Button -->
                <div class="absolute top-6 right-6">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-lg transition-all duration-200 hover:scale-105">
                        <i class="fas fa-pen w-4 h-4 mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Personal</h3>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center mr-4"><i class="fas fa-user text-white"></i></div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Lengkap</p>
                                <p class="text-gray-800 font-medium">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center mr-4"><i class="fas fa-envelope text-white"></i></div>
                            <div>
                                <p class="text-sm text-gray-500">Alamat Email</p>
                                <p class="text-gray-800 font-medium">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Akun</h3>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center mr-4">
                                @if($user->email_verified_at) <i class="fas fa-check-circle text-white"></i> @else <i class="fas fa-times-circle text-white"></i> @endif
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Verifikasi Email</p>
                                @if($user->email_verified_at)
                                    <p class="text-black font-medium">Terverifikasi</p>
                                @else
                                    <p class="text-gray-600 font-medium">Belum terverifikasi</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center mr-4"><i class="fas fa-calendar-alt text-white"></i></div>
                            <div>
                                <p class="text-sm text-gray-500">Bergabung Sejak</p>
                                <p class="text-gray-800 font-medium">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            @if(Auth::user()->is_admin)
                {{-- STATS UNTUK ADMIN --}}
                <div class="bg-white rounded-xl shadow-md p-6"><div class="flex items-center"><div class="w-12 h-12 bg-black ..."><i class="fas fa-users text-white"></i></div><div class="ml-4"><p>Total Pengguna</p><p class="text-2xl font-bold">{{ $totalUsers }}</p></div></div></div>
                <div class="bg-white rounded-xl shadow-md p-6"><div class="flex items-center"><div class="w-12 h-12 bg-black ..."><i class="fas fa-box text-white"></i></div><div class="ml-4"><p>Total Produk</p><p class="text-2xl font-bold">{{ $totalProducts }}</p></div></div></div>
                <div class="bg-white rounded-xl shadow-md p-6"><div class="flex items-center"><div class="w-12 h-12 bg-black ..."><i class="fas fa-receipt text-white"></i></div><div class="ml-4"><p>Total Pesanan</p><p class="text-2xl font-bold">{{ $totalOrders }}</p></div></div></div>
            @else
                {{-- STATS UNTUK USER BIASA --}}
                <div class="bg-white rounded-xl shadow-md p-6"><div class="flex items-center"><div class="w-12 h-12 bg-black ..."><i class="fas fa-receipt text-white"></i></div><div class="ml-4"><p>Total Pesanan</p><p class="text-2xl font-bold">{{ $userTotalOrders }}</p></div></div></div>
                <div class="bg-white rounded-xl shadow-md p-6"><div class="flex items-center"><div class="w-12 h-12 bg-black ..."><i class="fas fa-shopping-cart text-white"></i></div><div class="ml-4"><p>Item di Keranjang</p><p class="text-2xl font-bold">{{ $cartItemCount }}</p></div></div></div>
            @endif
        </div>
    </div>
</div>
@endsection