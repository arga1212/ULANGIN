@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    {{-- Header Halaman --}}
    <div>
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500">Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center"><i class="fas fa-dollar-sign text-2xl text-green-600"></i></div>
            <div><p class="text-sm text-gray-500">Total Pendapatan</p><p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalRevenue) }}</p></div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center"><i class="fas fa-receipt text-xl text-yellow-600"></i></div>
            <div><p class="text-sm text-gray-500">Pesanan Baru</p><p class="text-2xl font-bold text-gray-800">{{ $newOrders }}</p></div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fas fa-shopping-cart text-xl text-blue-600"></i></div>
            <div><p class="text-sm text-gray-500">Total Pesanan</p><p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p></div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center"><i class="fas fa-users text-xl text-indigo-600"></i></div>
            <div><p class="text-sm text-gray-500">Total Pelanggan</p><p class="text-2xl font-bold text-gray-800">{{ $totalCustomers }}</p></div>
        </div>
    </div>

    {{-- Layout Utama (Grafik & Pesanan Terbaru) --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Grafik Penjualan (Kolom Kiri) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Laporan Penjualan (7 Hari Terakhir)</h2>
            </div>
            <div class="p-6">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Pesanan Terbaru (Kolom Kanan) -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Pesanan Terbaru</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse ($latestOrders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="block p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">#{{ $order->id }} - {{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-800">Rp {{ number_format($order->total_price) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500 p-8">Belum ada pesanan.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- Sertakan Chart.js dari CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line', // Jenis grafik: line, bar, pie, dll.
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($chartData),
                    backgroundColor: 'rgba(17, 24, 39, 0.1)',
                    borderColor: 'rgba(17, 24, 39, 1)', // Warna hitam
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4 // Membuat garis melengkung
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush