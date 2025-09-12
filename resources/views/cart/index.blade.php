@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

    {{-- Notifikasi --}}
    @if (session('success')) <div class="bg-green-100 ... mb-6">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="bg-red-100 ... mb-6">{{ session('error') }}</div> @endif

    @if (!empty($cart))
        {{-- FORM UTAMA SEKARANG MEMBUNGKUS SELURUH TABEL --}}
        <form action="{{ route('cart.updateAndCheckout') }}" method="POST">
            @csrf
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 text-left">Produk</th>
                                <th class="px-5 py-3 border-b-2 text-left">Harga</th>
                                <th class="px-5 py-3 border-b-2 text-left">Jumlah</th>
                                <th class="px-5 py-3 border-b-2 text-left">Subtotal</th>
                                <th class="px-5 py-3 border-b-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPrice = 0; @endphp
                            @foreach ($cart as $variantId => $details)
                                @php $subtotal = $details['price'] * $details['quantity']; $totalPrice += $subtotal; @endphp
                                <tr>
                                    <td class="px-5 py-5 border-b">
                                        <div class="flex items-center">
                                            <img class="w-20 h-20 object-cover rounded mr-4" src="{{ asset('storage/' . $details['image']) }}">
                                            <div>
                                                <p class="font-semibold">{{ $details['product_name'] }}</p>
                                                <p class="text-sm text-gray-500">Ukuran: {{ $details['size'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b">Rp {{ number_format($details['price']) }}</td>
                                    <td class="px-5 py-5 border-b">
                                        {{-- Input jumlah sekarang menjadi bagian dari array --}}
                                        <input type="number" name="quantities[{{ $variantId }}]" value="{{ $details['quantity'] }}" min="1" class="w-20 border rounded text-center">
                                    </td>
                                    <td class="px-5 py-5 border-b">Rp {{ number_format($subtotal) }}</td>
                                    <td class="px-5 py-5 border-b">
<form action="{{ route('cart.remove', $variantId) }}" method="POST">
    @csrf
    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
</form>                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-right mt-8">
                    <p class="text-2xl font-bold">Total: Rp {{ number_format($totalPrice) }}</p>
                    {{-- TOMBOL INI SEKARANG MEN-SUBMIT FORM --}}
                    <button type="submit" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
                        Lanjut ke Checkout
                    </button>
                </div>
            </div>
        </form>
    @else
        <div class="text-center bg-white p-10 rounded-lg shadow-md">
            {{-- ... (bagian keranjang kosong tidak berubah) ... --}}
        </div>
    @endif
</div>
@endsection