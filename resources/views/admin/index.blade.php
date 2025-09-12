@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Manajemen Pesanan</h1>

<div class="bg-white shadow-md rounded-lg">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">ID Pesanan</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">Pelanggan</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">Tanggal</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">Total</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center">Status</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">#{{ $order->id }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $order->customer_name }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $order->created_at->format('d M Y') }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Rp {{ number_format($order->total_price) }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <span class="px-3 py-1 text-xs rounded-full font-semibold
                        @if($order->status == 'waiting') bg-yellow-200 text-yellow-800 @endif
                        @if($order->status == 'process') bg-blue-200 text-blue-800 @endif
                        @if($order->status == 'dikirim') bg-green-200 text-green-800 @endif
                        @if($order->status == 'done') bg-gray-300 text-gray-800 @endif
                    ">{{ ucfirst($order->status) }}</span>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-10">Belum ada pesanan masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-5">
        {{ $orders->links() }}
    </div>
</div>
@endsection