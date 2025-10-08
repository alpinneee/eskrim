@include('pelanggan.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Pelanggan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue: #e3f0fc;
            --blue-dark: #3a7bd5;
            --white: #fff;
            --border: #dbeafe;
            --text: #222;
            --success: #059669;
            --warning: #d97706;
            --danger: #dc2626;
        }
        body {
            background: linear-gradient(135deg, var(--blue) 0%, var(--white) 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
        }
        .main {
            margin-left: 220px;
            padding: 2.5rem 2rem 2rem 2rem;
            width: 100%;
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--blue-dark);
            margin-bottom: 1.5rem;
        }
        .back-btn {
            background: var(--blue-dark);
            color: var(--white);
            border: none;
            border-radius: 0.8rem;
            padding: 0.7rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
            transition: background 0.2s;
        }
        .back-btn:hover {
            background: #2563eb;
        }
        .transaction-info {
            background: var(--white);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 12px rgba(58,123,213,0.07);
        }
        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border);
        }
        .transaction-id {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--blue-dark);
        }
        .transaction-status {
            padding: 0.5rem 1rem;
            border-radius: 0.8rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .status-completed {
            background: #dcfce7;
            color: var(--success);
        }
        .status-pending {
            background: #fef3c7;
            color: var(--warning);
        }
        .status-cancelled {
            background: #fee2e2;
            color: var(--danger);
        }
        .transaction-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        .detail-label {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 0.3rem;
        }
        .detail-value {
            font-weight: 600;
            color: var(--text);
        }
        .products-section {
            background: var(--white);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 12px rgba(58,123,213,0.07);
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--blue-dark);
            margin-bottom: 1rem;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
        }
        .products-table th, .products-table td {
            padding: 1rem 0.8rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        .products-table th {
            background: var(--blue);
            color: var(--blue-dark);
            font-weight: 600;
        }
        .products-table tr:last-child td {
            border-bottom: none;
        }
        .product-name {
            font-weight: 600;
            color: var(--text);
        }
        .product-price {
            color: #64748b;
        }
        .quantity {
            text-align: center;
            font-weight: 600;
        }
        .subtotal {
            font-weight: 600;
            color: var(--blue-dark);
        }
        .total-section {
            background: var(--blue);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 2px 12px rgba(58,123,213,0.07);
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .total-row:last-child {
            margin-bottom: 0;
            padding-top: 1rem;
            border-top: 2px solid var(--border);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--blue-dark);
        }
        .no-products {
            text-align: center;
            color: #64748b;
            padding: 2rem;
            font-style: italic;
        }
        @media (max-width: 900px) {
            .main {
                margin-left: 0;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
            .transaction-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .transaction-details {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 600px) {
            .page-title {
                font-size: 1.1rem;
            }
            .products-table {
                font-size: 0.9rem;
            }
            .products-table th, .products-table td {
                padding: 0.5rem 0.3rem;
            }
        }
    </style>
</head>
<body>
    <main class="main">
        <a href="{{ route('pelanggan.riwayat') }}" class="back-btn">← Kembali ke Riwayat</a>
        
        <div class="page-title">Detail Transaksi</div>
        
        <div class="transaction-info">
            <div class="transaction-header">
                <div class="transaction-id">
                    TRX{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}
                </div>
                <div class="transaction-status status-{{ $transaction->status }}">
                    @if($transaction->status == 'completed')
                        Lunas
                    @elseif($transaction->status == 'pending')
                        Pending
                    @else
                        Dibatalkan
                    @endif
                </div>
            </div>
            
            <div class="transaction-details">
                <div class="detail-item">
                    <div class="detail-label">Tanggal Transaksi</div>
                    <div class="detail-value">{{ $transaction->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Kasir</div>
                    <div class="detail-value">{{ $transaction->cashier->name ?? 'N/A' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Item</div>
                    <div class="detail-value">{{ $totalItems }} item</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Pembayaran</div>
                    <div class="detail-value">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        
        <div class="products-section">
            <div class="section-title">Detail Produk</div>
            
            @if(count($transactionDetails) > 0)
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactionDetails as $item)
                            <tr>
                                <td class="product-name">{{ $item['product']->name }}</td>
                                <td class="product-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td class="quantity">{{ $item['quantity'] }}</td>
                                <td class="subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-products">
                    Tidak ada detail produk yang tersedia
                </div>
            @endif
        </div>
        
        <div class="total-section">
            <div class="total-row">
                <span>Total Pembayaran:</span>
                <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        @if($transaction->status == 'pending')
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('pelanggan.transaction.qr', $transaction->id) }}" 
               style="background: linear-gradient(135deg, #ec4899, #3a7bd5); 
                      color: white; 
                      padding: 1rem 2rem; 
                      border-radius: 15px; 
                      text-decoration: none; 
                      font-weight: 600; 
                      display: inline-flex; 
                      align-items: center; 
                      gap: 0.5rem;
                      box-shadow: 0 5px 15px rgba(236, 72, 153, 0.3);
                      transition: all 0.3s ease;">
                📱 Bayar dengan QR Code
            </a>
        </div>
        @endif
    </main>
</body>
</html>

