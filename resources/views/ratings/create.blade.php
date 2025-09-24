@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-12 max-w-2xl">
    <h1 class="text-3xl font-bold mb-2">Beri Ulasan</h1>
    <p class="text-gray-600 mb-8">Bagaimana pendapat Anda tentang produk ini?</p>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 flex items-center space-x-4">
        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-24 h-24 rounded-md object-cover">
        <div>
            <h2 class="text-xl font-bold">{{ $orderItem->product->name }}</h2>
            <p class="text-sm text-gray-500">Ukuran: {{ $orderItem->size }}</p>
        </div>
    </div>

    <form action="{{ route('ratings.store') }}" method="POST" class="bg-white rounded-xl shadow-lg p-6"
          x-data="{ rating: 0, hoverRating: 0 }">
        @csrf
        <input type="hidden" name="order_item_id" value="{{ $orderItem->id }}">
        
        <div class="mb-4">
            <label class="block font-semibold mb-2">Rating Anda:</label>
            <div class="flex items-center space-x-1 text-3xl text-gray-300">
                <template x-for="star in 5">
                    <i class="fas fa-star cursor-pointer"
                       @click="rating = star"
                       @mouseenter="hoverRating = star"
                       @mouseleave="hoverRating = 0"
                       :class="{ 'text-yellow-400': hoverRating >= star || rating >= star }"></i>
                </template>
            </div>
            <input type="hidden" name="rating" x-model="rating">
            @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="review" class="block font-semibold mb-2">Ulasan Anda (Opsional):</label>
            <textarea name="review" id="review" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" placeholder="Ceritakan pengalaman Anda..."></textarea>
        </div>

        <button type="submit" class="w-full bg-black text-white font-semibold py-3 px-4 rounded-lg hover:bg-gray-800">
            Kirim Ulasan
        </button>
    </form>
</div>
@endsection