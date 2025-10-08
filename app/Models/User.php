<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi untuk transaksi sebagai customer
    public function customerTransactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    // Relasi untuk transaksi sebagai cashier
    public function cashierTransactions()
    {
        return $this->hasMany(Transaction::class, 'cashier_id');
    }

    // Scope untuk user berdasarkan role
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Scope untuk kasir
    public function scopeCashiers($query)
    {
        return $query->where('role', 'kasir');
    }

    // Scope untuk pelanggan
    public function scopeCustomers($query)
    {
        return $query->where('role', 'pelanggan');
    }
}
