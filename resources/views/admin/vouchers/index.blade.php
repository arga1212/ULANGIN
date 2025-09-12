@extends('layouts.admin')

@section('title', 'Manajemen Voucher')

@section('content')
    {{-- Header Halaman dengan Tombol Aksi --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Manajemen Voucher</h1>
                <p class="mt-1 text-sm text-gray-500">Buat, edit, atau hapus kode voucher diskon.</p>
            </div>
            <a href="{{ route('admin.vouchers.create') }}" class="w-full md:w-auto bg-black text-white font-semibold py-2.5 px-5 rounded-lg hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Tambah Voucher</span>
            </a>
        </div>
    </div>

    {{-- Tabel Voucher yang Baru --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600">Kode Voucher</th>
                        <th scope="col" class="px-6 py-3 text-center font-semibold text-gray-600">Diskon</th>
                        <th scope="col" class="px-6 py-3 text-center font-semibold text-gray-600">Status</th>
                        <th scope="col" class="px-6 py-3 text-center font-semibold text-gray-600">Terpakai?</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($vouchers as $voucher)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800 font-mono">{{ $voucher->code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-800 font-semibold">{{ $voucher->discount_percent }}%</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($voucher->is_active)
                                <span class="px-3 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800 border border-green-200">Aktif</span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-800 border border-red-200">Non-Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($voucher->used_at)
                                <span class="px-3 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600 border border-gray-200">Ya</span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full font-semibold bg-blue-100 text-blue-800 border border-blue-200">Belum</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-2 rounded-md text-xs font-semibold">Edit</a>
                                <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus voucher ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-md text-xs font-semibold">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-16">
                            <i class="fas fa-ticket-alt text-4xl text-gray-300"></i>
                            <p class="mt-4">Belum ada voucher yang dibuat.</p>
                            <a href="{{ route('admin.vouchers.create') }}" class="mt-4 text-blue-500 font-semibold hover:underline">Mulai Buat Voucher</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($vouchers->hasPages())
        <div class="p-4 bg-white border-t border-gray-200 rounded-b-xl">
            {{ $vouchers->links() }}
        </div>
        @endif
    </div>
@endsection