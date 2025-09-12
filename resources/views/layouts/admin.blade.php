<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    
    {{-- Menggunakan Vite untuk mengelola aset, bukan CDN --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Mengubah tema dari oranye menjadi hitam/abu-abu agar konsisten */
        .nav-link::before {
            content: ''; position: absolute; left: 0; top: 0; height: 100%; width: 3px;
            background: black;
            transform: translateX(-100%); transition: transform 0.2s ease-in-out;
        }
        .nav-link.active::before { transform: translateX(0); }
        .nav-icon { display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; transition: transform 0.2s ease-in-out; }
        .nav-link:hover .nav-icon { transform: scale(1.1); }
        .sidebar-shadow { box-shadow: 4px 0 15px -3px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div x-data="{ sidebarOpen: false }">
        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-50 flex md:hidden" x-cloak>
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300" enter-start="opacity-0" enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300" leave-start="opacity-100" leave-end="opacity-0"
                 class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="sidebarOpen = false">
            </div>
            
            <div x-show="sidebarOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform" enter-start="-translate-x-full" enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform" leave-start="translate-x-0" leave-end="-translate-x-full"
                 class="relative flex-1 flex flex-col max-w-xs w-full bg-white sidebar-shadow">
                
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full ...">
                        <i class="fas fa-times text-lg text-white"></i>
                    </button>
                </div>
                
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto custom-scrollbar">
                    <div class="flex-shrink-0 flex items-center px-6 mb-8">
                        <div class="bg-black p-2 rounded-lg mr-3"><i class="fas fa-shield-alt text-white text-xl"></i></div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Admin Panel</h1>
                            <p class="text-xs text-gray-500">ULANGIN Store</p>
                        </div>
                    </div>
                    
                    <!-- Mobile Navigation (SUDAH DISESUAIKAN) -->
                    <nav class="mt-5 px-4 space-y-2">
                        @include('layouts.partials.admin-nav-links')
                    </nav>
                </div>
                
                <!-- Profile section -->
                @include('layouts.partials.admin-profile-section')
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <div class="flex-1 flex flex-col min-h-0 bg-white sidebar-shadow">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto custom-scrollbar">
                    <div class="flex items-center flex-shrink-0 px-6 mb-8">
                        <div class="bg-black p-2 rounded-lg mr-3"><i class="fas fa-shield-alt text-white text-xl"></i></div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Admin Panel</h1>
                            <p class="text-xs text-gray-500">ULANGIN Store</p>
                        </div>
                    </div>
                    
                    <!-- Desktop Navigation (SUDAH DISESUAIKAN) -->
                    <nav class="mt-5 flex-1 px-4 space-y-2">
                        @include('layouts.partials.admin-nav-links')
                    </nav>
                </div>
                
                <!-- Profile section -->
                @include('layouts.partials.admin-profile-section')
            </div>
        </div>
        
        <!-- Main content area -->
        <div class="md:pl-64 flex flex-col flex-1 min-h-screen">
            <!-- Mobile header -->
            <div class="sticky top-0 z-10 md:hidden bg-white/80 backdrop-blur-sm border-b border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <button @click="sidebarOpen = true" class="inline-flex ..."><i class="fas fa-bars text-lg"></i></button>
                    <a href="{{ route('home') }}" class="flex items-center space-x-3"><span class="text-lg font-bold text-gray-900">Admin Panel</span></a>
                </div>
            </div>
            
            <!-- Main content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <p class="font-bold">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <p class="font-bold">Oops! Ada beberapa kesalahan:</p>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>