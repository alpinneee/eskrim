<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins m-0 flex">
    @include('admin.sidebar')
    <main class="flex-1 min-h-screen" style="margin-left: 256px;">
        <!-- Header -->
        <div class="bg-white-custom shadow-sm border-b border-pink-custom p-6">
            <h1 class="text-3xl font-bold text-brown-custom">Dashboard Admin</h1>
            <p class="text-brown-custom opacity-70 mt-1">Selamat datang di panel admin Heavenly Ice Cream</p>
        </div>
        
        <div class="p-6 space-y-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-custom text-sm font-medium">Total Penjualan</p>
                            <p class="text-2xl font-bold text-amber-900 mt-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-pink-custom p-3 rounded-lg">
                            <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white-custom rounded-xl shadow-sm border border-mint-custom p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-custom text-sm font-medium">Transaksi Hari Ini</p>
                            <p class="text-2xl font-bold text-amber-900 mt-1">{{ $todayTransactions }}</p>
                        </div>
                        <div class="bg-mint-custom p-3 rounded-lg">
                            <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white-custom rounded-xl shadow-sm border border-purple-custom p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-custom text-sm font-medium">Pelanggan Baru</p>
                            <p class="text-2xl font-bold text-amber-900 mt-1">{{ $newCustomers }}</p>
                        </div>
                        <div class="bg-purple-custom p-3 rounded-lg">
                            <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chart and Table Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Chart Section -->
                <div class="bg-white-custom rounded-xl shadow-sm border border-mint-custom p-6">
                    <h3 class="text-lg font-semibold text-brown-custom mb-4">Grafik Penjualan Minggu Ini</h3>
                    <div class="h-64 flex items-end justify-center gap-3 bg-gray-50 rounded-lg p-4">
                        @if(count($chartData) > 0)
                            @foreach($chartData as $data)
                                @php
                                    $maxCount = max(array_column($chartData, 'count'));
                                    $height = $maxCount > 0 ? max(($data['count'] / $maxCount) * 100, 8) : 8;
                                @endphp
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-full max-w-8 bg-gradient-to-t from-brown-custom to-pink-custom rounded-t transition-all duration-300 hover:opacity-80 flex items-start justify-center pt-2" style="height: {{ $height }}%">
                                        @if($data['count'] > 0)
                                            <span class="text-xs text-white font-bold">{{ $data['count'] }}</span>
                                        @endif
                                    </div>
                                    <span class="text-xs text-brown-custom font-medium mt-2">{{ $data['day'] }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-brown-custom opacity-60">Data tidak tersedia</div>
                        @endif
                    </div>
                </div>
                
                <!-- Recent Transactions -->
                <div class="bg-white-custom rounded-xl shadow-sm border border-purple-custom p-6">
                    <h3 class="text-lg font-semibold text-brown-custom mb-4">Transaksi Terbaru</h3>
                    @if($recentTransactions->count() > 0)
                        <div class="space-y-3 max-h-64 overflow-y-auto">
                            @foreach($recentTransactions->take(5) as $transaction)
                                <div class="flex items-center justify-between p-3 bg-pink-custom rounded-lg">
                                    <div class="flex-1">
                                        <p class="font-medium text-amber-900">{{ $transaction->customer->name }}</p>
                                        <p class="text-sm text-brown-custom">{{ $transaction->created_at->format('H:i') }} - {{ $transaction->cashier->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-amber-900">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="bg-pink-custom rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-brown-custom font-medium">Belum ada transaksi</p>
                            <p class="text-brown-custom opacity-60 text-sm">Transaksi akan muncul di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html> 