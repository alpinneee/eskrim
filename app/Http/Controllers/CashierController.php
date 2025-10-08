<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\User; // Added this import for the new methods

class CashierController extends Controller
{
    public function dashboard()
    {
        // Ambil data transaksi hari ini
        $today = Carbon::today();
        
        // Hitung jumlah transaksi hari ini
        $todayTransactions = Transaction::whereDate('created_at', $today)->count();
        
        // Hitung total penjualan hari ini
        $todaySales = Transaction::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Hitung transaksi pending hari ini
        $pendingTransactions = Transaction::whereDate('created_at', $today)
            ->where('status', 'pending')
            ->count();
        
        // Hitung rata-rata nilai transaksi hari ini
        $averageTransaction = Transaction::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->avg('total_amount');
        
        // Format total penjualan ke format rupiah
        $formattedSales = 'Rp ' . number_format($todaySales, 0, ',', '.');
        
        // Format rata-rata transaksi ke format rupiah
        $formattedAverage = 'Rp ' . number_format($averageTransaction ?? 0, 0, ',', '.');
        
        return view('cashier.dashboard', compact(
            'todayTransactions', 
            'formattedSales', 
            'pendingTransactions', 
            'formattedAverage'
        ));
    }

    public function transactions()
    {
        // Ambil semua transaksi dengan relasi customer, cashier, dan items
        $transactions = Transaction::with(['customer', 'cashier', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        // Hitung total penjualan hari ini
        $today = Carbon::today();
        $dailyTotal = Transaction::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Ambil data untuk modal form
        $customers = User::where('role', 'pelanggan')->get();
        $products = \App\Models\Product::all();
        
        return view('cashier.transactions', compact('transactions', 'dailyTotal', 'customers', 'products'));
    }

    public function products()
    {
        // Ambil semua produk
        $products = \App\Models\Product::orderBy('name')->get();
        
        return view('cashier.products', compact('products'));
    }

    public function reports()
    {
        // Ambil parameter tanggal dari request
        $fromDate = request('from') ? Carbon::parse(request('from')) : Carbon::now()->subDays(30);
        $toDate = request('to') ? Carbon::parse(request('to')) : Carbon::now();
        
        // Hitung pendapatan hari ini
        $todayRevenue = Transaction::whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Hitung pendapatan minggu ini (7 hari terakhir)
        $weekRevenue = Transaction::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Hitung pendapatan bulan ini
        $monthRevenue = Transaction::whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Data untuk chart (7 hari terakhir)
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailyRevenue = Transaction::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('total_amount');
            
            $chartLabels[] = $date->format('Y-m-d');
            $chartData[] = $dailyRevenue;
        }
        
        // Data untuk tabel laporan harian
        $dailyReports = Transaction::selectRaw('
                DATE(created_at) as date,
                COUNT(*) as total_transactions,
                SUM(total_amount) as total_revenue
            ')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
        
        // Statistik tambahan
        $totalTransactions = Transaction::whereBetween('created_at', [$fromDate, $toDate])
            ->where('status', 'completed')
            ->count();
        
        $averageTransactionValue = Transaction::whereBetween('created_at', [$fromDate, $toDate])
            ->where('status', 'completed')
            ->avg('total_amount');
        
        $topCustomers = Transaction::with('customer')
            ->selectRaw('customer_id, COUNT(*) as transaction_count, SUM(total_amount) as total_spent')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->where('status', 'completed')
            ->groupBy('customer_id')
            ->orderBy('total_spent', 'desc')
            ->limit(5)
            ->get();
        
        // Format data untuk view
        $formattedTodayRevenue = 'Rp ' . number_format($todayRevenue, 0, ',', '.');
        $formattedWeekRevenue = 'Rp ' . number_format($weekRevenue, 0, ',', '.');
        $formattedMonthRevenue = 'Rp ' . number_format($monthRevenue, 0, ',', '.');
        $formattedAverageTransaction = 'Rp ' . number_format($averageTransactionValue ?? 0, 0, ',', '.');
        
        return view('cashier.reports', compact(
            'formattedTodayRevenue',
            'formattedWeekRevenue', 
            'formattedMonthRevenue',
            'chartLabels',
            'chartData',
            'dailyReports',
            'fromDate',
            'toDate',
            'totalTransactions',
            'formattedAverageTransaction',
            'topCustomers'
        ));
    }

    public function exportReport(Request $request)
    {
        $fromDate = $request->from ? Carbon::parse($request->from) : Carbon::now()->subDays(30);
        $toDate = $request->to ? Carbon::parse($request->to) : Carbon::now();
        
        $transactions = Transaction::with(['customer', 'cashier'])
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $filename = 'laporan_penjualan_' . $fromDate->format('Y-m-d') . '_' . $toDate->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, ['ID Transaksi', 'Tanggal', 'Pelanggan', 'Kasir', 'Total', 'Status']);
            
            // Data transaksi
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    'TRX' . str_pad($transaction->id, 3, '0', STR_PAD_LEFT),
                    $transaction->created_at->format('Y-m-d H:i'),
                    $transaction->customer->name ?? 'N/A',
                    $transaction->cashier->name ?? 'N/A',
                    $transaction->total_amount,
                    $transaction->status
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function createTransaction()
    {
        // Ambil daftar produk untuk form transaksi
        $products = \App\Models\Product::all();
        $customers = User::where('role', 'pelanggan')->get();
        
        return view('cashier.create-transaction', compact('products', 'customers'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,qris,transfer,credit_card',
            'notes' => 'nullable|string'
        ]);

        // Hitung total amount berdasarkan produk yang dipilih
        $totalAmount = 0;
        $productData = [];

        foreach ($request->products as $productItem) {
            $product = Product::find($productItem['id']);
            $quantity = (int) $productItem['quantity'];
            $subtotal = $product->price * $quantity;
            
            $productData[] = [
                'product' => $product,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal
            ];
            
            $totalAmount += $subtotal;
        }

        // Buat transaksi
        $transaction = Transaction::create([
            'customer_id' => $request->customer_id,
            'cashier_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        // Buat transaction items
        foreach ($productData as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            ]);

            // Update stok produk
            $item['product']->decrement('stock', $item['quantity']);
        }

        return redirect()->route('cashier.transactions')
            ->with('success', 'Transaksi berhasil dibuat!');
    }

    public function updateTransactionStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        try {
            $transaction = Transaction::findOrFail($id);
            
            // Update status transaksi
            $transaction->update([
                'status' => $request->status
            ]);
            
            $statusText = [
                'pending' => 'Pending',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan'
            ];
            
            return redirect()->route('cashier.transactions')
                ->with('success', 'Status transaksi berhasil diubah menjadi ' . $statusText[$request->status] . '!');
                
        } catch (\Exception $e) {
            return redirect()->route('cashier.transactions')
                ->with('error', 'Gagal mengubah status transaksi: ' . $e->getMessage());
        }
    }

    public function deleteTransaction($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            
            // Hanya izinkan hapus transaksi yang statusnya pending atau cancelled
            if ($transaction->status === 'completed') {
                return redirect()->route('cashier.transactions')
                    ->with('error', 'Transaksi yang sudah selesai tidak dapat dihapus!');
            }
            
            $transaction->delete();
            
            return redirect()->route('cashier.transactions')
                ->with('success', 'Transaksi berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->route('cashier.transactions')
                ->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}