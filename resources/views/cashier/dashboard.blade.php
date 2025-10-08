<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Heavenly Ice Cream</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-pink-custom to-mint-custom min-h-screen font-sans">
    @include('cashier.sidebar')
    <main style="margin-left: 256px; padding: 2rem;">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-brown-custom mb-2">Dashboard Kasir</h1>
            <p class="text-brown-custom opacity-70">Selamat datang di panel kasir Heavenly Ice Cream</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-brown-custom opacity-70">Transaksi Hari Ini</p>
                        <p class="text-2xl font-bold text-brown-custom mt-1">{{ $todayTransactions }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-custom rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-brown-custom opacity-70">Total Penjualan</p>
                        <p class="text-2xl font-bold text-brown-custom mt-1">{{ $formattedSales }}</p>
                    </div>
                    <div class="w-12 h-12 bg-mint-custom rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-brown-custom opacity-70">Transaksi Pending</p>
                        <p class="text-2xl font-bold text-brown-custom mt-1">{{ $pendingTransactions }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-custom rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-brown-custom opacity-70">Rata-rata Transaksi</p>
                        <p class="text-2xl font-bold text-brown-custom mt-1">{{ $formattedAverage }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-custom rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Button -->
        <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-brown-custom mb-1">Mulai Transaksi</h3>
                    <p class="text-brown-custom opacity-70">Buat transaksi baru untuk pelanggan</p>
                </div>
                <a href="/cashier/transactions/create" class="bg-purple-custom text-brown-custom font-semibold px-6 py-3 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Transaksi Baru
                </a>
            </div>
        </div>
    </main>
</body>
</html> 