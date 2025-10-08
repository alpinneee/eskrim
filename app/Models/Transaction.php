<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'cashier_id',
        'total_amount',
        'payment_method',
        'status',
        'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    // Relasi ke customer (pelanggan)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi ke cashier (kasir)
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    // Relasi ke transaction items
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
