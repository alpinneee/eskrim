<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna - Heavenly Ice Cream</title>
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
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--brown);
            margin-bottom: 1.2rem;
        }
        .form-card {
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
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--brown);
        }
        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--pink);
            border-radius: 0.8rem;
            font-size: 1rem;
            font-family: inherit;
            background: var(--white);
            color: #6B4B2B;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--purple);
        }
        .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--pink);
            border-radius: 0.8rem;
            font-size: 1rem;
            font-family: inherit;
            background: var(--white);
            color: #6B4B2B;
            transition: border-color 0.2s;
        }
        .form-select:focus {
            outline: none;
            border-color: var(--purple);
        }
        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }
        .btn {
            border: none;
            border-radius: 0.8rem;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
            display: inline-block;
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
            background: var(--mint);
            color: var(--brown);
            margin-right: 1rem;
        }
        .btn-secondary:hover {
            background: var(--brown);
            color: var(--white);
        }
        .form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
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
        }
    </style>
</head>
<body>
    @include('admin.sidebar')
    <main class="main">
        <div class="page-title">Tambah Pengguna</div>
        
        <div class="form-card">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-input @error('name') error @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input @error('password') error @enderror" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="role" class="form-label">Peran</label>
                    <select id="role" name="role" class="form-select @error('role') error @enderror" required>
                        <option value="">Pilih peran</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                    @error('role')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 