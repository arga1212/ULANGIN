@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Checkout</h1>

    {{-- Notifikasi Sukses/Error --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Oops! Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        
        {{-- ======================================================= --}}
        {{-- FORM CHECKOUT UTAMA (KOLOM KIRI) --}}
        {{-- ======================================================= --}}
        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="lg:col-span-3">
            @csrf
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-6">Informasi Pengiriman</h2>
                
                <div class="mb-4">
                    <label for="customer_name" class="block text-gray-700 font-bold mb-2">Nama Lengkap:</label>
                    <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
                <div class="mb-4">
                    <label for="customer_email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email', auth()->user()->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
                 <div class="mb-4">
                    <label for="customer_phone" class="block text-gray-700 font-bold mb-2">Nomor Telepon:</label>
                    <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
                <div class="mb-4">
                    <label for="customer_address" class="block text-gray-700 font-bold mb-2">Alamat Lengkap:</label>
                    <textarea name="customer_address" id="customer_address" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('customer_address') }}</textarea>
                </div>
                
                <hr class="my-6">
                
                <h2 class="text-2xl font-semibold mb-4">Pembayaran</h2>
                <p class="mb-4 text-gray-600">Silakan lakukan pembayaran ke QRIS di bawah ini dan unggah bukti transfer.</p>
                <div>
                    <img src="{{ asset('images/qris.png') }}" alt="QRIS Code" class="mx-auto w-64 h-64 border rounded">
                </div>
                 <div class="mt-6">
                    <label for="payment_proof" class="block text-gray-700 font-bold mb-2">Unggah Bukti Transfer:</label>
                    <input type="file" name="payment_proof" id="payment_proof" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
            </div>
             {{-- Tombol submit untuk form checkout utama diletakkan di kolom kanan agar menyatu --}}
        </form>

        {{-- ======================================================= --}}
        {{-- KOLOM KANAN (RINGKASAN, VOUCHER, TOMBOL SUBMIT) --}}
        {{-- ======================================================= --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-6">Ringkasan Pesanan</h2>
                <div class="space-y-4">
                    @foreach ($cart as $id => $details)
                    <div class="flex justify-between items-center">
                        <div><p class="font-semibold">{{ $details['product_name'] }} (x{{ $details['quantity'] }})</p></div>
                        <p>Rp {{ number_format($details['price'] * $details['quantity']) }}</p>
                    </div>
                    @endforeach
                </div>
                <hr class="my-6">

                @if (isset($voucher) && $voucher)
                    <div class="flex justify-between text-gray-600"><span>Subtotal</span><span>Rp {{ number_format($subtotal) }}</span></div>
                    <div class="flex justify-between text-green-600"><span>Diskon ({{ $voucher['discount_percent'] }}%)</span><span>- Rp {{ number_format($discount) }}</span></div>
                @endif
                
                <div class="flex justify-between font-bold text-xl mt-2"><span>Total</span><span>Rp {{ number_format($totalPrice) }}</span></div>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-md">
                @if (!isset($voucher) || !$voucher)
                {{-- FORM VOUCHER TERPISAH --}}
                <form action="{{ route('voucher.apply') }}" method="POST">
                    @csrf
                    <label for="voucher_code" class="block font-semibold mb-2">Punya Kode Voucher?</label>
                    <div class="flex gap-2">
                        <input type="text" name="voucher_code" id="voucher_code" class="w-full border rounded px-3 py-2" placeholder="Masukkan kode" required>
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Pakai</button>
                    </div>
                </form>
                @else
                <div class="flex justify-between items-center">
                    <p>Voucher <span class="font-bold text-green-600">{{ $voucher['code'] }}</span> terpasang!</p>
                    {{-- FORM HAPUS VOUCHER TERPISAH --}}
                    <form action="{{ route('voucher.remove') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </div>
                @endif
            </div>

            {{-- Tombol ini sekarang akan men-submit form checkout utama --}}
            <button type="submit" form="checkout-form" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
                Konfirmasi Pesanan
            </button>
        </div>
    </div>
</div>
@endsection

{{-- Kita perlu sedikit Javascript untuk membuat tombol submit di kolom kanan bisa men-trigger form di kolom kiri --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainForm = document.querySelector('form[action="{{ route('checkout.store') }}"]');
        const submitButton = document.querySelector('button[type="submit"][form="checkout-form"]');

        if (mainForm && submitButton) {
            // Beri ID pada form utama agar bisa ditarget
            mainForm.id = 'checkout-form';

            // Tombol submit sekarang akan secara eksplisit men-trigger form dengan ID 'checkout-form'
            // Atribut 'form="checkout-form"' pada tombol sudah menangani ini.
        }
    });
</script>
@endpush