<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image',
    ];
    public function variants()
{
    return $this->hasMany(ProductVariant::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

// Accessor: Untuk mendapatkan total stok dari semua varian
public function getTotalStockAttribute()
{
    return $this->variants->sum('stock');
}

}