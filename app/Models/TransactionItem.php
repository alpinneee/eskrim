<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relasi ke transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
