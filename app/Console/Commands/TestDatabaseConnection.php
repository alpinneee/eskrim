<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TestDatabaseConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test database connection and show data summary';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Database Connection...');
        
        try {
            // Test basic connection
            DB::connection()->getPdo();
            $this->info('✓ Database connection successful!');
            
            // Test models
            $userCount = User::count();
            $transactionCount = Transaction::count();
            $productCount = Product::count();
            
            $this->info('✓ Models working correctly!');
            
            // Show data summary
            $this->table(
                ['Table', 'Count'],
                [
                    ['Users', $userCount],
                    ['Transactions', $transactionCount],
                    ['Products', $productCount],
                ]
            );
            
            // Show user roles
            $adminCount = User::where('role', 'admin')->count();
            $cashierCount = User::where('role', 'kasir')->count();
            $customerCount = User::where('role', 'pelanggan')->count();
            
            $this->info('User Roles:');
            $this->table(
                ['Role', 'Count'],
                [
                    ['Admin', $adminCount],
                    ['Cashier', $cashierCount],
                    ['Customer', $customerCount],
                ]
            );
            
            // Show recent transactions
            $recentTransactions = Transaction::with(['customer', 'cashier'])
                                           ->orderBy('created_at', 'desc')
                                           ->limit(5)
                                           ->get();
            
            if ($recentTransactions->count() > 0) {
                $this->info('Recent Transactions:');
                $transactionData = [];
                foreach ($recentTransactions as $transaction) {
                    $transactionData[] = [
                        $transaction->id,
                        $transaction->customer->name ?? 'N/A',
                        $transaction->cashier->name ?? 'N/A',
                        'Rp ' . number_format($transaction->total_amount, 0, ',', '.'),
                        $transaction->created_at->format('d/m/Y H:i')
                    ];
                }
                
                $this->table(
                    ['ID', 'Customer', 'Cashier', 'Amount', 'Date'],
                    $transactionData
                );
            }
            
            $this->info('Database test completed successfully!');
            
        } catch (\Exception $e) {
            $this->error('✗ Database connection failed: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
