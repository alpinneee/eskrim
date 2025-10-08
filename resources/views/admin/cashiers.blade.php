<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kasir - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins flex">
    @include('admin.sidebar')
    <main class="flex-1 min-h-screen" style="margin-left: 256px;">
        <div class="bg-white-custom shadow-sm border-b border-pink-custom p-6">
            <h1 class="text-3xl font-bold text-brown-custom">Data Kasir</h1>
            <p class="text-brown-custom opacity-70 mt-1">Performa dan statistik kasir</p>
        </div>
        
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Total Penjualan Kasir</div>
                    <div class="text-2xl font-bold text-amber-900">Rp {{ number_format($totalCashierSales, 0, ',', '.') }}</div>
                </div>
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Total Transaksi Kasir</div>
                    <div class="text-2xl font-bold text-amber-900">{{ $totalCashierTransactions }}</div>
                </div>
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Rata-rata Penjualan/Kasir</div>
                    <div class="text-2xl font-bold text-amber-900">Rp {{ number_format($averageCashierSales, 0, ',', '.') }}</div>
                </div>
                <div class="bg-pink-custom rounded-xl shadow-sm p-6 text-center">
                    <div class="text-brown-custom text-sm font-medium mb-1">Kasir Terbaik</div>
                    <div class="text-2xl font-bold text-amber-900">{{ $topCashier ? $topCashier->name : 'N/A' }}</div>
                </div>
            </div>
            
            <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom p-6">
                <h3 class="text-lg font-semibold text-brown-custom mb-4">Daftar Kasir</h3>
                
                <div class="mb-6">
                    <form method="GET" action="{{ route('admin.cashiers') }}" class="flex gap-4 items-center">
                        <input type="text" name="search" placeholder="Cari kasir berdasarkan nama atau email..." 
                               value="{{ $search }}" class="flex-1 max-w-md px-4 py-2 border-2 border-purple-custom rounded-lg bg-white-custom text-brown-custom focus:outline-none focus:border-brown-custom">
                        <button type="submit" class="bg-purple-custom text-amber-900 font-semibold px-4 py-2 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200">Cari</button>
                        @if($search)
                            <a href="{{ route('admin.cashiers') }}" class="bg-mint-custom text-brown-custom font-semibold px-4 py-2 rounded-lg hover:bg-pink-custom transition-all duration-200">Bersihkan</a>
                        @endif
                    </form>
                </div>
                
                @if($cashiers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-purple-custom">
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Ranking</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Nama</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Email</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Tanggal Bergabung</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Total Transaksi</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Total Penjualan</th>
                                    <th class="px-4 py-3 text-left text-amber-900 font-bold">Rata-rata Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cashiers as $index => $cashier)
                                    <tr class="{{ $loop->even ? 'bg-mint-custom' : 'bg-pink-custom' }} hover:bg-purple-custom transition-colors duration-200">
                                        <td class="px-4 py-3 text-amber-900 font-medium">
                                            @if($loop->first)
                                                <span class="text-yellow-500 font-bold text-lg">🥇</span>
                                            @elseif($loop->index == 1)
                                                <span class="text-gray-400 font-bold text-lg">🥈</span>
                                            @elseif($loop->index == 2)
                                                <span class="text-yellow-600 font-bold text-lg">🥉</span>
                                            @else
                                                <span class="text-brown-custom font-bold">#{{ $loop->iteration }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $cashier->name }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $cashier->email }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $cashier->created_at->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">{{ $cashier->total_transactions }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">Rp {{ number_format($cashier->total_sales, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-amber-900 font-medium">Rp {{ number_format($cashier->average_transaction, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-pink-custom rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                        <p class="text-brown-custom font-medium">Belum ada data kasir</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html> 