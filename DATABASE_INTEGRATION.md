# Integrasi Database - Dashboard Pelanggan

## Fitur yang Telah Disambungkan ke Database

### 1. Dashboard Pelanggan
- **Data Real-time**: Semua data di dashboard sekarang diambil dari database
- **Total Transaksi**: Menghitung jumlah transaksi pelanggan dari tabel `transactions`
- **Total Pembelanjaan**: Menghitung total pembelanjaan dari transaksi yang statusnya 'completed'
- **Status Keanggotaan**: Otomatis berdasarkan total pembelanjaan:
  - Bronze: < Rp 500.000
  - Silver: Rp 500.000 - Rp 999.999
  - Gold: ≥ Rp 1.000.000
- **Chart Aktivitas**: Menampilkan data pembelian 7 hari terakhir
- **Transaksi Terbaru**: Menampilkan 5 transaksi terakhir dengan detail lengkap

### 2. Riwayat Transaksi
- **Data Dinamis**: Semua transaksi diambil dari database
- **Format ID**: TRX + 3 digit angka (contoh: TRX001, TRX012)
- **Status Warna**: 
  - Lunas (Hijau)
  - Pending (Orange)
  - Dibatalkan (Merah)
- **Detail Transaksi**: Tombol detail untuk setiap transaksi

### 3. Struktur Data Transaksi
- **customer_id**: ID pelanggan yang melakukan transaksi
- **cashier_id**: ID kasir (sementara sama dengan customer_id)
- **total_amount**: Total harga transaksi
- **status**: Status transaksi (pending, completed, cancelled)
- **notes**: JSON string berisi detail item dalam keranjang
- **created_at**: Timestamp pembuatan transaksi

## Controller Methods

### CustomerController::dashboard()
```php
public function dashboard()
{
    $user = Auth::user();
    
    // Hitung total transaksi
    $totalTransactions = Transaction::where('customer_id', $user->id)->count();
    
    // Hitung total pembelanjaan
    $totalSpending = Transaction::where('customer_id', $user->id)
        ->where('status', 'completed')
        ->sum('total_amount');
    
    // Ambil transaksi terbaru
    $recentTransactions = Transaction::where('customer_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    
    // Data chart 7 hari terakhir
    $chartData = []; // Array data pembelian harian
    $chartLabels = []; // Array label tanggal
    
    // Status keanggotaan
    $membershipStatus = 'Bronze'; // atau 'Silver', 'Gold'
    
    return view('pelanggan.dashboard', compact(...));
}
```

### CustomerController::riwayat()
```php
public function riwayat()
{
    $user = Auth::user();
    
    // Ambil semua transaksi pelanggan
    $transactions = Transaction::where('customer_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('pelanggan.riwayat', compact('transactions'));
}
```

## Data Sample

### Transaksi Sample (7 transaksi)
1. **TRX001**: Vanilla + Chocolate (Rp 45.000) - Completed
2. **TRX002**: Strawberry + Mint Chocolate Chip (Rp 67.000) - Completed
3. **TRX003**: Cookies & Cream (Rp 25.000) - Completed
4. **TRX004**: Mango + Coffee (Rp 53.000) - Completed
5. **TRX005**: Blueberry (Rp 21.000) - Completed
6. **TRX006**: Rocky Road + Pistachio (Rp 60.000) - Completed
7. **TRX007**: Vanilla + Strawberry (Rp 33.000) - Pending

### Total Pembelanjaan Sample
- **Total Transaksi**: 7 transaksi
- **Total Pembelanjaan**: Rp 304.000 (6 transaksi completed)
- **Status Keanggotaan**: Bronze (karena < Rp 500.000)

## Routes yang Diupdate

```php
// Dashboard pelanggan (sekarang menggunakan controller)
Route::get('/pelanggan/dashboard', [CustomerController::class, 'dashboard'])->name('pelanggan.dashboard');

// Riwayat transaksi (sekarang menggunakan controller)
Route::get('/pelanggan/riwayat', [CustomerController::class, 'riwayat'])->name('pelanggan.riwayat');
```

## Seeder yang Ditambahkan

### CustomerTransactionSeeder
- Membuat 7 transaksi sample untuk testing
- Transaksi tersebar dalam 7 hari terakhir
- Berbagai kombinasi produk dan status
- Total pembelanjaan Rp 304.000

## Perbaikan Data Structure

### Format Notes Transaksi
Sebelum:
```json
"Order from customer portal - Items: {\"1\":2,\"3\":1}"
```

Sesudah:
```json
{"1":2,"3":1}
```

### Perhitungan Item Count
```php
$cartItems = json_decode($transaction->notes, true);
$itemCount = array_sum($cartItems);
```

## Fitur Chart

### Data Chart 7 Hari Terakhir
- Mengambil data pembelian harian dari database
- Format label: "Jan 15", "Jan 16", dst
- Data: Array nilai pembelian per hari
- Hanya transaksi dengan status 'completed'

### Contoh Data Chart
```php
$chartLabels = ['Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20', 'Jan 21'];
$chartData = [45000, 67000, 25000, 53000, 21000, 60000, 33000];
```

## Keuntungan Integrasi Database

1. **Data Real-time**: Dashboard selalu menampilkan data terbaru
2. **Akurasi**: Perhitungan otomatis dan akurat
3. **Skalabilitas**: Bisa menangani ribuan transaksi
4. **Konsistensi**: Data seragam di seluruh aplikasi
5. **Analytics**: Bisa dibuat laporan dan analisis mendalam
6. **Backup**: Data tersimpan aman di database

## Testing

Untuk testing, jalankan:
```bash
php artisan db:seed --class=CustomerTransactionSeeder
```

Ini akan membuat 7 transaksi sample yang bisa dilihat di dashboard dan riwayat transaksi.
