<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Heavenly Ice Cream</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink: #FADADD;
            --mint: #D6F5E3;
            --white: #FAFAFA;
            --brown: #CBA37C;
            --purple: #E3D1F4;
        }
        body {
            background: linear-gradient(135deg, var(--pink) 0%, var(--mint) 100%);
            min-height: 100vh;
            font-family: 'Poppins', 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            background: var(--white);
            width: 220px;
            min-height: 100vh;
            box-shadow: 2px 0 16px rgba(203,163,124,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem 1rem 1rem;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 10;
        }
        .sidebar .logo {
            width: 48px;
            margin-bottom: 1.2rem;
        }
        .sidebar .brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--brown);
            margin-bottom: 2.2rem;
            letter-spacing: 1px;
        }
        .sidebar nav {
            width: 100%;
        }
        .sidebar nav a {
            display: block;
            padding: 0.85rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 1.1rem;
            color: var(--brown);
            font-weight: 600;
            text-decoration: none;
            background: var(--pink);
            transition: background 0.2s, color 0.2s;
        }
        .sidebar nav a.active, .sidebar nav a:hover {
            background: var(--purple);
            color: #6B4B2B;
        }
        .sidebar .logout {
            margin-top: auto;
            background: var(--mint);
            color: var(--brown);
            font-weight: 700;
            border: none;
            border-radius: 1.1rem;
            padding: 0.8rem 1rem;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            box-shadow: 0 2px 8px rgba(203,163,124,0.08);
        }
        .sidebar .logout:hover {
            background: var(--purple);
            color: #6B4B2B;
        }
        .main {
            margin-left: 220px;
            padding: 2.5rem 2rem 2rem 2rem;
            width: 100%;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--brown);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .back-button {
            background: var(--purple);
            color: #6B4B2B;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .back-button:hover {
            background: var(--pink);
        }
        .stats {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .stat-card {
            background: var(--pink);
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px rgba(203,163,124,0.10);
            padding: 1.2rem 2rem;
            min-width: 170px;
            flex: 1 1 170px;
            text-align: center;
        }
        .stat-label {
            color: var(--brown);
            font-size: 1.05rem;
            margin-bottom: 0.3rem;
        }
        .stat-value {
            font-size: 1.7rem;
            font-weight: 700;
            color: #6B4B2B;
        }
        .transaction-detail-card {
            background: var(--white);
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px rgba(203,163,124,0.10);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--pink);
        }
        .transaction-id {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--brown);
        }
        .transaction-status {
            background: var(--mint);
            color: #6B4B2B;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .transaction-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .info-section {
            background: var(--pink);
            padding: 1.5rem;
            border-radius: 1rem;
        }
        .info-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--brown);
            margin-bottom: 1rem;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(203,163,124,0.2);
        }
        .info-label {
            color: var(--brown);
            font-weight: 500;
        }
        .info-value {
            color: #6B4B2B;
            font-weight: 600;
        }
        .total-section {
            background: var(--purple);
            padding: 1.5rem;
            border-radius: 1rem;
            text-align: center;
        }
        .total-label {
            font-size: 1.2rem;
            color: #6B4B2B;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .total-amount {
            font-size: 2rem;
            font-weight: 700;
            color: #6B4B2B;
        }
        .notes-section {
            background: var(--mint);
            padding: 1.5rem;
            border-radius: 1rem;
        }
        .notes-content {
            color: #6B4B2B;
            font-style: italic;
        }
        .no-notes {
            color: var(--brown);
            font-style: italic;
        }
        @media (max-width: 900px) {
            .main {
                margin-left: 0;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
            .sidebar {
                position: static;
                width: 100vw;
                min-height: unset;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 0.5rem;
                box-shadow: 0 2px 12px rgba(203,163,124,0.10);
            }
            .sidebar nav {
                display: flex;
                gap: 0.5rem;
            }
            .sidebar .logout {
                margin-top: 0;
                width: auto;
            }
            .transaction-info {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
        @media (max-width: 600px) {
            .stats {
                flex-direction: column;
                gap: 0.7rem;
            }
            .page-title {
                font-size: 1.3rem;
                flex-direction: column;
                align-items: flex-start;
            }
            .transaction-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')
    <main class="main">
        <div class="page-title">
            <a href="{{ route('admin.transactions') }}" class="back-button">← Kembali</a>
            Detail Transaksi
        </div>
        
        <div class="stats">
            <div class="stat-card">
                <div class="stat-label">Total Penjualan</div>
                <div class="stat-value">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Transaksi Hari Ini</div>
                <div class="stat-value">{{ $todayTransactions }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Pelanggan Baru</div>
                <div class="stat-value">{{ $newCustomers }}</div>
            </div>
        </div>

        <div class="transaction-detail-card">
            <div class="transaction-header">
                <div class="transaction-id">Transaksi #{{ $transaction->id }}</div>
                <div class="transaction-status">{{ ucfirst($transaction->status) }}</div>
            </div>

            <div class="transaction-info">
                <div class="info-section">
                    <div class="info-title">Informasi Customer</div>
                    <div class="info-item">
                        <span class="info-label">Nama:</span>
                        <span class="info-value">{{ $transaction->customer->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $transaction->customer->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Role:</span>
                        <span class="info-value">{{ ucfirst($transaction->customer->role) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Bergabung:</span>
                        <span class="info-value">{{ $transaction->customer->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="info-section">
                    <div class="info-title">Informasi Kasir</div>
                    <div class="info-item">
                        <span class="info-label">Nama:</span>
                        <span class="info-value">{{ $transaction->cashier->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $transaction->cashier->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Role:</span>
                        <span class="info-value">{{ ucfirst($transaction->cashier->role) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Bergabung:</span>
                        <span class="info-value">{{ $transaction->cashier->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="info-section">
                    <div class="info-title">Informasi Transaksi</div>
                    <div class="info-item">
                        <span class="info-label">Tanggal:</span>
                        <span class="info-value">{{ $transaction->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Waktu:</span>
                        <span class="info-value">{{ $transaction->created_at->format('H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value">{{ ucfirst($transaction->status) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">ID Transaksi:</span>
                        <span class="info-value">#{{ $transaction->id }}</span>
                    </div>
                </div>

                <div class="total-section">
                    <div class="total-label">Total Pembayaran</div>
                    <div class="total-amount">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</div>
                </div>
            </div>

            @if($transaction->notes)
                <div class="notes-section">
                    <div class="info-title">Catatan Transaksi</div>
                    <div class="notes-content">{{ $transaction->notes }}</div>
                </div>
            @else
                <div class="notes-section">
                    <div class="info-title">Catatan Transaksi</div>
                    <div class="no-notes">Tidak ada catatan untuk transaksi ini</div>
                </div>
            @endif
        </div>
    </main>
</body>
</html> 