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
        'product_variant_id',
        'size',
        'quantity',
        'price',
    ];

    /**
     * Mendapatkan order yang memiliki item ini.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mendapatkan produk utama dari item ini.
     * Ini adalah relasi yang kemungkinan besar salah.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mendapatkan varian spesifik dari item ini.
     */
    public function variant()
    {
        // Pastikan nama foreign key-nya benar
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}