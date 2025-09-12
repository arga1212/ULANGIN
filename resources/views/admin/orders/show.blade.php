@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    {{-- Header Halaman --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-black transition-colors inline-flex items-center gap-2 mb-2">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Pesanan
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
            <p class="mt-1 text-sm text-gray-500">Dibuat pada: {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="flex-shrink-0">
            <span class="px-4 py-2 text-sm rounded-full font-semibold
                @if($order->status == 'waiting') bg-yellow-100 text-yellow-800 border border-yellow-200 @endif
                @if($order->status == 'process') bg-blue-100 text-blue-800 border border-blue-200 @endif
                @if($order->status == 'dikirim') bg-green-100 text-green-800 border border-green-200 @endif
                @if($order->status == 'done') bg-gray-100 text-gray-600 border border-gray-200 @endif
            ">Status: {{ ucfirst($order->status) }}</span>
        </div>
    </div>

    {{-- Layout Utama (Grid) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Utama (Kiri) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Kartu Item Pesanan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Item yang Dipesan</h2>
                </div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        {{-- ... (Isi tabel tidak berubah, sudah bagus) ... --}}
                        <tfoot class="text-right">
                            @php $subtotal = $order->items->sum(fn($item) => $item->price * $item->quantity); @endphp
                            <tr class="font-semibold"><td colspan="3" class="py-2">Subtotal:</td><td class="py-2">Rp {{ number_format($subtotal) }}</td></tr>
                            @if ($order->voucher_code)
                                <tr class="text-green-600"><td colspan="3" class="py-2">Diskon ({{ $order->voucher_code }}):</td><td class="py-2">- Rp {{ number_format($subtotal - $order->total_price) }}</td></tr>
                            @endif
                            <tr class="font-bold text-xl border-t-2"><td colspan="3" class="pt-4">Total Akhir:</td><td class="pt-4">Rp {{ number_format($order->total_price) }}</td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Kartu Info Pelanggan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Pelanggan & Pengiriman</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <div><p class="text-gray-500">Nama</p><p class="font-semibold text-gray-800">{{ $order->customer_name }}</p></div>
                    <div><p class="text-gray-500">Email</p><p class="font-semibold text-gray-800">{{ $order->customer_email }}</p></div>
                    <div><p class="text-gray-500">Telepon</p><p class="font-semibold text-gray-800">{{ $order->customer_phone }}</p></div>
                    <div class="sm:col-span-2"><p class="text-gray-500">Alamat</p><p class="font-semibold text-gray-800 whitespace-pre-wrap">{{ $order->customer_address }}</p></div>
                </div>
            </div>
        </div>

        <!-- Kolom Samping (Kanan) -->
        <div class="space-y-8">
            <!-- Kartu Aksi -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Aksi Pesanan</h2>
                </div>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Ubah Status</label>
                            <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                                <option value="waiting" @selected($order->status == 'waiting')>Menunggu Konfirmasi</option>
                                <option value="process" @selected($order->status == 'process')>Diproses</option>
                                <option value="dikirim" @selected($order->status == 'dikirim')>Dikirim</option>
                                <option value="done" @selected($order->status == 'done')>Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label for="shipping_receipt" class="block text-sm font-medium text-gray-700 mb-1">Nomor Resi</label>
                            <input type="text" name="shipping_receipt" id="shipping_receipt" value="{{ old('shipping_receipt', $order->shipping_receipt) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" placeholder="Opsional...">
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-black text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>Update Status</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kartu Bukti Pembayaran -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Bukti Pembayaran</h2>
                </div>
                <div class="p-6">
                    @if ($order->payment_proof)
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block group">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="w-full rounded-lg transition-transform duration-300 group-hover:scale-105">
                        </a>
                    @else
                        <p class="text-center text-gray-500 py-8">Tidak ada bukti pembayaran.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection