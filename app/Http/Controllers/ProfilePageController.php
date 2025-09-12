<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class ProfilePageController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Siapkan data untuk admin
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        
        // Siapkan data untuk user
        $userTotalOrders = $user->orders()->count();
        $cartItemCount = count(session('cart', []));

        return view('profile.show', compact(
            'user', 'totalUsers', 'totalProducts', 'totalOrders', 'userTotalOrders', 'cartItemCount'
        ));
    }
}