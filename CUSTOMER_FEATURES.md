# Fitur Pelanggan - Heavenly Ice Cream

## Fitur yang Telah Ditambahkan

### 1. Menu Ice Cream
- **Lokasi**: `/pelanggan/menu`
- **Fitur**:
  - Menampilkan semua produk ice cream yang aktif
  - Filter berdasarkan kategori (Classic, Fruit, Premium)
  - Informasi detail produk (nama, deskripsi, harga, stok)
  - Tombol "Tambah ke Keranjang" dengan input quantity
  - Desain responsif dan modern

### 2. Keranjang Belanja
- **Lokasi**: `/pelanggan/cart`
- **Fitur**:
  - Menampilkan item yang telah ditambahkan ke keranjang
  - Update quantity dengan tombol +/- atau input manual
  - Hapus item dari keranjang
  - Perhitungan total harga otomatis
  - Tombol checkout untuk menyelesaikan pesanan
  - Tampilan kosong jika keranjang tidak ada item

### 3. Sidebar Pelanggan yang Diperbarui
- **Fitur Baru**:
  - Link "Menu Ice Cream" untuk akses cepat ke menu
  - Link "Keranjang" dengan counter jumlah item
  - Counter otomatis update berdasarkan session cart

### 4. Dashboard Pelanggan yang Diperbarui
- **Fitur Baru**:
  - Card "Item di Keranjang" menampilkan jumlah item
  - Tombol akses cepat ke Menu dan Keranjang
  - Desain yang lebih informatif

## Cara Penggunaan

### Menambahkan Produk ke Keranjang
1. Buka halaman Menu Ice Cream
2. Pilih produk yang diinginkan
3. Masukkan jumlah quantity
4. Klik "Tambah ke Keranjang"

### Mengelola Keranjang
1. Buka halaman Keranjang
2. Update quantity dengan tombol +/- atau input manual
3. Hapus item yang tidak diinginkan
4. Klik "Checkout Sekarang" untuk menyelesaikan pesanan

### Checkout
1. Dari halaman keranjang, klik "Checkout Sekarang"
2. Sistem akan membuat transaksi baru
3. Keranjang akan dikosongkan
4. Redirect ke halaman riwayat transaksi

## Struktur Database

### Produk (Products)
- `name`: Nama produk
- `description`: Deskripsi produk
- `price`: Harga produk
- `stock`: Stok tersedia
- `category`: Kategori (classic, fruit, premium)
- `is_active`: Status aktif produk

### Transaksi (Transactions)
- `customer_id`: ID pelanggan
- `cashier_id`: ID kasir (sementara sama dengan customer_id)
- `total_amount`: Total harga
- `status`: Status transaksi (pending, completed, cancelled)
- `notes`: Catatan transaksi (berisi detail item dalam JSON)

## File yang Dibuat/Dimodifikasi

### Controller Baru
- `app/Http/Controllers/CustomerController.php`

### View Baru
- `resources/views/pelanggan/menu.blade.php`
- `resources/views/pelanggan/cart.blade.php`
- `resources/views/layouts/app.blade.php`

### View yang Dimodifikasi
- `resources/views/pelanggan/sidebar.blade.php`
- `resources/views/pelanggan/dashboard.blade.php`

### Routes Baru
- `GET /pelanggan/menu` - Halaman menu
- `GET /pelanggan/cart` - Halaman keranjang
- `POST /pelanggan/cart/add` - Tambah ke keranjang
- `PUT /pelanggan/cart/update` - Update keranjang
- `DELETE /pelanggan/cart/remove/{id}` - Hapus dari keranjang
- `POST /pelanggan/checkout` - Checkout

### Seeder Baru
- `database/seeders/ProductSeeder.php` - Data sample produk ice cream

## Catatan Teknis

1. **Session Management**: Keranjang menggunakan Laravel session untuk menyimpan data sementara
2. **Validation**: Semua input divalidasi untuk memastikan data yang benar
3. **Responsive Design**: Semua halaman responsive untuk mobile dan desktop
4. **Error Handling**: Pesan error dan success ditampilkan dengan alert
5. **Security**: CSRF protection pada semua form

## Produk Sample yang Ditambahkan

1. Vanilla Ice Cream (Classic) - Rp 15.000
2. Chocolate Ice Cream (Classic) - Rp 18.000
3. Strawberry Ice Cream (Fruit) - Rp 20.000
4. Mint Chocolate Chip (Premium) - Rp 22.000
5. Cookies & Cream (Premium) - Rp 25.000
6. Mango Ice Cream (Fruit) - Rp 19.000
7. Coffee Ice Cream (Premium) - Rp 23.000
8. Blueberry Ice Cream (Fruit) - Rp 21.000
9. Rocky Road (Premium) - Rp 28.000
10. Pistachio Ice Cream (Premium) - Rp 32.000
