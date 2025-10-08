<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Kasir</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-pink-custom to-mint-custom min-h-screen font-sans">
    @include('cashier.sidebar')
    <main style="margin-left: 256px; padding: 2.5rem;">
        <h1 class="text-2xl font-bold text-brown-custom mb-6">Laporan Penjualan</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
            <div class="bg-white-custom rounded-2xl shadow-lg p-6 text-center">
                <div class="text-brown-custom text-lg mb-1">Pendapatan Hari Ini</div>
                <div class="text-3xl font-bold text-brown-custom">{{ $formattedTodayRevenue }}</div>
            </div>
            <div class="bg-white-custom rounded-2xl shadow-lg p-6 text-center">
                <div class="text-brown-custom text-lg mb-1">Pendapatan Minggu Ini</div>
                <div class="text-3xl font-bold text-brown-custom">{{ $formattedWeekRevenue }}</div>
            </div>
            <div class="bg-white-custom rounded-2xl shadow-lg p-6 text-center">
                <div class="text-brown-custom text-lg mb-1">Pendapatan Bulan Ini</div>
                <div class="text-3xl font-bold text-brown-custom">{{ $formattedMonthRevenue }}</div>
            </div>
            <div class="bg-white-custom rounded-2xl shadow-lg p-6 text-center">
                <div class="text-brown-custom text-lg mb-1">Total Transaksi</div>
                <div class="text-3xl font-bold text-brown-custom">{{ $totalTransactions }}</div>
            </div>
            <div class="bg-white-custom rounded-2xl shadow-lg p-6 text-center">
                <div class="text-brown-custom text-lg mb-1">Rata-rata Transaksi</div>
                <div class="text-3xl font-bold text-brown-custom">{{ $formattedAverageTransaction }}</div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4 items-center mb-8">
            <form class="flex items-center gap-4" method="GET" action="">
                <label for="from" class="text-brown-custom">Dari:</label>
                <input type="date" id="from" name="from" value="{{ $fromDate->format('Y-m-d') }}" class="px-3 py-2 border border-gray-200 rounded-lg">
                <label for="to" class="text-brown-custom">Sampai:</label>
                <input type="date" id="to" name="to" value="{{ $toDate->format('Y-m-d') }}" class="px-3 py-2 border border-gray-200 rounded-lg">
                <button type="submit" class="bg-brown-custom text-white-custom font-semibold px-6 py-2 rounded-lg hover:bg-opacity-80 transition-colors">Filter</button>
            </form>
            <a href="{{ route('cashier.reports.export', ['from' => $fromDate->format('Y-m-d'), 'to' => $toDate->format('Y-m-d')]) }}" class="bg-brown-custom text-white-custom font-semibold px-6 py-2 rounded-lg hover:bg-opacity-80 transition-colors">Unduh Laporan</a>
        </div>
        
        <div class="bg-white-custom rounded-2xl shadow-lg p-6 mb-8">
            <canvas id="salesChart" height="80"></canvas>
        </div>
        
        <div class="bg-white-custom rounded-2xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-pink-custom">
                        <th class="px-4 py-3 text-left font-semibold text-brown-custom">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold text-brown-custom">Total Transaksi</th>
                        <th class="px-4 py-3 text-left font-semibold text-brown-custom">Jumlah Item</th>
                        <th class="px-4 py-3 text-left font-semibold text-brown-custom">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailyReports as $report)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($report->date)->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">{{ $report->total_transactions }}</td>
                            <td class="px-4 py-3">{{ $report->total_transactions }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($report->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada data transaksi untuk periode yang dipilih
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($topCustomers->count() > 0)
        <div class="bg-white-custom rounded-2xl shadow-lg p-6 mt-8">
            <h3 class="text-xl font-bold text-brown-custom mb-4">Pelanggan Teratas</h3>
            <div class="overflow-hidden rounded-lg">
                <table class="w-full">
                    <thead>
                        <tr class="bg-pink-custom">
                            <th class="px-4 py-3 text-left font-semibold text-brown-custom">Nama Pelanggan</th>
                            <th class="px-4 py-3 text-left font-semibold text-brown-custom">Jumlah Transaksi</th>
                            <th class="px-4 py-3 text-left font-semibold text-brown-custom">Total Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topCustomers as $customer)
                            <tr class="border-b border-gray-100">
                                <td class="px-4 py-3">{{ $customer->customer->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $customer->transaction_count }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </main>
    <script>
        // Data dinamis dari database
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Pendapatan Harian',
                    data: @json($chartData),
                    backgroundColor: 'rgba(58, 123, 213, 0.5)',
                    borderColor: 'rgba(58, 123, 213, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
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