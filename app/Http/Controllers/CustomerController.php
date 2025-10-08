<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Hitung total transaksi pelanggan
        $totalTransactions = Transaction::where('customer_id', $user->id)->count();
        
        // Hitung total pembelanjaan
        $totalSpending = Transaction::where('customer_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Ambil transaksi terbaru (5 transaksi terakhir)
        $recentTransactions = Transaction::where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($transaction) {
                // Hitung jumlah item dari notes JSON
                $cartItems = json_decode($transaction->notes, true);
                $itemCount = 0;
                if (is_array($cartItems)) {
                    $itemCount = array_sum($cartItems);
                }
                $transaction->item_count = $itemCount;
                return $transaction;
            });
        
        // Data untuk chart (7 hari terakhir)
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->format('M d');
            
            $dailyTotal = Transaction::where('customer_id', $user->id)
                ->where('status', 'completed')
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            
            $chartData[] = $dailyTotal;
        }
        
        // Status keanggotaan berdasarkan total pembelanjaan
        $membershipStatus = 'Bronze';
        if ($totalSpending >= 1000000) {
            $membershipStatus = 'Gold';
        } elseif ($totalSpending >= 500000) {
            $membershipStatus = 'Silver';
        }
        
        return view('pelanggan.dashboard', compact(
            'totalTransactions',
            'totalSpending',
            'recentTransactions',
            'chartData',
            'chartLabels',
            'membershipStatus'
        ));
    }

    public function menu()
    {
        $products = Product::active()->get();
        return view('pelanggan.menu', compact('products'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        
        $cartItems = [];
        $total = 0;
        
        foreach ($products as $product) {
            $quantity = $cart[$product->id] ?? 0;
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity
            ];
            $total += $product->price * $quantity;
        }
        
        return view('pelanggan.cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if ($quantity > 0) {
            $cart[$productId] = $quantity;
        } else {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('pelanggan.cart')->with('error', 'Keranjang kosong!');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        
        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            $total += $product->price * $quantity;
        }

        // Create transaction
        $transaction = Transaction::create([
            'customer_id' => Auth::id(),
            'cashier_id' => Auth::id(), // For now, customer acts as cashier
            'total_amount' => $total,
            'status' => 'pending',
            'notes' => json_encode($cart) // Simpan cart items sebagai JSON
        ]);

        // Clear cart
        session()->forget('cart');
        
        return redirect()->route('pelanggan.riwayat')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function riwayat()
    {
        $user = Auth::user();
        
        // Ambil parameter filter
        $search = request('search');
        $date = request('tanggal');
        
        // Query dasar
        $query = Transaction::where('customer_id', $user->id);
        
        // Filter berdasarkan pencarian (ID transaksi)
        if ($search) {
            $query->where('id', 'LIKE', '%' . $search . '%');
        }
        
        // Filter berdasarkan tanggal
        if ($date) {
            $query->whereDate('created_at', $date);
        }
        
        // Ambil semua transaksi pelanggan
        $transactions = $query->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($transaction) {
                // Hitung jumlah item dari notes JSON
                $cartItems = json_decode($transaction->notes, true);
                $itemCount = 0;
                if (is_array($cartItems)) {
                    $itemCount = array_sum($cartItems);
                }
                $transaction->item_count = $itemCount;
                return $transaction;
            });
        
        return view('pelanggan.riwayat', compact('transactions', 'search', 'date'));
    }

    public function transactionDetail($id)
    {
        $user = Auth::user();
        
        // Ambil transaksi dengan relasi cashier
        $transaction = Transaction::with('cashier')
            ->where('customer_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        
        // Parse cart items dari notes JSON
        $cartItems = json_decode($transaction->notes, true);
        $transactionDetails = [];
        
        if (is_array($cartItems) && !empty($cartItems)) {
            $products = Product::whereIn('id', array_keys($cartItems))->get();
            
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id] ?? 0;
                $transactionDetails[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $product->price * $quantity
                ];
            }
        }
        
        // Hitung total item
        $totalItems = array_sum($cartItems ?? []);
        
        return view('pelanggan.transaction-detail', compact(
            'transaction', 
            'transactionDetails', 
            'totalItems'
        ));
    }

    public function profile()
    {
        $user = Auth::user();
        
        // Hitung statistik pelanggan
        $totalTransactions = Transaction::where('customer_id', $user->id)->count();
        $totalSpending = Transaction::where('customer_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Status keanggotaan berdasarkan total pembelanjaan
        $membershipStatus = 'Bronze';
        if ($totalSpending >= 1000000) {
            $membershipStatus = 'Gold';
        } elseif ($totalSpending >= 500000) {
            $membershipStatus = 'Silver';
        }
        
        // Transaksi terbaru
        $recentTransactions = Transaction::where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('pelanggan.profil', compact(
            'user',
            'totalTransactions',
            'totalSpending',
            'membershipStatus',
            'recentTransactions'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function showTransactionQR($id)
    {
        $user = Auth::user();
        
        // Ambil transaksi dengan relasi cashier
        $transaction = Transaction::with('cashier')
            ->where('customer_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        
        // Parse cart items dari notes JSON
        $cartItems = json_decode($transaction->notes, true);
        $transactionDetails = [];
        
        if (is_array($cartItems) && !empty($cartItems)) {
            $products = Product::whereIn('id', array_keys($cartItems))->get();
            
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id] ?? 0;
                $transactionDetails[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $product->price * $quantity
                ];
            }
        }
        
        // Hitung total item
        $totalItems = array_sum($cartItems ?? []);
        
        // Hitung pajak (11% PPN)
        $subtotal = $transaction->total_amount;
        $tax = $subtotal * 0.11;
        $grandTotal = $subtotal + $tax;
        
        // Generate QR Code data untuk pembayaran
        $qrData = $this->generateQRData($transaction, $grandTotal);
        
        return view('pelanggan.transaction-qr', compact(
            'transaction', 
            'transactionDetails', 
            'totalItems',
            'subtotal',
            'tax',
            'grandTotal',
            'qrData'
        ));
    }

    public function confirmPayment(Request $request, $id)
    {
        $user = Auth::user();
        
        $transaction = Transaction::where('customer_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        
        // Update status transaksi menjadi completed
        $transaction->update([
            'status' => 'completed'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi!'
        ]);
    }

    private function generateQRData($transaction, $amount)
    {
        // Generate QR data untuk QRIS atau e-wallet
        // Format: merchant_id|transaction_id|amount|timestamp
        $merchantId = 'ICECREAM001';
        $timestamp = now()->timestamp;
        
        $qrData = [
            'merchant_id' => $merchantId,
            'transaction_id' => $transaction->id,
            'amount' => $amount,
            'timestamp' => $timestamp,
            'qr_string' => "QRIS|{$merchantId}|{$transaction->id}|{$amount}|{$timestamp}"
        ];
        
        return $qrData;
    }
}
