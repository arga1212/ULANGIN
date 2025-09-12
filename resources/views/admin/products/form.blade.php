@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk Baru')

@section('content')

@php
    if (isset($product) && $product->variants->isNotEmpty()) {
        $variantsForAlpine = old('variants', $product->variants->toArray());
    } else {
        $variantsForAlpine = old('variants', [['id' => null, 'size' => '', 'stock' => '']]);
    }
@endphp

{{-- Header Halaman --}}
<div class="mb-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-black transition-colors">
            <i class="fas fa-arrow-left fa-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ isset($product) ? 'Perbarui detail produk di bawah ini.' : 'Isi form di bawah ini untuk menambahkan produk baru.' }}</p>
        </div>
    </div>
</div>

<form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($product)) @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Info Utama & Varian -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Kartu Info Produk -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6 border-b"><h2 class="text-xl font-semibold text-gray-800">Informasi Produk</h2></div>
                <div class="p-6 space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Varian Produk -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100" x-data='{ variants: @json($variantsForAlpine) }'>
                <div class="p-6 border-b"><h2 class="text-xl font-semibold text-gray-800">Ukuran & Stok</h2></div>
                <div class="p-6">
                    <div class="space-y-3">
                        <template x-for="(variant, index) in variants" :key="index">
                            <div class="flex items-center gap-4">
                                <input type="hidden" :name="`variants[${index}][id]`" x-model="variant.id">
                                <input type="text" :name="`variants[${index}][size]`" x-model="variant.size" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" placeholder="Ukuran (e.g., S, M, L)" required>
                                <input type="number" :name="`variants[${index}][stock]`" x-model="variant.stock" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" placeholder="Stok" required>
                                <button type="button" @click="if (variants.length > 1) variants.splice(index, 1)" class="flex-shrink-0 bg-red-500 text-white w-9 h-9 rounded-md disabled:bg-gray-300" :disabled="variants.length <= 1">&times;</button>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="variants.push({ id: null, size: '', stock: '' })" class="mt-4 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md inline-flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Ukuran</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Gambar & Aksi -->
        <div class="space-y-8">
            <!-- Kartu Gambar Produk -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6 border-b"><h2 class="text-xl font-semibold text-gray-800">Gambar Produk</h2></div>
                <div class="p-6">
                    <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800">
                    @if (isset($product) && $product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="mt-4 w-full h-auto object-cover rounded-lg">
                    @endif
                </div>
            </div>

            <!-- Kartu Aksi Simpan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <button type="submit" class="w-full bg-black text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>{{ isset($product) ? 'Simpan Perubahan' : 'Simpan Produk' }}</span>
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="w-full text-center bg-gray-100 text-gray-700 font-semibold py-2.5 px-4 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection