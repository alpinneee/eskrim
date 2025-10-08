<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Pelanggan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen font-sans">
    @include('pelanggan.navbar')
    <main class="p-6 max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold mb-3" style="color: #3a7bd5;">📋 Riwayat Transaksi</h1>
            <p class="text-gray-600 text-lg">Lihat semua riwayat pembelian dan transaksi Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                <div class="text-gray-500 text-sm font-medium mb-2">Total Transaksi</div>
                <div class="text-3xl font-bold" style="color: #3a7bd5;">{{ $transactions->count() }}</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                <div class="text-gray-500 text-sm font-medium mb-2">Total Pembelanjaan</div>
                <div class="text-3xl font-bold" style="color: #3a7bd5;">Rp {{ number_format($transactions->where('status', 'completed')->sum('total_amount'), 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <form class="flex-1" method="GET" action="">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari transaksi..." value="{{ $search ?? '' }}" class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg">🔍</span>
                    </div>
                </form>
                <form class="flex items-center gap-3" method="GET" action="">
                    <label for="tanggal" class="text-gray-700 font-medium">Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $date ?? '' }}" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors">
                    <button type="submit" class="text-white font-bold px-6 py-3 rounded-xl transition-all hover:shadow-lg" style="background: linear-gradient(135deg, #3a7bd5 0%, #1e40af 100%);">Filter</button>
                </form>
                @if($search || $date)
                    <a href="{{ route('pelanggan.riwayat') }}" class="bg-gray-500 text-white font-bold px-6 py-3 rounded-xl hover:bg-gray-600 transition-colors">Reset</a>
                @endif
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200" style="background: linear-gradient(135deg, #e3f0fc 0%, #dbeafe 100%);">
                            <th class="px-6 py-4 text-left font-bold" style="color: #3a7bd5;">Nomor Transaksi</th>
                            <th class="px-6 py-4 text-left font-bold" style="color: #3a7bd5;">Tanggal</th>
                            <th class="px-6 py-4 text-left font-bold" style="color: #3a7bd5;">Total Belanja</th>
                            <th class="px-6 py-4 text-left font-bold" style="color: #3a7bd5;">Status</th>
                            <th class="px-6 py-4 text-left font-bold" style="color: #3a7bd5;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-800">TRX{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 font-bold text-gray-800">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @if($transaction->status == 'completed')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">✅ Lunas</span>
                                    @elseif($transaction->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-bold">⏳ Pending</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-bold">❌ Dibatalkan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2 flex-wrap">
                                        <a href="{{ route('pelanggan.transaction.detail', $transaction->id) }}" class="text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors hover:bg-blue-600" style="background-color: #3a7bd5;">📄 Detail</a>
                                        @if($transaction->status == 'pending')
                                            <a href="{{ route('pelanggan.transaction.qr', $transaction->id) }}" class="bg-gradient-to-r from-pink-500 to-blue-500 text-white font-medium px-4 py-2 rounded-lg text-sm transition-all hover:shadow-lg">📱 QR Code</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="text-gray-300 text-6xl mb-4">🛍️</div>
                                    <div class="text-gray-500 font-medium text-lg">Belum ada transaksi</div>
                                    <div class="text-gray-400 text-sm mt-2">Mulai berbelanja sekarang!</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html> 