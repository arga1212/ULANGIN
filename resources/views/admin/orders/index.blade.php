@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
    {{-- Header Halaman dengan Filter --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Manajemen Pesanan</h1>
                <p class="mt-1 text-sm text-gray-500">Lihat dan kelola semua pesanan yang masuk.</p>
            </div>
            {{-- Tambahkan form filter jika diperlukan di masa depan --}}
            {{-- <form action="{{ route('admin.orders.index') }}" method="GET">
                <input type="text" name="search" placeholder="Cari pelanggan..." class="w-full md:w-64 px-4 py-2 border rounded-lg">
            </form> --}}
        </div>
    </div>

    {{-- Tabel Pesanan yang Baru --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">ID</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Pelanggan</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Total</th>
                        <th scope="col" class="px-6 py-3 text-center font-semibold text-gray-600">Status</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">#{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->customer_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-semibold">Rp {{ number_format($order->total_price) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1 text-xs rounded-full font-semibold
                                @if($order->status == 'waiting') bg-yellow-100 text-yellow-800 border border-yellow-200 @endif
                                @if($order->status == 'process') bg-blue-100 text-blue-800 border border-blue-200 @endif
                                @if($order->status == 'dikirim') bg-green-100 text-green-800 border border-green-200 @endif
                                @if($order->status == 'done') bg-gray-100 text-gray-600 border border-gray-200 @endif
                            ">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                            <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-2 bg-black text-white text-xs px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">
                                <i class="fas fa-eye"></i>
                                <span>Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-16">
                            <i class="fas fa-receipt text-4xl text-gray-300"></i>
                            <p class="mt-4">Belum ada pesanan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi --}}
        @if ($orders->hasPages())
        <div class="p-4 bg-white border-t border-gray-200 rounded-b-xl">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
@endsection