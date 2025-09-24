<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id', // <-- TAMBAHKAN INI
        'size',               // <-- TAMBAHKAN INI
        'quantity',
        'price',
    ];

    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }

    // --- TAMBAHKAN RELASI BARU INI ---
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
        
    }
     public function rating()
    {
        return $this->hasOne(ProductRating::class);
    }
}