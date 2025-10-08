# Data Login - Heavenly Ice Cream

## Akun yang Telah Dibuat

### 🔐 Admin Users
| Email | Password | Role | Keterangan |
|-------|----------|------|------------|
| `admin@heavenly.com` | `admin123` | Admin | Admin utama |
| `superadmin@heavenly.com` | `admin123` | Admin | Super admin |

### 💰 Cashier Users
| Email | Password | Role | Keterangan |
|-------|----------|------|------------|
| `kasir@heavenly.com` | `kasir123` | Cashier | Kasir utama |
| `kasir2@heavenly.com` | `kasir123` | Cashier | Kasir kedua |

### 👥 Customer/Pelanggan Users
| Email | Password | Role | Keterangan |
|-------|----------|------|------------|
| `pelanggan@heavenly.com` | `pelanggan123` | Pelanggan | Pelanggan test utama |
| `john@example.com` | `password123` | Pelanggan | John Doe |
| `jane@example.com` | `password123` | Pelanggan | Jane Smith |
| `ahmad@example.com` | `password123` | Pelanggan | Ahmad Rizki |
| `siti@example.com` | `password123` | Pelanggan | Siti Nurhaliza |

## Cara Login

### 1. Buka Halaman Login
- URL: `http://localhost:8000/login` atau `http://localhost:8000`
- Halaman login akan muncul secara otomatis

### 2. Masukkan Kredensial
- **Email**: Pilih salah satu email dari tabel di atas
- **Password**: Masukkan password yang sesuai

### 3. Akses Berdasarkan Role

#### 🔐 Admin Dashboard
- Login dengan akun admin
- Akses: `/admin/dashboard`
- Fitur: Kelola user, transaksi, laporan, dll

#### 💰 Cashier Dashboard
- Login dengan akun kasir
- Akses: `/cashier/dashboard`
- Fitur: Kelola transaksi, produk, laporan kasir

#### 👥 Customer Dashboard
- Login dengan akun pelanggan
- Akses: `/pelanggan/dashboard`
- Fitur: Menu ice cream, keranjang, riwayat transaksi

## Testing Scenarios

### 1. Testing Admin
```
Email: admin@heavenly.com
Password: admin123
```
**Fitur yang bisa diakses:**
- Dashboard admin
- Kelola user (tambah, edit, hapus)
- Lihat semua transaksi
- Laporan penjualan
- Kelola kasir

### 2. Testing Cashier
```
Email: kasir@heavenly.com
Password: kasir123
```
**Fitur yang bisa diakses:**
- Dashboard kasir
- Kelola transaksi
- Lihat produk
- Laporan kasir

### 3. Testing Customer
```
Email: pelanggan@heavenly.com
Password: pelanggan123
```
**Fitur yang bisa diakses:**
- Dashboard pelanggan
- Menu ice cream
- Keranjang belanja
- Riwayat transaksi
- Profil pelanggan

## Data Sample untuk Testing

### Transaksi Sample
- Akun `pelanggan@heavenly.com` sudah memiliki 7 transaksi sample
- Total pembelanjaan: Rp 304.000
- Status keanggotaan: Bronze
- Transaksi tersebar dalam 7 hari terakhir

### Produk Sample
- 10 jenis ice cream dengan berbagai kategori
- Harga mulai dari Rp 15.000 - Rp 32.000
- Kategori: Classic, Fruit, Premium

## Cara Menjalankan Seeder

### Jalankan Semua Seeder
```bash
php artisan db:seed
```

### Jalankan Seeder Tertentu
```bash
# User seeder saja
php artisan db:seed --class=UserSeeder

# Product seeder saja
php artisan db:seed --class=ProductSeeder

# Customer transaction seeder saja
php artisan db:seed --class=CustomerTransactionSeeder
```

## Keamanan

### Password Policy
- Semua password menggunakan Hash::make()
- Password sederhana untuk testing
- **Untuk production, gunakan password yang kuat**

### Email Verification
- Semua user sudah terverifikasi (email_verified_at = now())
- Tidak perlu verifikasi email untuk testing

### Role-based Access
- Setiap user memiliki role yang spesifik
- Middleware mengontrol akses berdasarkan role
- Admin bisa akses semua fitur
- Cashier terbatas pada fitur kasir
- Customer terbatas pada fitur pelanggan

## Troubleshooting

### Jika Login Gagal
1. Pastikan seeder sudah dijalankan
2. Cek email dan password dengan benar
3. Pastikan tidak ada typo

### Jika Data Tidak Muncul
1. Jalankan ulang seeder yang diperlukan
2. Cek database connection
3. Pastikan migration sudah dijalankan

### Reset Database
```bash
# Hapus semua data dan jalankan ulang
php artisan migrate:fresh --seed
```

## Catatan Penting

1. **Ini adalah data testing** - Jangan gunakan di production
2. **Password sederhana** - Hanya untuk development
3. **Email dummy** - Tidak ada email yang benar-benar aktif
4. **Data sample** - Untuk testing fitur aplikasi

## Next Steps

Setelah login berhasil, Anda bisa:
1. Test fitur menu ice cream
2. Test keranjang belanja
3. Test checkout dan transaksi
4. Test dashboard dengan data real
5. Test fitur admin dan kasir
