# Troubleshooting Login - Heavenly Ice Cream

## Masalah yang Telah Diperbaiki

### 1. **Inkonsistensi Role Names**
**Masalah**: 
- Seeder menggunakan `'cashier'` 
- AuthController menggunakan `'kasir'`

**Solusi**: 
- ✅ Diperbaiki AuthController untuk menggunakan `'cashier'` secara konsisten

### 2. **Missing Cashier Middleware**
**Masalah**: 
- Tidak ada middleware untuk melindungi route cashier
- Cashier bisa akses semua route pelanggan

**Solusi**: 
- ✅ Dibuat `CashierMiddleware.php`
- ✅ Daftarkan middleware di `bootstrap/app.php`
- ✅ Update routes untuk menggunakan middleware cashier

## Kredensial Login yang Benar

### 🔐 Admin Users
| Email | Password | Role | Status |
|-------|----------|------|--------|
| `admin@heavenly.com` | `admin123` | admin | ✅ Bisa Login |
| `superadmin@heavenly.com` | `admin123` | admin | ✅ Bisa Login |

### 💰 Cashier Users
| Email | Password | Role | Status |
|-------|----------|------|--------|
| `kasir@heavenly.com` | `kasir123` | cashier | ✅ Bisa Login |
| `kasir2@heavenly.com` | `kasir123` | cashier | ✅ Bisa Login |

### 👥 Customer/Pelanggan Users
| Email | Password | Role | Status |
|-------|----------|------|--------|
| `pelanggan@heavenly.com` | `pelanggan123` | pelanggan | ✅ Bisa Login |
| `john@example.com` | `password123` | pelanggan | ✅ Bisa Login |
| `jane@example.com` | `password123` | pelanggan | ✅ Bisa Login |
| `ahmad@example.com` | `password123` | pelanggan | ✅ Bisa Login |
| `siti@example.com` | `password123` | pelanggan | ✅ Bisa Login |

## Cara Test Login

### 1. **Test Admin Login**
```
Email: admin@heavenly.com
Password: admin123
```
**Expected Result**: Redirect ke `/admin/dashboard`

### 2. **Test Cashier Login**
```
Email: kasir@heavenly.com
Password: kasir123
```
**Expected Result**: Redirect ke `/cashier/dashboard`

### 3. **Test Customer Login**
```
Email: pelanggan@heavenly.com
Password: pelanggan123
```
**Expected Result**: Redirect ke `/pelanggan/dashboard`

## Middleware yang Aktif

### Admin Middleware
- **File**: `app/Http/Middleware/AdminMiddleware.php`
- **Alias**: `'admin'`
- **Routes**: Semua route `/admin/*`
- **Check**: `Auth::user()->role === 'admin'`

### Cashier Middleware
- **File**: `app/Http/Middleware/CashierMiddleware.php`
- **Alias**: `'cashier'`
- **Routes**: Semua route `/cashier/*`
- **Check**: `Auth::user()->role === 'cashier'`

### Auth Middleware
- **Routes**: Semua route `/pelanggan/*`
- **Check**: `Auth::check()`

## Routes yang Dilindungi

### Admin Routes (Middleware: auth + admin)
```php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', ...);
    Route::get('/admin/users', ...);
    Route::get('/admin/cashiers', ...);
    Route::get('/admin/transactions', ...);
    Route::get('/admin/reports', ...);
});
```

### Cashier Routes (Middleware: auth + cashier)
```php
Route::middleware(['auth', 'cashier'])->group(function () {
    Route::get('/cashier/dashboard', ...);
    Route::get('/cashier/transactions', ...);
    Route::get('/cashier/products', ...);
    Route::get('/cashier/reports', ...);
});
```

### Customer Routes (Middleware: auth)
```php
Route::middleware('auth')->group(function () {
    Route::get('/pelanggan/dashboard', ...);
    Route::get('/pelanggan/menu', ...);
    Route::get('/pelanggan/cart', ...);
    Route::get('/pelanggan/riwayat', ...);
});
```

## Troubleshooting Steps

### Jika Masih Tidak Bisa Login

1. **Clear Cache**
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

2. **Restart Server**
```bash
php artisan serve
```

3. **Check Database**
```bash
# Cek apakah user ada di database
php artisan tinker
>>> App\Models\User::all()->pluck('email', 'role')
```

4. **Re-run Seeder**
```bash
php artisan db:seed --class=UserSeeder
```

5. **Check Logs**
```bash
# Cek log Laravel
tail -f storage/logs/laravel.log
```

### Jika Ada Error Middleware

1. **Check Middleware Registration**
```bash
php artisan route:list --middleware=admin
php artisan route:list --middleware=cashier
```

2. **Clear Route Cache**
```bash
php artisan route:clear
php artisan config:clear
```

### Jika Redirect Tidak Benar

1. **Check AuthController**
- Pastikan role check sudah benar
- Pastikan route names sudah benar

2. **Check Routes**
- Pastikan route sudah terdaftar
- Pastikan middleware sudah benar

## Debug Mode

### Enable Debug
```php
// di .env
APP_DEBUG=true
```

### Check User Data
```bash
php artisan tinker
>>> $user = App\Models\User::where('email', 'admin@heavenly.com')->first();
>>> $user->role; // Should return 'admin'
>>> $user->password; // Should be hashed
```

### Check Authentication
```bash
php artisan tinker
>>> Auth::attempt(['email' => 'admin@heavenly.com', 'password' => 'admin123']);
// Should return true
```

## Common Issues & Solutions

### Issue 1: "Email atau password salah"
**Cause**: Password tidak match atau user tidak ada
**Solution**: 
- Pastikan email benar
- Pastikan password benar
- Re-run seeder

### Issue 2: "Anda tidak memiliki akses ke halaman ini"
**Cause**: Role tidak sesuai dengan middleware
**Solution**: 
- Pastikan user memiliki role yang benar
- Check middleware configuration

### Issue 3: Redirect ke halaman yang salah
**Cause**: Logic redirect di AuthController salah
**Solution**: 
- Check role conditions di AuthController
- Pastikan route names benar

## Testing Checklist

- [ ] Admin login → `/admin/dashboard`
- [ ] Cashier login → `/cashier/dashboard`
- [ ] Customer login → `/pelanggan/dashboard`
- [ ] Admin tidak bisa akses cashier routes
- [ ] Cashier tidak bisa akses admin routes
- [ ] Customer tidak bisa akses admin/cashier routes
- [ ] Logout berfungsi dengan benar
- [ ] Session management berfungsi

## Next Steps

Setelah login berhasil:
1. Test semua fitur dashboard
2. Test role-based access
3. Test session management
4. Test logout functionality

