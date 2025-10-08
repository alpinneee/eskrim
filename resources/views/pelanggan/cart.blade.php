<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Pelanggan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    @include('pelanggan.navbar')
    <main class="p-8">
<style>
    .cart-container {
        padding: 0;
        background: transparent;
        min-height: auto;
    }
    
    .cart-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .cart-header h1 {
        color: #3a7bd5;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .cart-header p {
        color: #64748b;
        font-size: 1.1rem;
    }
    
    .cart-content {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .cart-items {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .cart-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .item-image {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e3f0fc 0%, #3a7bd5 100%);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-right: 1rem;
    }
    
    .item-details {
        flex: 1;
    }
    
    .item-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }
    
    .item-price {
        color: #3a7bd5;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .item-quantity {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .quantity-btn {
        background: #f1f5f9;
        border: 1px solid #d1d5db;
        color: #374151;
        width: 32px;
        height: 32px;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .quantity-btn:hover {
        background: #e5e7eb;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        padding: 0.25rem;
    }
    
    .item-subtotal {
        font-weight: 600;
        color: #1e293b;
        font-size: 1.1rem;
        margin-left: 1rem;
    }
    
    .remove-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background 0.2s;
        margin-left: 1rem;
    }
    
    .remove-btn:hover {
        background: #dc2626;
    }
    
    .cart-summary {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .summary-row:last-child {
        margin-bottom: 0;
        padding-top: 1rem;
        border-top: 2px solid #e5e7eb;
        font-size: 1.2rem;
        font-weight: 700;
        color: #3a7bd5;
    }
    
    .checkout-btn {
        background: #3a7bd5;
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
        margin-top: 1rem;
    }
    
    .checkout-btn:hover {
        background: #2563eb;
    }
    
    .checkout-btn:disabled {
        background: #9ca3af;
        cursor: not-allowed;
    }
    
    .empty-cart {
        text-align: center;
        padding: 3rem;
        color: #64748b;
    }
    
    .empty-cart h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .continue-shopping {
        background: #3a7bd5;
        color: white;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        display: inline-block;
        margin-top: 1rem;
        transition: background 0.2s;
    }
    
    .continue-shopping:hover {
        background: #2563eb;
    }
    
    @media (max-width: 900px) {
        .cart-container {
            margin-left: 0;
            padding: 1rem;
        }
        
        .cart-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .item-image {
            margin-right: 0;
        }
        
        .item-subtotal {
            margin-left: 0;
        }
        
        .remove-btn {
            margin-left: 0;
            align-self: flex-end;
        }
    }
</style>

<div class="cart-container">
    <div class="cart-header">
        <h1>Keranjang Belanja</h1>
        <p>Kelola pesanan Anda sebelum checkout</p>
    </div>
    
    <div class="cart-content">
        @if(count($cartItems) > 0)
            <div class="cart-items">
                @foreach($cartItems as $item)
                    <div class="cart-item">
                        <div class="item-image">
                            🍦
                        </div>
                        <div class="item-details">
                            <div class="item-name">{{ $item['product']->name }}</div>
                            <div class="item-price">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</div>
                            
                            <form action="{{ route('pelanggan.cart.update') }}" method="POST" class="item-quantity">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                <button type="button" class="quantity-btn" onclick="updateQuantity({{ $item['product']->id }}, -1)">-</button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" class="quantity-input" data-product-id="{{ $item['product']->id }}" onchange="this.form.submit()">
                                <button type="button" class="quantity-btn" onclick="updateQuantity({{ $item['product']->id }}, 1)">+</button>
                            </form>
                        </div>
                        <div class="item-subtotal">
                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                        </div>
                        <form action="{{ route('pelanggan.cart.remove', $item['product']->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
            
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Total Item:</span>
                    <span>{{ array_sum(array_column($cartItems, 'quantity')) }} item</span>
                </div>
                <div class="summary-row">
                    <span>Total Harga:</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                <form action="{{ route('pelanggan.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn">Checkout Sekarang</button>
                </form>
            </div>
        @else
            <div class="empty-cart">
                <h3>Keranjang Belanja Kosong</h3>
                <p>Belum ada produk di keranjang belanja Anda.</p>
                <a href="{{ route('pelanggan.menu') }}" class="continue-shopping">Lanjutkan Belanja</a>
            </div>
        @endif
    </div>
</div>

<script>
function updateQuantity(productId, change) {
    const input = document.querySelector(`input[name="quantity"][data-product-id="${productId}"]`);
    if (input) {
        const newValue = parseInt(input.value) + change;
        if (newValue >= 1 && newValue <= parseInt(input.max)) {
            input.value = newValue;
            input.form.submit();
        }
    }
}
</script>
    </main>
</body>
</html>
