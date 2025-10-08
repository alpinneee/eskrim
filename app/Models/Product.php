<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'image',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scope untuk produk yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk produk berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
