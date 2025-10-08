<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Kasir</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-pink-custom to-mint-custom min-h-screen font-sans">
    @include('cashier.sidebar')
    <main style="margin-left: 256px; padding: 2.5rem;">
        <h1 class="text-2xl font-bold text-brown-custom mb-6">Daftar Produk</h1>
        
        <div class="flex flex-wrap gap-4 items-center mb-8">
            <form class="flex-1 min-w-48 relative" method="GET" action="">
                <input type="text" name="search" placeholder="Cari produk..." class="w-full px-4 py-2 pr-10 border border-gray-200 rounded-lg">
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-brown-custom">🔍</span>
            </form>
            
            <form class="flex items-center gap-2" method="GET" action="">
                <label for="kategori" class="text-brown-custom">Kategori:</label>
                <select id="kategori" name="kategori" class="px-3 py-2 border border-gray-200 rounded-lg">
                    <option value="">Semua</option>
                    <option value="icecream">Ice Cream</option>
                    <option value="minuman">Minuman</option>
                    <option value="topping">Topping</option>
                </select>
            </form>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white-custom rounded-2xl shadow-lg p-5 flex flex-col items-center hover:shadow-xl transition-shadow">
                    <img src="/images/ice-cream.svg" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-lg mb-4 bg-gray-100">
                    <h3 class="text-lg font-semibold text-brown-custom mb-2 text-center">{{ $product->name }}</h3>
                    <p class="text-brown-custom mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600 mb-4">Stok: {{ $product->stock }}</p>
                    <button class="bg-purple-custom text-brown-custom font-semibold px-5 py-2 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-colors">Tambah ke Keranjang</button>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-500">
                    Tidak ada produk ditemukan
                </div>
            @endforelse
        </div>
    </main>
</body>
</html> 