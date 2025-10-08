<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data user dan product yang sudah ada dari seeder lain
        $customerIds = User::where('role', 'pelanggan')->pluck('id')->toArray();
        $cashierIds = User::where('role', 'kasir')->pluck('id')->toArray();

        // Safety check untuk customer dan cashier IDs
        if (empty($customerIds) || empty($cashierIds)) {
            // Jika tidak ada user, skip pembuatan transaksi
            $this->command->info('No customers or cashiers found. Skipping transaction creation.');
            return;
        }

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $transactionsCount = rand(5, 25); // Random 5-25 transaksi per hari

            for ($j = 0; $j < $transactionsCount; $j++) {
                $transactionTime = $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59));
                
                Transaction::create([
                    'customer_id' => $customerIds[array_rand($customerIds)],
                    'cashier_id' => $cashierIds[array_rand($cashierIds)],
                    'total_amount' => rand(15000, 100000),
                    'status' => 'completed',
                    'created_at' => $transactionTime,
                    'updated_at' => $transactionTime
                ]);
            }
        }
    }
}
