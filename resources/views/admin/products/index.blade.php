@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    {{-- Header Halaman dengan Tombol Aksi --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Manajemen Produk</h1>
                <p class="mt-1 text-sm text-gray-500">Tambah, edit, atau hapus produk Anda di sini.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="w-full md:w-auto bg-black text-white font-semibold py-2.5 px-5 rounded-lg hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Tambah Produk</span>
            </a>
        </div>
    </div>

    {{-- Tabel Produk yang Baru --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Gambar</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Nama Produk</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Harga</th>
                        <th scope="col" class="px-6 py-3 text-center font-semibold text-gray-600">Total Stok</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            {{ $product->category->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-semibold">
                            Rp {{ number_format($product->price) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-800 font-bold">
                            {{ $product->total_stock }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-2 rounded-md text-xs font-semibold">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-md text-xs font-semibold">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-16">
                            <i class="fas fa-box-open text-4xl text-gray-300"></i>
                            <p class="mt-4">Anda belum menambahkan produk apapun.</p>
                            <a href="{{ route('admin.products.create') }}" class="mt-4 text-blue-500 font-semibold hover:underline">Mulai Tambah Produk</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi --}}
        @if ($products->hasPages())
        <div class="p-4 bg-white border-t border-gray-200 rounded-b-xl">
            {{ $products->links() }}
        </div>
        @endif
    </div>
@endsection