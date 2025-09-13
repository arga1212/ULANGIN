<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} - Login</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Menggunakan 'bg-gray-100' sebagai dasar --}}
        <div class="min-h-screen flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 bg-gray-100">
            <div class="w-full max-w-md space-y-8">
                <div>
                    <a href="/">
                        <img class="mx-auto h-14 w-auto" src="{{ asset('logo.png') }}" alt="Logo Toko">
                    </a>
                    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                        Selamat Datang Kembali
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Masuk untuk melanjutkan belanja.
                    </p>
                </div>

                <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8">
                    <!-- Session Status & Validation Errors -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-md">{{ session('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 p-3 rounded-md">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-black hover:underline" href="{{ route('password.request') }}">Lupa password?</a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                        </div>

                        <!-- Tombol Login -->
                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition-colors">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-black hover:underline">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>