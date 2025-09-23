@extends('layouts.admin')

@section('title', 'Buat Invoice Custom')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Buat Invoice Custom</h1>
        <p class="mt-1 text-sm text-gray-500">Buat pesanan untuk produk custom atau personal order.</p>
    </div>

    <form action="{{ route('admin.invoices.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Form Input -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Kartu Info Pelanggan -->
                <div class="bg-white rounded-xl shadow-lg border p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Informasi Pelanggan</h2>
                    <div class="space-y-4">
                        <input type="text" name="customer_name" placeholder="Nama Pelanggan" class="w-full border-gray-300 rounded-md" value="{{ old('customer_name') }}" required>
                        <input type="email" name="customer_email" placeholder="Email" class="w-full border-gray-300 rounded-md" value="{{ old('customer_email') }}" required>
                        <input type="text" name="customer_phone" placeholder="Nomor Telepon" class="w-full border-gray-300 rounded-md" value="{{ old('customer_phone') }}" required>
                        <textarea name="customer_address" placeholder="Alamat Lengkap" rows="3" class="w-full border-gray-300 rounded-md" required>{{ old('customer_address') }}</textarea>
                    </div>
                </div>

                <!-- Kartu Info Produk Custom -->
                <div class="bg-white rounded-xl shadow-lg border p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Informasi Produk Custom</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium">Nama Produk</label>
                            <input type="text" name="product_name" class="mt-1 w-full border-gray-300 rounded-md" placeholder="e.g., Jaket Denim Custom 'Nama'" required>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Deskripsi Singkat</label>
                            <textarea name="product_description" rows="3" class="mt-1 w-full border-gray-300 rounded-md" required></textarea>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Harga Final (Total)</label>
                            <input type="number" name="product_price" min="0" class="mt-1 w-full border-gray-300 rounded-md" placeholder="e.g., 250000" required>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Gambar Produk (Untuk Portofolio)</label>
                            <input type="file" name="product_image" class="mt-1 w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Aksi -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Aksi</h2>
                    <p class="text-sm text-gray-600 mb-6">Setelah diisi, klik tombol di bawah untuk membuat pesanan dan langsung mengunduh file PDF invoice-nya.</p>
                    <button type="submit" class="w-full bg-black text-white font-semibold py-3 px-4 rounded-lg hover:bg-gray-800 flex items-center justify-center gap-2">
                        <i class="fas fa-file-invoice"></i>
                        <span>Generate & Unduh Invoice</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection