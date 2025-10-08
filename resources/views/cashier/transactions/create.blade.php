<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Kasir</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-pink-custom to-mint-custom min-h-screen font-sans">
    @include('cashier.sidebar')
    <main style="margin-left: 256px; padding: 2rem; position: relative; z-index: 1;">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <a href="/cashier/transactions" class="text-brown-custom hover:text-opacity-70">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-brown-custom">Tambah Transaksi Baru</h1>
            </div>
            <p class="text-brown-custom opacity-70">Buat transaksi penjualan baru</p>
        </div>

        <!-- Form -->
        <form action="{{ route('cashier.transactions.store') }}" method="POST" class="space-y-6 max-w-2xl mx-auto">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-brown-custom mb-2">Pelanggan</label>
                        <select name="customer_id" id="customer_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-custom focus:border-transparent" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-brown-custom mb-2">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-custom focus:border-transparent" required>
                            <option value="cash">Tunai</option>
                            <option value="qris">QRIS</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="credit_card">Kartu Kredit</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-brown-custom mb-2">Produk</label>
                    <div id="products-container" class="space-y-3">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                            <select name="products[0][id]" class="product-select flex-1 px-4 py-3 border border-gray-300 rounded-lg" required>
                                <option value="">Pilih Produk</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="products[0][quantity]" min="1" value="1" class="quantity-input w-24 px-4 py-3 border border-gray-300 rounded-lg text-center" required>
                            <span class="product-subtotal text-lg font-semibold text-brown-custom min-w-32">Rp 0</span>
                        </div>
                    </div>
                    
                    <button type="button" class="mt-4 bg-purple-custom text-brown-custom font-semibold px-6 py-3 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-colors flex items-center gap-2" onclick="addProductField()">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Tambah Produk
                    </button>
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-brown-custom mb-2">Catatan</label>
                    <textarea name="notes" id="notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-custom focus:border-transparent" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>
                
                <div class="flex gap-4 pt-4">
                    <a href="/cashier/transactions" class="flex-1 text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Batal</a>
                    <button type="submit" class="flex-1 bg-purple-custom text-brown-custom font-semibold px-6 py-3 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-colors">Simpan Transaksi</button>
                </div>
        </form>
    </main>

    <script>
        function addProductField() {
            const container = document.getElementById('products-container');
            const productItems = container.querySelectorAll('.flex');
            const newIndex = productItems.length;
            
            const productItem = document.createElement('div');
            productItem.className = 'flex items-center gap-4 p-4 bg-gray-50 rounded-lg';
            
            const productSelect = document.createElement('select');
            productSelect.name = `products[${newIndex}][id]`;
            productSelect.className = 'product-select flex-1 px-4 py-3 border border-gray-300 rounded-lg';
            productSelect.required = true;
            productSelect.innerHTML = document.querySelector('.product-select').innerHTML;
            
            const quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.name = `products[${newIndex}][quantity]`;
            quantityInput.min = '1';
            quantityInput.value = '1';
            quantityInput.className = 'quantity-input w-24 px-4 py-3 border border-gray-300 rounded-lg text-center';
            quantityInput.required = true;
            
            const subtotalSpan = document.createElement('span');
            subtotalSpan.className = 'product-subtotal text-lg font-semibold text-brown-custom min-w-32';
            subtotalSpan.textContent = 'Rp 0';
            
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'bg-red-500 text-white w-10 h-10 rounded-full hover:bg-red-600 transition-colors flex items-center justify-center';
            removeButton.innerHTML = '×';
            removeButton.onclick = function() {
                container.removeChild(productItem);
            };
            
            productItem.appendChild(productSelect);
            productItem.appendChild(quantityInput);
            productItem.appendChild(subtotalSpan);
            productItem.appendChild(removeButton);
            
            container.appendChild(productItem);
            setupProductListeners(productSelect, quantityInput, subtotalSpan);
        }
        
        function setupProductListeners(productSelect, quantityInput, subtotalSpan) {
            const updateSubtotal = () => {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                if (selectedOption.value) {
                    const price = parseFloat(selectedOption.dataset.price);
                    const quantity = parseInt(quantityInput.value);
                    const subtotal = price * quantity;
                    subtotalSpan.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                }
            };
            
            productSelect.addEventListener('change', updateSubtotal);
            quantityInput.addEventListener('input', updateSubtotal);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const productItems = document.querySelectorAll('#products-container .flex');
            productItems.forEach(item => {
                const productSelect = item.querySelector('.product-select');
                const quantityInput = item.querySelector('.quantity-input');
                const subtotalSpan = item.querySelector('.product-subtotal');
                
                setupProductListeners(productSelect, quantityInput, subtotalSpan);
            });
        });
    </script>
</body>
</html>