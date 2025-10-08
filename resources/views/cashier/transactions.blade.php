<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Kasir</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-pink-custom to-mint-custom min-h-screen font-sans">
    @include('cashier.sidebar')
    <div style="margin-left: 256px; padding: 2rem;">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-brown-custom mb-2">Kelola Transaksi</h1>
            <p class="text-brown-custom opacity-70">Kelola semua transaksi penjualan ice cream</p>
        </div>
        
        <!-- Stats Card -->
        <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brown-custom opacity-70">Total Penjualan Hari Ini</p>
                    <p class="text-2xl font-bold text-brown-custom mt-1">Rp {{ number_format($dailyTotal, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-mint-custom rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Filters & Actions -->
        <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <form action="{{ route('cashier.transactions') }}" method="GET" class="flex-1 min-w-64 relative">
                        <input type="text" name="search" placeholder="Cari nama pelanggan..." value="{{ request('search') }}" class="w-full px-4 py-2 pr-10 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-custom focus:border-transparent">
                        <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-brown-custom opacity-50"></i>
                    </form>
                    
                    <div class="flex gap-3">
                        <div class="flex items-center gap-2">
                            <label class="text-sm font-medium text-brown-custom whitespace-nowrap">Tanggal:</label>
                            <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" onchange="this.form.submit()" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-pink-custom focus:border-transparent">
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <label class="text-sm font-medium text-brown-custom whitespace-nowrap">Status:</label>
                            <select name="status" onchange="this.form.submit()" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-pink-custom focus:border-transparent">
                                <option value="">Semua</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <a href="/cashier/transactions/create" class="bg-purple-custom text-brown-custom font-semibold px-6 py-2 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Transaksi Baru
                </a>
            </div>
        </div>
        
        <!-- Transactions Table -->
        <div class="bg-white-custom rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-brown-custom">Daftar Transaksi</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Pembayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brown-custom uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-brown-custom">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->customer->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                @if($transaction->items && count($transaction->items) > 0)
                                    <div class="space-y-1">
                                        @foreach($transaction->items as $item)
                                            <div class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $item->quantity }}x {{ $item->product->name }}</div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-500 text-xs">{{ $transaction->notes ? 'Detail: ' . $transaction->notes : 'Tidak ada detail item' }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-brown-custom">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->status == 'pending')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($transaction->status == 'completed')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    @if($transaction->status == 'pending')
                                        <form action="{{ route('cashier.transactions.update.status', $transaction->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-xs transition-colors">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors" onclick="openEditModal({{ $transaction->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <form action="{{ route('cashier.transactions.delete', $transaction->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Tidak ada transaksi</p>
                                    <p class="text-sm">Belum ada transaksi yang tercatat</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            {{ $transactions->links() }}
        </div>
        
        <!-- Add Transaction Modal -->
        <div id="addTransactionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-start justify-center p-2 pt-8">
            <div class="bg-white-custom rounded-lg shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-brown-custom">Tambah Transaksi</h2>
                    <button onclick="closeModal('addTransactionModal')" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                </div>
                
                <form action="{{ route('cashier.transactions.store') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-brown-custom mb-1">Pelanggan</label>
                        <select name="customer_id" id="customer_id" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-pink-custom focus:border-transparent" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-brown-custom mb-1">Produk</label>
                        <div id="products-container" class="space-y-2">
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-md">
                                <select name="products[0][id]" class="product-select flex-1 px-2 py-1 text-sm border border-gray-300 rounded-md" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="products[0][quantity]" min="1" value="1" class="quantity-input w-16 px-2 py-1 text-sm border border-gray-300 rounded-md" required>
                                <span class="product-subtotal text-xs font-medium text-brown-custom min-w-16">Rp 0</span>
                            </div>
                        </div>
                        
                        <button type="button" class="mt-2 bg-purple-custom text-brown-custom px-3 py-1 text-sm rounded-md hover:bg-brown-custom hover:text-white-custom transition-colors flex items-center gap-1" onclick="addProductField()">
                            <i class="fas fa-plus text-xs"></i> Tambah
                        </button>
                    </div>
                    
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-brown-custom mb-1">Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-pink-custom focus:border-transparent" required>
                            <option value="cash">Tunai</option>
                            <option value="qris">QRIS</option>
                            <option value="transfer">Transfer</option>
                            <option value="credit_card">Kartu Kredit</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="notes" class="block text-sm font-medium text-brown-custom mb-1">Catatan</label>
                        <input type="text" name="notes" id="notes" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-pink-custom focus:border-transparent" placeholder="Opsional">
                    </div>
                    
                    <div class="flex gap-2 pt-3">
                        <button type="button" onclick="closeModal('addTransactionModal')" class="flex-1 px-3 py-2 text-sm border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="flex-1 bg-purple-custom text-brown-custom font-semibold px-3 py-2 text-sm rounded-md hover:bg-brown-custom hover:text-white-custom transition-colors">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Edit Transaction Modal -->
        <div id="editTransactionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white-custom rounded-xl shadow-xl max-w-md w-full">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-brown-custom">Edit Transaksi</h2>
                    <button onclick="closeModal('editTransactionModal')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                </div>
                
                <form id="editTransactionForm" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label for="edit_status" class="block text-sm font-medium text-brown-custom mb-2">Status</label>
                        <select name="status" id="edit_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-custom focus:border-transparent" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Selesai</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeModal('editTransactionModal')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="flex-1 bg-purple-custom text-brown-custom font-semibold px-4 py-2 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-colors">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Fungsi untuk membuka modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        
        // Fungsi untuk menutup modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        // Fungsi untuk membuka modal edit
        function openEditModal(transactionId) {
            const form = document.getElementById('editTransactionForm');
            form.action = `/cashier/transactions/${transactionId}/status`;
            openModal('editTransactionModal');
        }
        
        // Fungsi untuk menambah field produk
        function addProductField() {
            const container = document.getElementById('products-container');
            const productItems = container.querySelectorAll('.product-item');
            const newIndex = productItems.length;
            
            const productItem = document.createElement('div');
            productItem.className = 'flex items-center gap-2 p-2 bg-gray-50 rounded-md';
            
            const productSelect = document.createElement('select');
            productSelect.name = `products[${newIndex}][id]`;
            productSelect.className = 'product-select flex-1 px-2 py-1 text-sm border border-gray-300 rounded-md';
            productSelect.required = true;
            productSelect.innerHTML = document.querySelector('.product-select').innerHTML;
            
            const quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.name = `products[${newIndex}][quantity]`;
            quantityInput.min = '1';
            quantityInput.value = '1';
            quantityInput.className = 'quantity-input w-16 px-2 py-1 text-sm border border-gray-300 rounded-md';
            quantityInput.required = true;
            
            const subtotalSpan = document.createElement('span');
            subtotalSpan.className = 'product-subtotal text-xs font-medium text-brown-custom min-w-16';
            subtotalSpan.textContent = 'Rp 0';
            
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'bg-red-500 text-white w-6 h-6 rounded-full hover:bg-red-600 transition-colors flex items-center justify-center text-xs';
            removeButton.innerHTML = '&times;';
            removeButton.onclick = function() {
                container.removeChild(productItem);
            };
            
            productItem.appendChild(productSelect);
            productItem.appendChild(quantityInput);
            productItem.appendChild(subtotalSpan);
            productItem.appendChild(removeButton);
            
            container.appendChild(productItem);
            
            // Tambahkan event listener untuk update subtotal
            setupProductListeners(productSelect, quantityInput, subtotalSpan);
        }
        
        // Fungsi untuk setup event listener pada produk
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
        
        // Setup event listeners untuk produk yang sudah ada
        document.addEventListener('DOMContentLoaded', function() {
            const productItems = document.querySelectorAll('.product-item');
            productItems.forEach(item => {
                const productSelect = item.querySelector('.product-select');
                const quantityInput = item.querySelector('.quantity-input');
                const subtotalSpan = item.querySelector('.product-subtotal');
                
                setupProductListeners(productSelect, quantityInput, subtotalSpan);
            });
        });
        
        // Tutup modal ketika klik di luar modal
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                event.target.classList.add('hidden');
            }
        };
    </script>
</body>
</html>