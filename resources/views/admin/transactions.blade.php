<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins flex">
    @include('admin.sidebar')
    <main class="flex-1 min-h-screen" style="margin-left: 256px;">
        <div class="bg-white-custom shadow-sm border-b border-pink-custom p-6">
            <h1 class="text-3xl font-bold text-brown-custom">Transaksi</h1>
            <p class="text-brown-custom opacity-70 mt-1">Kelola dan pantau semua transaksi</p>
        </div>
        
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Total Penjualan</div>
                    <div class="text-2xl font-bold text-amber-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
                </div>
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Transaksi Hari Ini</div>
                    <div class="text-2xl font-bold text-amber-900">{{ $todayTransactions }}</div>
                </div>
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Total Transaksi</div>
                    <div class="text-2xl font-bold text-amber-900">{{ $transactions->total() }}</div>
                </div>
            </div>

            <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom overflow-hidden">
                @if($transactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-purple-custom">
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">ID Transaksi</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Customer</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Kasir</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Total Pembayaran</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Status</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="{{ $loop->even ? 'bg-mint-custom' : 'bg-pink-custom' }} hover:bg-purple-custom transition-colors duration-200">
                                        <td class="px-4 py-3 text-amber-900 font-medium">#{{ $transaction->id }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $transaction->customer->name }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $transaction->cashier->name }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $transaction->status === 'completed' ? 'bg-mint-custom text-amber-900' : '' }}
                                                {{ $transaction->status === 'pending' ? 'bg-purple-custom text-amber-900' : '' }}
                                                {{ $transaction->status === 'cancelled' ? 'bg-pink-custom text-red-600' : '' }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.transactions.detail', $transaction->id) }}" class="inline-flex items-center gap-1 bg-purple-custom text-amber-900 font-semibold px-3 py-1 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200 text-sm">
                                                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 3a7 7 0 100 14 7 7 0 000-14zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
                                                    </svg>
                                                    Detail
                                                </a>
                                                <button class="inline-flex items-center gap-1 bg-pink-custom text-amber-900 font-semibold px-3 py-1 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200 text-sm">
                                                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M6 2a2 2 0 00-2 2v2h12V4a2 2 0 00-2-2H6zm10 4H4a2 2 0 00-2 2v6a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V8a2 2 0 00-2-2z"/>
                                                    </svg>
                                                    Cetak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="p-4 border-t border-pink-custom">
                        {{ $transactions->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-pink-custom rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9z"></path>
                            </svg>
                        </div>
                        <p class="text-brown-custom font-medium">Belum ada transaksi yang dilakukan</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html> 