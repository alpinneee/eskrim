@extends('layouts.app')

@section('title', 'Transaksi QR - Pembayaran')

@section('content')
<style>
    :root {
        --pink: #fce7f3;
        --pink-dark: #ec4899;
        --blue: #e3f0fc;
        --blue-dark: #3a7bd5;
        --cream: #fef3c7;
        --cream-dark: #f59e0b;
        --white: #fff;
        --gray: #6b7280;
        --success: #10b981;
        --success-light: #d1fae5;
    }

    .qr-transaction-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        background: linear-gradient(135deg, var(--pink) 0%, var(--blue) 100%);
        min-height: 100vh;
    }

    .qr-header {
        text-align: center;
        margin-bottom: 2rem;
        background: var(--white);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .qr-header h1 {
        color: var(--pink-dark);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .qr-header p {
        color: var(--gray);
        font-size: 1.1rem;
    }

    .transaction-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .order-details, .payment-section {
        background: var(--white);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .section-title {
        color: var(--blue-dark);
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title::before {
        content: "🍦";
        font-size: 1.2rem;
    }

    .transaction-info {
        background: var(--cream);
        padding: 1rem;
        border-radius: 15px;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--cream-dark);
    }

    .transaction-info p {
        margin: 0.5rem 0;
        color: var(--gray);
    }

    .transaction-info strong {
        color: var(--blue-dark);
    }

    .order-items {
        margin-bottom: 1.5rem;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--pink);
        margin-bottom: 0.5rem;
        border-radius: 15px;
        border-left: 4px solid var(--pink-dark);
    }

    .item-info h4 {
        color: var(--blue-dark);
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }

    .item-info p {
        color: var(--gray);
        font-size: 0.9rem;
        margin: 0;
    }

    .item-price {
        text-align: right;
    }

    .item-price .quantity {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .item-price .subtotal {
        color: var(--blue-dark);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .payment-summary {
        background: var(--blue);
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        padding: 0.5rem 0;
    }

    .summary-row:last-child {
        border-top: 2px solid var(--blue-dark);
        margin-top: 1rem;
        padding-top: 1rem;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .summary-label {
        color: var(--gray);
    }

    .summary-value {
        color: var(--blue-dark);
        font-weight: 600;
    }

    .qr-code-container {
        text-align: center;
        background: var(--white);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .qr-code {
        width: 200px;
        height: 200px;
        background: var(--white);
        border: 3px solid var(--pink-dark);
        border-radius: 20px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--gray);
        position: relative;
        overflow: hidden;
    }

    .qr-code::before {
        content: "📱";
        font-size: 3rem;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .qr-code::after {
        content: "";
        position: absolute;
        top: 10px;
        left: 10px;
        right: 10px;
        bottom: 10px;
        background: repeating-linear-gradient(
            45deg,
            var(--pink-dark) 0px,
            var(--pink-dark) 2px,
            transparent 2px,
            transparent 8px
        );
        opacity: 0.1;
    }

    .qr-info {
        color: var(--gray);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .payment-methods {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .payment-method {
        background: var(--cream);
        padding: 1rem 1.5rem;
        border-radius: 15px;
        border: 2px solid var(--cream-dark);
        color: var(--cream-dark);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-method.active {
        background: var(--cream-dark);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
    }

    .btn {
        padding: 1rem 2rem;
        border: none;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--pink-dark), var(--blue-dark));
        color: var(--white);
        box-shadow: 0 5px 15px rgba(236, 72, 153, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(236, 72, 153, 0.4);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--blue-dark);
        border: 2px solid var(--blue-dark);
    }

    .btn-secondary:hover {
        background: var(--blue-dark);
        color: var(--white);
        transform: translateY(-2px);
    }

    .btn-success {
        background: var(--success);
        color: var(--white);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }

    .success-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .success-modal.show {
        display: flex;
    }

    .success-content {
        background: var(--white);
        padding: 3rem;
        border-radius: 20px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: successPop 0.5s ease-out;
    }

    @keyframes successPop {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        animation: bounce 1s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .success-title {
        color: var(--success);
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .success-message {
        color: var(--gray);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .loading {
        display: none;
        text-align: center;
        padding: 1rem;
    }

    .spinner {
        border: 3px solid var(--pink);
        border-top: 3px solid var(--pink-dark);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .qr-transaction-container {
            padding: 1rem;
        }

        .transaction-content {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .qr-header h1 {
            font-size: 2rem;
        }

        .order-details, .payment-section {
            padding: 1.5rem;
        }

        .qr-code {
            width: 150px;
            height: 150px;
        }

        .payment-methods {
            flex-direction: column;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="qr-transaction-container">
    <div class="qr-header">
        <h1>🍦 Transaksi QR Pembayaran</h1>
        <p>Lakukan pembayaran dengan mudah menggunakan QR Code</p>
    </div>

    <div class="transaction-content">
        <!-- Detail Pesanan -->
        <div class="order-details">
            <h2 class="section-title">Detail Pesanan</h2>
            
            <div class="transaction-info">
                <p><strong>ID Transaksi:</strong> #{{ $transaction->id }}</p>
                <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Total Item:</strong> {{ $totalItems }} item</p>
                <p><strong>Status:</strong> 
                    <span style="color: {{ $transaction->status == 'pending' ? '#f59e0b' : '#10b981' }}; font-weight: 600;">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </p>
            </div>

            <div class="order-items">
                @foreach($transactionDetails as $item)
                <div class="order-item">
                    <div class="item-info">
                        <h4>{{ $item['product']->name }}</h4>
                        <p>{{ $item['product']->description }}</p>
                    </div>
                    <div class="item-price">
                        <div class="quantity">Qty: {{ $item['quantity'] }}</div>
                        <div class="subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Ringkasan Pembayaran -->
        <div class="payment-section">
            <h2 class="section-title">Ringkasan Pembayaran</h2>
            
            <div class="payment-summary">
                <div class="summary-row">
                    <span class="summary-label">Subtotal:</span>
                    <span class="summary-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Pajak (11%):</span>
                    <span class="summary-value">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Grand Total:</span>
                    <span class="summary-value">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- QR Code -->
            <div class="qr-code-container">
                <div class="qr-code" id="qrCode">
                    <!-- QR Code akan ditampilkan di sini -->
                </div>
                <div class="qr-info">
                    Scan QR Code dengan aplikasi e-wallet atau mobile banking Anda
                </div>
                
                <div class="payment-methods">
                    <div class="payment-method active" data-method="qris">
                        <span>📱 QRIS</span>
                    </div>
                    <div class="payment-method" data-method="gopay">
                        <span>💳 GoPay</span>
                    </div>
                    <div class="payment-method" data-method="dana">
                        <span>💰 DANA</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn btn-secondary" onclick="window.print()">
                    🖨️ Cetak QR
                </button>
                <button class="btn btn-primary" onclick="simulateScan()">
                    📱 Simulasi Scan QR
                </button>
                @if($transaction->status == 'pending')
                <button class="btn btn-success" onclick="confirmPayment()" id="confirmBtn">
                    ✅ Konfirmasi Pembayaran
                </button>
                @else
                <button class="btn btn-success" disabled>
                    ✅ Pembayaran Selesai
                </button>
                @endif
            </div>

            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>Memproses pembayaran...</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="success-modal" id="successModal">
    <div class="success-content">
        <div class="success-icon">🎉</div>
        <h2 class="success-title">Pembayaran Berhasil!</h2>
        <p class="success-message">
            Terima kasih! Pembayaran Anda telah berhasil diproses. 
            Pesanan Anda akan segera disiapkan.
        </p>
        <button class="btn btn-primary" onclick="closeSuccessModal()">
            Tutup
        </button>
    </div>
</div>

<script>
    // Generate QR Code (simplified version)
    function generateQRCode() {
        const qrData = @json($qrData);
        const qrCodeElement = document.getElementById('qrCode');
        
        // Simulate QR code generation
        qrCodeElement.innerHTML = `
            <div style="position: relative; width: 100%; height: 100%;">
                <div style="position: absolute; top: 20px; left: 20px; width: 20px; height: 20px; background: #000; border-radius: 3px;"></div>
                <div style="position: absolute; top: 20px; right: 20px; width: 20px; height: 20px; background: #000; border-radius: 3px;"></div>
                <div style="position: absolute; bottom: 20px; left: 20px; width: 20px; height: 20px; background: #000; border-radius: 3px;"></div>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 0.8rem; color: #666; text-align: center;">
                    <div>QR Code</div>
                    <div style="font-size: 0.6rem;">{{ $qrData['qr_string'] }}</div>
                </div>
            </div>
        `;
    }

    // Payment method selection
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Simulate QR scan
    function simulateScan() {
        alert('📱 Simulasi: QR Code berhasil di-scan!\n\nAplikasi e-wallet akan membuka untuk konfirmasi pembayaran.');
    }

    // Confirm payment
    function confirmPayment() {
        const confirmBtn = document.getElementById('confirmBtn');
        const loading = document.getElementById('loading');
        
        // Show loading
        confirmBtn.style.display = 'none';
        loading.style.display = 'block';
        
        // Simulate API call
        fetch(`/pelanggan/konfirmasi-pembayaran/{{ $transaction->id }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hide loading
                loading.style.display = 'none';
                
                // Show success modal
                document.getElementById('successModal').classList.add('show');
                
                // Update button state
                confirmBtn.innerHTML = '✅ Pembayaran Selesai';
                confirmBtn.disabled = true;
                confirmBtn.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loading.style.display = 'none';
            confirmBtn.style.display = 'block';
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }

    // Close success modal
    function closeSuccessModal() {
        document.getElementById('successModal').classList.remove('show');
        // Redirect to transaction history
        window.location.href = '/pelanggan/riwayat';
    }

    // Initialize QR code when page loads
    document.addEventListener('DOMContentLoaded', function() {
        generateQRCode();
    });

    // Auto-refresh QR code every 30 seconds
    setInterval(generateQRCode, 30000);
</script>
@endsection
