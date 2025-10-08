<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;

class CustomerTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama sebagai customer
        $customer = User::first();
        
        if (!$customer) {
            return;
        }

        // Sample transaksi untuk 7 hari terakhir
        $transactions = [
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 45000, // Vanilla + Chocolate
                'status' => 'completed',
                'notes' => json_encode([1 => 1, 2 => 1]), // Product ID => Quantity
                'created_at' => now()->subDays(6)
            ],
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 67000, // Strawberry + Mint Chocolate Chip
                'status' => 'completed',
                'notes' => json_encode([3 => 1, 4 => 1]),
                'created_at' => now()->subDays(5)
            ],
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 25000, // Cookies & Cream
                'status' => 'completed',
                'notes' => json_encode([5 => 1]),
                'created_at' => now()->subDays(4)
            ],
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 53000, // Mango + Coffee
                'status' => 'completed',
                'notes' => json_encode([6 => 1, 7 => 1]),
                'created_at' => now()->subDays(3)
            ],
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 21000, // Blueberry
                'status' => 'completed',
                'notes' => json_encode([8 => 1]),
                'created_at' => now()->subDays(2)
            ],
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 60000, // Rocky Road + Pistachio
                'status' => 'completed',
                'notes' => json_encode([9 => 1, 10 => 1]),
                'created_at' => now()->subDays(1)
            ],
            [
                'customer_id' => $customer->id,
                'cashier_id' => $customer->id,
                'total_amount' => 33000, // Vanilla + Strawberry
                'status' => 'pending',
                'notes' => json_encode([1 => 1, 3 => 1]),
                'created_at' => now()
            ]
        ];

        // Safety check untuk transactions array
        if (!is_array($transactions) || empty($transactions)) {
            throw new \Exception('Transactions array is null or empty in CustomerTransactionSeeder');
        }

        foreach ($transactions as $transaction) {
            if (!is_array($transaction) || !isset($transaction['customer_id'], $transaction['total_amount'])) {
                continue; // Skip invalid transaction data
            }
            Transaction::create($transaction);
        }
    }
}
