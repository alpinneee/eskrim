<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Helper method untuk mendapatkan data dashboard
     */
    private function getDashboardData()
    {
        // Statistik untuk dashboard
        $totalSales = Transaction::where('status', 'completed')->sum('total_amount');
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->count();
        $newCustomers = User::where('role', 'pelanggan')
                           ->whereDate('created_at', Carbon::today())
                           ->count();
        
        // Data untuk grafik penjualan mingguan - menggunakan fungsi SQLite
        $weeklySales = Transaction::where('status', 'completed')
                                 ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                 ->selectRaw('date(created_at) as date, COUNT(*) as count, SUM(total_amount) as total')
                                 ->groupBy('date')
                                 ->orderBy('date')
                                 ->get();

        // Transaksi terbaru
        $recentTransactions = Transaction::with(['customer', 'cashier'])
                                       ->where('status', 'completed')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(5)
                                       ->get();

        // Data untuk grafik (7 hari terakhir)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $daySales = $weeklySales->where('date', $date->format('Y-m-d'))->first();
            $chartData[] = [
                'day' => $date->format('D'),
                'count' => $daySales ? $daySales->count : 0,
                'total' => $daySales ? $daySales->total : 0
            ];
        }

        return compact(
            'totalSales',
            'todayTransactions', 
            'newCustomers',
            'recentTransactions',
            'chartData'
        );
    }

    public function dashboard()
    {
        $data = $this->getDashboardData();
        return view('admin.dashboard', $data);
    }

    public function users()
    {
        $users = User::all();
        $data = $this->getDashboardData();
        $data['users'] = $users;
        
        return view('admin.users', $data);
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,kasir,pelanggan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,kasir,pelanggan',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus!');
    }

    public function cashiers(Request $request)
    {
        $query = \App\Models\User::where('role', 'kasir');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $cashiers = $query->get();
        
        // Add performance data for each cashier
        $cashiers = $cashiers->map(function($cashier) {
            $transactions = $cashier->cashierTransactions();
            $totalSales = $transactions->sum('total_amount');
            $totalTransactions = $transactions->count();
            $averageTransaction = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;
            
            $cashier->total_sales = $totalSales;
            $cashier->total_transactions = $totalTransactions;
            $cashier->average_transaction = $averageTransaction;
            
            return $cashier;
        });
        
        // Sort by total sales (descending)
        $cashiers = $cashiers->sortByDesc('total_sales');
        
        // Calculate additional statistics
        $totalCashierSales = $cashiers->sum('total_sales');
        $totalCashierTransactions = $cashiers->sum('total_transactions');
        $averageCashierSales = $cashiers->count() > 0 ? $totalCashierSales / $cashiers->count() : 0;
        $topCashier = $cashiers->first();
        
        $data = $this->getDashboardData();
        $data['cashiers'] = $cashiers;
        $data['search'] = $request->search ?? '';
        $data['totalCashierSales'] = $totalCashierSales;
        $data['totalCashierTransactions'] = $totalCashierTransactions;
        $data['averageCashierSales'] = $averageCashierSales;
        $data['topCashier'] = $topCashier;
        
        return view('admin.cashiers', $data);
    }

    public function transactions()
    {
        $transactions = Transaction::with(['customer', 'cashier'])
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(20);
        
        $data = $this->getDashboardData();
        $data['transactions'] = $transactions;
        
        return view('admin.transactions', $data);
    }

    public function transactionDetail($id)
    {
        $transaction = Transaction::with(['customer', 'cashier'])
                                ->findOrFail($id);
        
        $data = $this->getDashboardData();
        $data['transaction'] = $transaction;
        
        return view('admin.transaction-detail', $data);
    }

    public function reports(Request $request)
    {
        // Filter parameters
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();
        $cashierId = $request->get('cashier_id');
        
        // Base query
        $query = Transaction::where('status', 'completed');
        
        // Apply date filter
        $query->whereBetween('created_at', [$startDate, $endDate]);
        
        // Apply cashier filter
        if ($cashierId) {
            $query->where('cashier_id', $cashierId);
        }
        
        // Get filtered data
        $totalSales = $query->sum('total_amount');
        $totalTransactions = $query->count();
        $averageTransaction = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;
        
        // Get cashiers for filter dropdown
        $cashiers = User::where('role', 'kasir')->get();
        
        // Data untuk grafik penjualan mingguan (7 hari terakhir)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayQuery = Transaction::where('status', 'completed')
                                 ->whereDate('created_at', $date);
            
            if ($cashierId) {
                $dayQuery->where('cashier_id', $cashierId);
            }
            
            $dayTotal = $dayQuery->sum('total_amount');
            
            $chartData[] = [
                'day' => $date->format('D'),
                'count' => $dayQuery->count(),
                'total' => $dayTotal
            ];
        }
        
        // Top products (berdasarkan produk yang ada)
        $topProducts = Product::select('products.id', 'products.name')
            ->leftJoin('transactions', function($join) use ($startDate, $endDate, $cashierId) {
                $join->on('products.id', '=', DB::raw('1')) // Placeholder join
                     ->where('transactions.status', '=', 'completed')
                     ->whereBetween('transactions.created_at', [$startDate, $endDate]);
                if ($cashierId) {
                    $join->where('transactions.cashier_id', $cashierId);
                }
            })
            ->selectRaw('products.id, products.name, COUNT(transactions.id) as total_sold')
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
        
        // Top customers
        $topCustomers = Transaction::with('customer')
            ->selectRaw('customer_id, COUNT(*) as transaction_count, SUM(total_amount) as total_spent')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($cashierId, function($query) use ($cashierId) {
                return $query->where('cashier_id', $cashierId);
            })
            ->groupBy('customer_id')
            ->orderBy('total_spent', 'desc')
            ->limit(5)
            ->get();
        
        // Sales by cashier
        $salesByCashier = Transaction::with('cashier')
            ->selectRaw('cashier_id, COUNT(*) as transaction_count, SUM(total_amount) as total_sales')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($cashierId, function($query) use ($cashierId) {
                return $query->where('cashier_id', $cashierId);
            })
            ->groupBy('cashier_id')
            ->orderBy('total_sales', 'desc')
            ->get();
        
        // Daily sales breakdown
        $dailySales = Transaction::selectRaw('
                DATE(created_at) as date,
                COUNT(*) as transaction_count,
                SUM(total_amount) as daily_total
            ')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($cashierId, function($query) use ($cashierId) {
                return $query->where('cashier_id', $cashierId);
            })
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        $data = $this->getDashboardData();
        $data['totalSales'] = $totalSales;
        $data['totalTransactions'] = $totalTransactions;
        $data['averageTransaction'] = $averageTransaction;
        $data['chartData'] = $chartData;
        $data['topProducts'] = $topProducts;
        $data['topCustomers'] = $topCustomers;
        $data['salesByCashier'] = $salesByCashier;
        $data['dailySales'] = $dailySales;
        $data['cashiers'] = $cashiers;
        $data['startDate'] = $startDate->format('Y-m-d');
        $data['endDate'] = $endDate->format('Y-m-d');
        $data['selectedCashierId'] = $cashierId;

        return view('admin.reports', $data);
    }

    public function exportReport(Request $request)
    {
        // Filter parameters
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();
        $cashierId = $request->get('cashier_id');
        
        // Get transactions with filters
        $transactions = Transaction::with(['customer', 'cashier'])
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($cashierId, function($query) use ($cashierId) {
                return $query->where('cashier_id', $cashierId);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        
        $filename = 'laporan_admin_' . $startDate->format('Y-m-d') . '_' . $endDate->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, ['ID Transaksi', 'Tanggal', 'Pelanggan', 'Kasir', 'Total', 'Status', 'Catatan']);
            
            // Data transaksi
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    'TRX' . str_pad($transaction->id, 3, '0', STR_PAD_LEFT),
                    $transaction->created_at->format('Y-m-d H:i'),
                    $transaction->customer->name ?? 'N/A',
                    $transaction->cashier->name ?? 'N/A',
                    $transaction->total_amount,
                    $transaction->status,
                    $transaction->notes ?? ''
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
