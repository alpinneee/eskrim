<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Transaksi Baru - Heavenly Ice Cream</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
        .main {
            margin-left: 220px;
            padding: 2.5rem 2rem 2rem 2rem;
            width: 100%;
        }
        .page-title {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--brown);
            margin-bottom: 1.2rem;
        }
        .form-container {
            background: var(--white);
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px rgba(203,163,124,0.10);
            padding: 2rem;
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            color: var(--brown);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #E8E8E8;
            border-radius: 0.8rem;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--brown);
        }
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn {
            display: inline-block;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 0.8rem;
            padding: 0.8rem 2rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
        }
        .btn-primary {
            background: var(--purple);
            color: #6B4B2B;
        }
        .btn-primary:hover {
            background: var(--brown);
            color: var(--white);
        }
        .btn-secondary {
            background: #E8E8E8;
            color: #666;
            margin-right: 1rem;
        }
        .btn-secondary:hover {
            background: #D0D0D0;
        }
        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }
        @media (max-width: 900px) {
            .main {
                margin-left: 0;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    @include('cashier.sidebar')
    <main class="main">
        <div class="page-title">Buat Transaksi Baru</div>
        
        <form action="{{ route('cashier.transactions.store') }}" method="POST" class="max-w-2xl mx-auto">
                @csrf
                
                <div class="form-group">
                    <label for="customer_id" class="form-label">Pelanggan</label>
                    <select name="customer_id" id="customer_id" class="form-select" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} ({{ $customer->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total_amount" class="form-label">Total Jumlah (Rp)</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-input" 
                           value="{{ old('total_amount') }}" min="0" step="100" required>
                    @error('total_amount')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">Pilih Status</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="notes" class="form-label">Catatan (Opsional)</label>
                    <textarea name="notes" id="notes" class="form-textarea" 
                              placeholder="Tambahkan catatan untuk transaksi ini...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <a href="{{ route('cashier.dashboard') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Buat Transaksi</button>
                </div>
        </form>
    </main>
</body>
</html>
