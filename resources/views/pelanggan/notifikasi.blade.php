<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Pelanggan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    @include('pelanggan.navbar')
    <main class="p-6 max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold mb-3" style="color: #3a7bd5;">🔔 Notifikasi</h1>
            <p class="text-gray-600 text-lg">Kelola dan lihat semua notifikasi terbaru Anda</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex gap-3">
                    <button class="px-4 py-2 rounded-xl font-medium transition-all text-white" style="background: linear-gradient(135deg, #3a7bd5 0%, #1e40af 100%);">Semua</button>
                    <button class="px-4 py-2 rounded-xl font-medium transition-all text-gray-600 hover:bg-gray-100">Belum Dibaca</button>
                    <button class="px-4 py-2 rounded-xl font-medium transition-all text-gray-600 hover:bg-gray-100">Promo</button>
                    <button class="px-4 py-2 rounded-xl font-medium transition-all text-gray-600 hover:bg-gray-100">Transaksi</button>
                </div>
                <button class="text-white font-bold px-6 py-3 rounded-xl transition-all hover:shadow-lg transform hover:-translate-y-1" style="background: linear-gradient(135deg, #3a7bd5 0%, #1e40af 100%);">✓ Tandai Semua Dibaca</button>
            </div>
        </div>
        
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg border-2 border-blue-200 p-6 transform hover:scale-105 transition-all duration-200" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">💰</div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-xl font-bold" style="color: #3a7bd5;">Pembayaran Berhasil</h3>
                                <div class="text-sm text-gray-500 mt-1">Transaksi • 2 menit lalu</div>
                            </div>
                            <div class="flex gap-2">
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">✓ Berhasil</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full animate-pulse">🔥 Baru</span>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">Transaksi #TRX012 telah berhasil dibayar sebesar <strong>Rp 45.000</strong>. Terima kasih telah berbelanja!</p>
                        <div class="flex gap-3">
                            <button class="text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors hover:bg-blue-600" style="background-color: #3a7bd5;">Lihat Detail</button>
                            <button class="text-gray-600 font-medium px-4 py-2 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Tandai Dibaca</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg border-2 border-orange-200 p-6 transform hover:scale-105 transition-all duration-200" style="background: linear-gradient(135deg, #ffffff 0%, #fff7ed 100%);">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-lg" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">🎉</div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-xl font-bold" style="color: #3a7bd5;">Promo Spesial Juli</h3>
                                <div class="text-sm text-gray-500 mt-1">Promosi • 1 jam lalu</div>
                            </div>
                            <div class="flex gap-2">
                                <span class="bg-orange-100 text-orange-800 text-xs font-bold px-3 py-1 rounded-full">🏷️ Promo</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full animate-pulse">🔥 Baru</span>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">Dapatkan <strong>diskon 20%</strong> untuk pembelian es krim varian baru bulan ini! Promo berlaku hingga akhir Juli.</p>
                        <div class="flex gap-3">
                            <button class="text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors hover:bg-blue-600" style="background-color: #3a7bd5;">Gunakan Promo</button>
                            <button class="text-gray-600 font-medium px-4 py-2 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Tandai Dibaca</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 opacity-75 hover:opacity-100 transition-all duration-200">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl bg-gray-100" style="color: #6b7280;">📦</div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-700">Pesanan Dalam Pengiriman</h3>
                                <div class="text-sm text-gray-400 mt-1">Pengiriman • Kemarin</div>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">🚚 Dikirim</span>
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-4">Pesanan #TRX011 sedang dalam proses pengiriman ke alamat Anda. Estimasi tiba dalam 1-2 hari kerja.</p>
                        <div class="flex gap-3">
                            <button class="text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors hover:bg-blue-600" style="background-color: #3a7bd5;">Lacak Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 opacity-75 hover:opacity-100 transition-all duration-200">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl bg-gray-100" style="color: #6b7280;">✅</div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-700">Pesanan Selesai</h3>
                                <div class="text-sm text-gray-400 mt-1">Selesai • 2 hari lalu</div>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">✅ Selesai</span>
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-4">Pesanan #TRX010 telah selesai. Bagaimana pengalaman berbelanja Anda? Berikan rating dan ulasan!</p>
                        <div class="flex gap-3">
                            <button class="text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors hover:bg-blue-600" style="background-color: #3a7bd5;">Beri Rating</button>
                            <button class="text-gray-600 font-medium px-4 py-2 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Beli Lagi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12 py-12">
            <div class="text-gray-300 text-8xl mb-6">📬</div>
            <h3 class="text-2xl font-bold text-gray-400 mb-3">Semua Notifikasi Sudah Dilihat</h3>
            <p class="text-gray-500 text-lg">Anda sudah up-to-date dengan semua informasi terbaru!</p>
        </div>
    </main>
</body>
</html> 