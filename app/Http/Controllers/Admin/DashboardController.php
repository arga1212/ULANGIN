<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Kartu
        $totalRevenue = Order::where('status', 'done')->sum('total_price');
        $totalOrders = Order::count();
        $newOrders = Order::where('status', 'waiting')->count();
        $totalCustomers = User::where('is_admin', false)->count();

        // 2. Data untuk Grafik Penjualan 7 Hari Terakhir
        $salesData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
        ->where('status', 'done')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Format data untuk Chart.js
        $chartLabels = [];
        $chartData = [];
        $period = Carbon::now()->subDays(6)->toPeriod(Carbon::now()); // Periode 7 hari
        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $chartLabels[] = $date->format('d M'); // Format label (e.g., 10 Sep)
            
            $sale = $salesData->firstWhere('date', $formattedDate);
            $chartData[] = $sale ? $sale->total : 0;
        }
        
        // 3. Pesanan Terbaru
        $latestOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'newOrders',
            'totalCustomers',
            'chartLabels',
            'chartData',
            'latestOrders'
        ));
    }
}