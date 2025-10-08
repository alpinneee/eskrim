<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins flex">
    @include('admin.sidebar')
    <main class="flex-1 min-h-screen" style="margin-left: 256px;">
        <div class="bg-white-custom shadow-sm border-b border-pink-custom p-6">
            <h1 class="text-3xl font-bold text-brown-custom">Laporan Penjualan</h1>
            <p class="text-brown-custom opacity-70 mt-1">Analisis dan laporan penjualan</p>
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
                    <div class="text-brown-custom text-sm font-medium mb-1">Pelanggan Baru</div>
                    <div class="text-2xl font-bold text-amber-900">{{ $newCustomers }}</div>
                </div>
            </div>

            <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom p-6">
                <h3 class="text-lg font-semibold text-brown-custom mb-4">Filter Laporan</h3>
                <form method="GET" action="{{ route('admin.reports') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-brown-custom">Tanggal Mulai:</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="px-4 py-2 rounded-lg bg-mint-custom text-amber-900 border-0 min-w-[150px]">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-brown-custom">Tanggal Akhir:</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="px-4 py-2 rounded-lg bg-mint-custom text-amber-900 border-0 min-w-[150px]">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-brown-custom">Kasir:</label>
                        <select name="cashier_id" class="px-4 py-2 rounded-lg bg-mint-custom text-amber-900 border-0 min-w-[150px]">
                            <option value="">Semua Kasir</option>
                            @foreach($cashiers as $cashier)
                                <option value="{{ $cashier->id }}" {{ $selectedCashierId == $cashier->id ? 'selected' : '' }}>
                                    {{ $cashier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-purple-custom text-amber-900 font-semibold px-4 py-2 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200">Filter</button>
                        <a href="{{ route('admin.reports') }}" class="bg-mint-custom text-brown-custom font-semibold px-4 py-2 rounded-lg hover:bg-pink-custom transition-all duration-200">Reset</a>
                        <a href="{{ route('admin.reports.export', ['start_date' => $startDate, 'end_date' => $endDate, 'cashier_id' => $selectedCashierId]) }}" class="bg-brown-custom text-white-custom font-semibold px-4 py-2 rounded-lg hover:bg-amber-900 transition-all duration-200">Export CSV</a>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-mint-custom rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-brown-custom mb-4">Grafik Penjualan (Mingguan)</h3>
                    <div class="h-48 flex items-end justify-center gap-2 bg-gray-50 rounded-lg p-4">
                        @foreach($chartData as $data)
                            @php
                                $maxTotal = max(array_column($chartData, 'total'));
                                $height = $maxTotal > 0 ? max(($data['total'] / $maxTotal) * 100, 5) : 5;
                            @endphp
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-full max-w-8 bg-gradient-to-t from-brown-custom to-purple-custom rounded-t transition-all duration-300 flex items-start justify-center pt-2" style="height: {{ $height }}%">
                                    @if($data['total'] > 0)
                                        <span class="text-xs text-white font-bold">{{ number_format($data['total'] / 1000, 0) }}k</span>
                                    @endif
                                </div>
                                <span class="text-xs text-brown-custom font-medium mt-2">{{ $data['day'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom p-6">
                    <h3 class="text-lg font-semibold text-brown-custom mb-4">Produk Terlaris</h3>
                    @if($topProducts->count() > 0)
                        <div class="space-y-3">
                            @foreach($topProducts as $product)
                                <div class="flex justify-between items-center p-3 bg-pink-custom rounded-lg">
                                    <span class="font-medium text-amber-900">{{ $product->name }}</span>
                                    <span class="text-brown-custom">{{ $product->total_sold }} pcs</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-brown-custom italic">
                            Belum ada data produk terlaris
                        </div>
                    @endif
                </div>
            </div>

            @if(isset($topCustomers) && $topCustomers->count() > 0)
            <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom p-6">
                <h3 class="text-lg font-semibold text-brown-custom mb-4">Pelanggan Teratas</h3>
                <div class="space-y-3">
                    @foreach($topCustomers as $customer)
                        <div class="flex justify-between items-center p-3 bg-pink-custom rounded-lg">
                            <span class="font-medium text-amber-900">{{ $customer->customer->name ?? 'N/A' }}</span>
                            <span class="text-brown-custom">{{ $customer->transaction_count }} transaksi - Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>
</body>
</html> 