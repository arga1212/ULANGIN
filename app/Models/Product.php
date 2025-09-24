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
        'thumbnail',
    ];
    public function variants()
{
    return $this->hasMany(ProductVariant::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

 public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function images()
{
    return $this->hasMany(ProductImage::class);
}
// Accessor: Untuk mendapatkan total stok dari semua varian
public function getTotalStockAttribute()
{
    return $this->variants->sum('stock');
}

}