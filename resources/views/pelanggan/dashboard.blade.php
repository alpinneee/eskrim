<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen font-sans">
    @include('pelanggan.navbar')
    <main class="p-8">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Dashboard Pelanggan</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 text-lg mb-1">Jumlah Transaksi</div>
                <div class="text-3xl font-bold text-blue-700">{{ $totalTransactions }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 text-lg mb-1">Total Pembelanjaan</div>
                <div class="text-3xl font-bold text-blue-700">Rp {{ number_format($totalSpending, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 text-lg mb-1">Status Keanggotaan</div>
                <div class="text-3xl font-bold text-blue-700">{{ $membershipStatus }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 text-lg mb-1">Item di Keranjang</div>
                <div class="text-3xl font-bold text-blue-700">
                    @php
                        $cartCount = count(session()->get('cart', []));
                    @endphp
                    {{ $cartCount }}
                </div>
            </div>
        </div>
        
        <div class="flex gap-4 mb-8 flex-wrap">
            <a href="{{ route('pelanggan.menu') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                🍦 Lihat Menu Ice Cream
            </a>
            <a href="{{ route('pelanggan.cart') }}" class="bg-green-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                🛒 Lihat Keranjang ({{ $cartCount }})
            </a>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <canvas id="activityChart" height="80"></canvas>
        </div>
        
        <h2 class="text-xl font-semibold text-blue-600 mb-4">Transaksi Terbaru</h2>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-blue-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Jumlah Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->item_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->status == 'completed')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                @elseif($transaction->status == 'pending')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
    <script>
        // Contoh data statis untuk chart
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Pembelian',
                    data: @json($chartData),
                    backgroundColor: 'rgba(58, 123, 213, 0.2)',
                    borderColor: 'rgba(58, 123, 213, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(58, 123, 213, 1)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html> 