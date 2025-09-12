@extends('layouts.admin')

@section('title', isset($voucher) ? 'Edit Voucher' : 'Tambah Voucher Baru')

@section('content')
    {{-- Header Halaman --}}
    <div class="mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.vouchers.index') }}" class="text-gray-400 hover:text-black transition-colors">
                <i class="fas fa-arrow-left fa-lg"></i>
            </a>
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ isset($voucher) ? 'Edit Voucher' : 'Tambah Voucher Baru' }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ isset($voucher) ? 'Perbarui detail voucher di bawah ini.' : 'Isi form untuk membuat kode voucher diskon baru.' }}</p>
            </div>
        </div>
    </div>

    {{-- Kartu Form --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <form action="{{ isset($voucher) ? route('admin.vouchers.update', $voucher) : route('admin.vouchers.store') }}" method="POST">
            @csrf
            @if(isset($voucher)) @method('PUT') @endif
            
            <div class="p-6 space-y-4">
                {{-- Input Kode Voucher --}}
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Voucher</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $voucher->code ?? '') }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black"
                           placeholder="Contoh: HEMAT5">
                </div>
                
                {{-- Input Persentase Diskon --}}
                <div>
                    <label for="discount_percent" class="block text-sm font-medium text-gray-700 mb-1">Persentase Diskon (%)</label>
                    <input type="number" name="discount_percent" id="discount_percent" value="{{ old('discount_percent', $voucher->discount_percent ?? '5') }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black"
                           placeholder="Contoh: 5">
                </div>
                
                {{-- Input Status --}}
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_active" id="is_active" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                        <option value="1" @selected(old('is_active', $voucher->is_active ?? 1) == 1)>Aktif</option>
                        <option value="0" @selected(old('is_active', $voucher->is_active ?? 1) == 0)>Non-Aktif</option>
                    </select>
                </div>
            </div>
            
            {{-- Footer Aksi --}}
            <div class="p-6 bg-gray-50 border-t border-gray-200 rounded-b-xl">
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-black text-white font-semibold py-2 px-5 rounded-lg hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Simpan Voucher</span>
                    </button>
                    <a href="{{ route('admin.vouchers.index') }}" class="bg-gray-100 text-gray-700 font-semibold py-2 px-5 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection