# Ice Cream Heavenly 🍦

Sistem manajemen toko es krim berbasis web yang dibangun dengan Laravel. Website ini menyediakan platform lengkap untuk mengelola penjualan es krim dengan tiga role pengguna yang berbeda.

## Tentang Website

Ice Cream Heavenly adalah aplikasi web untuk manajemen toko es krim yang memiliki fitur:

### 🎯 **Fitur Utama**
- **Multi-Role System**: Admin, Kasir, dan Pelanggan
- **Manajemen Produk**: CRUD produk es krim dengan kategori
- **Sistem Transaksi**: Pembelian, pembayaran, dan riwayat transaksi
- **Dashboard Analytics**: Statistik penjualan dan laporan
- **Responsive Design**: Tampilan yang optimal di semua perangkat

### 👥 **Role Pengguna**

#### 🔧 **Admin**
- Dashboard dengan statistik lengkap
- Manajemen pengguna (kasir dan pelanggan)
- Manajemen produk es krim
- Laporan penjualan dan analytics
- Monitoring performa kasir

#### 💼 **Kasir**
- Dashboard kasir dengan statistik harian
- Proses transaksi penjualan
- Manajemen produk (view dan update stok)
- Laporan transaksi kasir
- Interface yang user-friendly

#### 🛒 **Pelanggan**
- Browse menu es krim dengan filter kategori
- Keranjang belanja dan checkout
- Riwayat transaksi pembelian
- Profil dan manajemen akun
- Sistem notifikasi

### 🎨 **Teknologi yang Digunakan**
- **Backend**: Laravel 10
- **Frontend**: Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Auth
- **Charts**: Chart.js
- **Icons**: SVG Icons & Emoji

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- XAMPP/WAMP/MAMP (untuk development lokal)

## 🚀 Cara Instalasi di Localhost

### 1. **Clone Repository**
```bash
git clone https://github.com/alpinneee/eskrim.git
cd eskrim
```

### 2. **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. **Konfigurasi Environment**
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. **Konfigurasi Database**
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=icecreamheavenly
DB_USERNAME=root
DB_PASSWORD=
```

### 5. **Setup Database**
```bash
# Buat database di MySQL
# Kemudian jalankan migrasi
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed
```

### 6. **Build Assets**
```bash
# Compile CSS dan JS
npm run build

# Atau untuk development dengan hot reload
npm run dev
```

### 7. **Jalankan Server**
```bash
# Start Laravel development server
php artisan serve
```

Website akan dapat diakses di: `http://127.0.0.1:8000`

## 🔐 Default Login

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

### Admin
- **Email**: admin@icecream.com
- **Password**: password

### Kasir
- **Email**: kasir@icecream.com
- **Password**: password

### Pelanggan
- **Email**: pelanggan@icecream.com
- **Password**: password

## 📱 Fitur Utama Website

### 🏠 **Dashboard**
- **Admin**: Statistik lengkap, grafik penjualan, manajemen user
- **Kasir**: Statistik harian, transaksi terbaru, performa
- **Pelanggan**: Statistik pembelian, riwayat, profil

### 🍨 **Manajemen Produk**
- CRUD produk es krim
- Kategori produk (Vanilla, Chocolate, Strawberry, dll)
- Upload gambar produk
- Manajemen stok dan harga

### 🛒 **Sistem Transaksi**
- Keranjang belanja dengan update quantity
- Checkout dengan multiple payment methods
- Generate QR Code untuk pembayaran
- Tracking status transaksi

### 📊 **Laporan & Analytics**
- Grafik penjualan harian/bulanan
- Top selling products
- Customer analytics
- Export laporan ke PDF/Excel

### 🔔 **Sistem Notifikasi**
- Notifikasi transaksi berhasil
- Promo dan penawaran khusus
- Update status pesanan
- Filter notifikasi berdasarkan kategori

## 🎨 **Design System**

Website menggunakan design system yang konsisten:
- **Warna Utama**: Blue (#3a7bd5) untuk semua role
- **Typography**: Font modern dengan hierarchy yang jelas
- **Components**: Card-based layout dengan shadow dan rounded corners
- **Responsive**: Mobile-first approach dengan Tailwind CSS

## 📁 Struktur Project

```
icecreamheavenly/
├── app/
│   ├── Http/Controllers/     # Controllers untuk setiap role
│   ├── Models/              # Eloquent models
│   └── Middleware/          # Custom middleware
├── resources/
│   ├── views/
│   │   ├── admin/          # Views untuk admin
│   │   ├── cashier/        # Views untuk kasir
│   │   ├── pelanggan/      # Views untuk pelanggan
│   │   └── auth/           # Views authentication
│   └── css/                # Tailwind CSS files
├── routes/
│   └── web.php             # Route definitions
└── database/
    ├── migrations/         # Database migrations
    └── seeders/           # Database seeders
```

## 🤝 Kontribusi

Jika Anda ingin berkontribusi pada project ini:

1. Fork repository
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Tambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lengkap.

## 📞 Kontak

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

**Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS**