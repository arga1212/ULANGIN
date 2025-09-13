<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <title>{{ config('app.name', 'Toko Baju') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex flex-col min-h-screen">
            <!-- Navigation -->
            <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                       
                        <!-- Logo (Tetap di kiri) -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <img class="block h-12 w-auto" src="{{ asset('logo.png') }}" alt="Logo Toko">
                            </a>
                        </div>

                        <!-- Link Navigasi Tengah (Hanya Desktop) -->
                        <div class="hidden md:flex items-center space-x-8">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-black font-medium border-b-2 py-2 {{ request()->routeIs('home') ? 'border-black text-black' : 'border-transparent' }}">Home</a>
                            <a href="{{ route('shop.index') }}" class="text-gray-600 hover:text-black font-medium border-b-2 py-2 {{ request()->routeIs('shop.index*') ? 'border-black text-black' : 'border-transparent' }}">Shop</a>
                             @auth
                            <a href="{{ route('my-orders.index') }}" class="text-gray-600 hover:text-black font-medium border-b-2 py-2 {{ request()->routeIs('my-orders.index') ? 'border-black text-black' : 'border-transparent' }}">Pesanan Saya</a>
                             @endauth
                        </div>

                        <!-- Ikon Kanan (Desktop & Mobile Burger) -->
                        <div class="flex items-center">
                            <!-- Ikon & Auth Links untuk Desktop -->
                            <div class="hidden md:flex items-center space-x-4">
                                @guest
                                    <a href="{{ route('register') }}" class="bg-black text-white hover:bg-gray-800 px-5 py-2 rounded-md font-medium text-sm transition-colors">Daftar</a>
                                    <a href="{{ route('login') }}" class="border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 font-medium text-sm rounded-md transition-colors">Masuk</a>
                                @else
                                    <div class="flex items-center space-x-6">
                                        <!-- Ikon Keranjang -->
                                        <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-black relative">
                                            <i class="fas fa-shopping-cart text-xl"></i>
                                            @if(session('cart') && count(session('cart')) > 0)
                                            <span class="absolute -top-2 -right-2 bg-black text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                                {{ count(session('cart')) }}
                                            </span>
                                            @endif
                                        </a>
                                        @if (Auth::user()->is_admin)
                                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-black" title="Admin Dashboard"><i class="fas fa-user-shield text-xl"></i></a>
                                        @endif

                                        <!-- User Profile Dropdown -->
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition">
                                                    @if(Auth::user()->profile_image)
                                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
                                                    @else
                                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=FFFFFF&background=1F2937' }}" alt="{{ Auth::user()->name }}">
                                                    @endif
                                                    <div class="ml-2 hidden lg:block">{{ Auth::user()->name }}</div>
                                                    <div class="ms-1"><i class="fas fa-chevron-down text-xs"></i></div>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('profile.show')"><i class="fas fa-user mr-2 w-4"></i> Profile</x-dropdown-link>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="fas fa-sign-out-alt mr-2 w-4"></i> {{ __('Log Out') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @endguest
                            </div>
                            
                            <!-- Burger Menu Button (Hanya Mobile) -->
                            <div class="md:hidden flex items-center">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-black bg-gray-50 text-black' : 'border-transparent text-gray-600' }}">Home</a>
                        <a href="{{ route('shop.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('shop.index*') ? 'border-black bg-gray-50 text-black' : 'border-transparent text-gray-600' }}">Shop</a>
                         @auth
                        <a href="{{ route('my-orders.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('my-orders.index') ? 'border-black bg-gray-50 text-black' : 'border-transparent text-gray-600' }}">Pesanan Saya</a>
                         @endauth
                    </div>
                    
                    <!-- Mobile Auth Links -->
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        @guest
                            <div class="px-4 space-y-2">
                                <a href="{{ route('register') }}" class="block text-center bg-black text-white py-2 rounded-md">Daftar</a>
                                <a href="{{ route('login') }}" class="block text-center border border-gray-300 py-2 rounded-md">Masuk</a>
                            </div>
                        @else
                            <div class="flex items-center px-4">
                                <div class="flex-shrink-0">
                                    {{-- ... (gambar profil mobile) ... --}}
                                </div>
                                <div class="ml-3">
                                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <div class="mt-3 space-y-1">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-base ...">Profile</a>
                                {{-- Ikon Keranjang Mobile --}}
                                <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-base ...">Keranjang</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="..." class="block px-4 py-2 ...">Log Out</a>
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot ?? '' }} 
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t mt-auto">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-gray-500 text-sm">
                        © {{ date('Y') }} ULANGIN. All Rights Reserved.
                    </div>
                </div>
            </footer>
        </div>
        @stack('scripts')
    </body>
</html>