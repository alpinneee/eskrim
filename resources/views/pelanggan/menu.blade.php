<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Ice Cream - Pelanggan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    @include('pelanggan.navbar')
    <main class="p-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-2" style="color: #3a7bd5;">Menu Ice Cream</h1>
            <p class="text-slate-500 text-lg">Pilih ice cream favorit Anda dan nikmati kelezatannya!</p>
        </div>
        
        <div class="flex justify-center gap-4 mb-8 flex-wrap">
            <button class="category-btn bg-white border-2 px-6 py-2 rounded-full font-medium cursor-pointer transition-all" style="border-color: #3a7bd5; color: #3a7bd5;" data-category="all">Semua</button>
            @php
                $categories = $products->pluck('category')->unique();
            @endphp
            @foreach($categories as $category)
                <button class="category-btn bg-white border-2 px-6 py-2 rounded-full font-medium cursor-pointer transition-all" style="border-color: #3a7bd5; color: #3a7bd5;" data-category="{{ $category }}">{{ ucfirst($category) }}</button>
            @endforeach
        </div>
    
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-200 hover:-translate-y-1 hover:shadow-xl" data-category="{{ $product->category }}">
                        <div class="w-full h-48 flex items-center justify-center text-white text-5xl" style="background: linear-gradient(135deg, #e3f0fc 0%, #3a7bd5 100%);">🍦</div>
                        <div class="p-6">
                            <div class="text-xl font-semibold text-slate-800 mb-2">{{ $product->name }}</div>
                            <div class="text-slate-500 mb-4 leading-relaxed">{{ $product->description }}</div>
                            <div class="text-2xl font-bold mb-4" style="color: #3a7bd5;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="font-medium mb-4 {{ $product->stock < 10 ? 'text-red-600' : 'text-green-600' }}">
                                Stok: {{ $product->stock }} pcs
                            </div>
                            
                            <form action="{{ route('pelanggan.cart.add') }}" method="POST" class="flex gap-2 items-center">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 px-2 py-2 border border-gray-300 rounded-lg text-center">
                                <button type="submit" class="flex-1 text-white font-medium px-4 py-2 rounded-lg transition-colors {{ $product->stock <= 0 ? 'bg-gray-400 cursor-not-allowed' : 'hover:bg-blue-600' }}" style="{{ $product->stock <= 0 ? '' : 'background-color: #3a7bd5;' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    {{ $product->stock <= 0 ? 'Habis' : 'Tambah ke Keranjang' }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-slate-500">
                <h3 class="text-2xl mb-4">Tidak ada produk tersedia</h3>
                <p>Mohon cek kembali nanti.</p>
            </div>
        @endif
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-btn');
        const productCards = document.querySelectorAll('.product-card');
        
        // Set first button as active
        if (categoryButtons.length > 0) {
            categoryButtons[0].style.backgroundColor = '#3a7bd5';
            categoryButtons[0].style.color = 'white';
        }
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.dataset.category;
                
                // Update active button
                categoryButtons.forEach(btn => {
                    btn.style.backgroundColor = 'white';
                    btn.style.color = '#3a7bd5';
                });
                this.style.backgroundColor = '#3a7bd5';
                this.style.color = 'white';
                
                // Filter products
                productCards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>
</body>
</html>
