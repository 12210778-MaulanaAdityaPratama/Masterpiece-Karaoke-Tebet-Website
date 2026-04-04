# 🚀 Deploy Laravel ke DirectAdmin (Tanpa SSH)

Panduan deploy project **Masterpiece Karaoke** (Laravel 12 + Vite) di hosting DirectAdmin menggunakan **File Manager** saja.

> Domain: `mptebet.berkahost.my.id`

---

## Prasyarat

| Kebutuhan | Keterangan |
|-----------|------------|
| PHP | 8.2+ (cek di DirectAdmin → PHP Version) |
| MySQL | Tersedia di DirectAdmin |
| Node.js | Di komputer lokal (untuk build assets) |
| Ekstensi PHP | `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo` |

---

## Struktur Folder di DirectAdmin

```
domains/mptebet.berkahost.my.id/
├── public_html/      ← isi dengan file dari folder public/ Laravel
│   ├── index.php     ← di-edit path-nya
│   ├── .htaccess
│   ├── build/
│   ├── images/
│   └── ...
└── laravel/          ← semua file Laravel (kecuali isi public/)
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── vendor/
    ├── .env
    └── ...
```

> [!IMPORTANT]
> Source code Laravel **harus** di luar `public_html/` agar tidak bisa diakses publik.

---

## Step 1: Build Assets di Lokal

Di komputer lokal, jalankan:

```bash
cd /home/servantin/Documents/masterpiece-karaoke
npm install
npm run build
```

Pastikan folder `public/build/` sudah muncul berisi file CSS & JS.

---

## Step 2: Buat ZIP untuk Upload

```bash
# ZIP semua file project (tanpa node_modules & .git)
cd /home/servantin/Documents/masterpiece-karaoke
zip -r masterpiece.zip . \
  -x "node_modules/*" \
  -x ".git/*" \
  -x "storage/logs/*.log" \
  -x "storage/framework/cache/data/*" \
  -x "storage/framework/sessions/*" \
  -x "storage/framework/views/*"
```

---

## Step 3: Upload & Extract di DirectAdmin

1. Buka **File Manager** di DirectAdmin
2. Navigasi ke `domains/mptebet.berkahost.my.id/`
3. **Buat folder baru** bernama `laravel`
4. Masuk ke folder `laravel/`
5. **Upload** file `masterpiece.zip`
6. Klik kanan `masterpiece.zip` → **Extract**
7. Setelah selesai, **hapus** file `masterpiece.zip` (opsional, untuk hemat space)

---

## Step 4: Pindahkan Isi `public/` ke `public_html/`

1. Di File Manager, masuk ke `domains/mptebet.berkahost.my.id/laravel/public/`
2. **Select all** file & folder:
   - `index.php`
   - `.htaccess`
   - `build/` (folder)
   - `images/` (folder)
   - `favicon.ico`
   - `robots.txt`
   - `storage` (symlink, jika ada)
3. **Move** atau **Copy** ke `domains/mptebet.berkahost.my.id/public_html/`

> [!CAUTION]
> Hapus file `index.html` default DirectAdmin yang ada di `public_html/` ! File ini yang menampilkan halaman "Domain kamu sudah terhubung...".

---

## Step 5: Edit `index.php` di `public_html/`

1. Buka `public_html/index.php` → klik **Edit**
2. **Ganti seluruh isinya** dengan:

```php
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Path ke folder laravel (satu level di atas public_html)
$laravelBase = dirname(__DIR__) . '/laravel';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $laravelBase.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $laravelBase.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once $laravelBase.'/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

> [!CAUTION]
> Ini adalah langkah **paling penting**. Tanpa ini, Laravel tidak akan berjalan.

---

## Step 6: Upload `vendor/` (Pengganti Composer Install)

Karena tidak ada SSH untuk menjalankan `composer install`, upload folder `vendor/` dari lokal:

### Di komputer lokal:

```bash
cd /home/servantin/Documents/masterpiece-karaoke

# Pastikan vendor/ sudah terinstall
composer install --optimize-autoloader --no-dev

# Zip folder vendor
zip -r vendor.zip vendor/
```

### Di DirectAdmin File Manager:

1. Masuk ke `domains/mptebet.berkahost.my.id/laravel/`
2. **Hapus** folder `vendor/` yang ada (jika kosong/incomplete)
3. **Upload** file `vendor.zip`
4. Klik kanan → **Extract**
5. Hapus `vendor.zip` setelah selesai

> [!NOTE]
> File `vendor.zip` cukup besar (~30-50MB). Pastikan koneksi stabil saat upload.

---

## Step 7: Buat Database di DirectAdmin

1. Di DirectAdmin → **MySQL Management**
2. Klik **Create new Database**
3. Isi:
   - Database Name: `masterpiece` (akan jadi `username_masterpiece`)
   - Username: `masterpiece` (akan jadi `username_masterpiece`)
   - Password: buat password yang kuat
4. Catat: **nama database**, **username**, **password**

---

## Step 8: Konfigurasi `.env`

1. Di File Manager, masuk ke `laravel/`
2. Jika belum ada `.env`, copy `.env.example` → rename jadi `.env`
3. **Edit** `.env` dan sesuaikan:

```env
APP_NAME=masterpiece
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://mptebet.berkahost.my.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_masterpiece
DB_USERNAME=username_masterpiece
DB_PASSWORD=password_yang_kamu_buat

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=aditya.neo5@gmail.com
MAIL_PASSWORD=nivzfosewioxjghg
MAIL_FROM_ADDRESS="hello@gmail.com"
MAIL_FROM_NAME="Masterpiece Signature Tebet"
```

> [!WARNING]
> - `APP_DEBUG` **harus** `false` di production!
> - Ganti `username_masterpiece` dengan nama database yang sebenarnya dari Step 7.

---

## Step 9: Jalankan Artisan via Cron Job (Trick Tanpa SSH)

Karena tidak ada terminal, gunakan **Cron Job** untuk menjalankan perintah artisan satu per satu.

### Cara:
1. Di DirectAdmin → **Cron Jobs**
2. Tambahkan cron berikut **satu per satu** (jalankan, tunggu 1 menit, lalu ganti):

### 9.1 Generate App Key
```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan key:generate --force >> /tmp/artisan.log 2>&1
```
↳ Tunggu 1 menit, lalu **hapus/ganti** cron ini.

### 9.2 Jalankan Migration
```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan migrate --force >> /tmp/artisan.log 2>&1
```
↳ Tunggu 1 menit, lalu **hapus/ganti** cron ini.

### 9.3 Jalankan Seeder (opsional)
```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan db:seed --force >> /tmp/artisan.log 2>&1
```
↳ Tunggu 1 menit, lalu **hapus/ganti** cron ini.

### 9.4 Cache Config, Routes & Views
```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan config:cache >> /tmp/artisan.log 2>&1
```
```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan route:cache >> /tmp/artisan.log 2>&1
```
```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan view:cache >> /tmp/artisan.log 2>&1
```

> [!TIP]
> - Ganti `username` dengan username DirectAdmin kamu yang sebenarnya.
> - Path PHP mungkin berbeda: coba `/usr/local/bin/php` atau `/usr/bin/php`.
> - Cek log di `/tmp/artisan.log` lewat File Manager untuk melihat hasilnya.
> - **Jangan lupa hapus semua cron ini setelah selesai!**

---

## Step 10: Buat Symlink Storage

Untuk menampilkan file upload (gambar, dll), buat cron sementara:

```
* * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan storage:link >> /tmp/artisan.log 2>&1
```

Jika tidak berhasil, buat symlink secara manual lewat cron:

```
* * * * * ln -sf /home/username/domains/mptebet.berkahost.my.id/laravel/storage/app/public /home/username/domains/mptebet.berkahost.my.id/public_html/storage
```

↳ Hapus cron setelah 1 menit.

---

## Step 11: Setup SSL (HTTPS)

1. Di DirectAdmin → **SSL Certificates**
2. Pilih **Let's Encrypt** (gratis)
3. Centang domain → klik Generate
4. Aktifkan **Force HTTPS Redirect**

---

## Step 12: Set Permission (via File Manager)

Di File Manager:
1. Klik kanan folder `laravel/storage/` → **Set Permission** → `775` (recursive)
2. Klik kanan folder `laravel/bootstrap/cache/` → **Set Permission** → `775` (recursive)

---

## Troubleshooting

| Problem | Solusi |
|---------|--------|
| **Halaman default DirectAdmin** | Hapus `index.html` di `public_html/` |
| **500 Internal Server Error** | Cek `laravel/storage/logs/laravel.log` via File Manager. Pastikan permission `775` pada `storage/` dan `bootstrap/cache/` |
| **404 Not Found** | Pastikan `.htaccess` ada di `public_html/` dan `mod_rewrite` aktif |
| **Class not found** | Folder `vendor/` belum ter-upload/extract dengan benar |
| **Vite manifest not found** | Pastikan folder `build/` ada di `public_html/` |
| **CSRF token mismatch** | Pastikan `APP_URL` benar di `.env` |
| **Blank page** | Set `APP_DEBUG=true` sementara di `.env`, cek error, lalu kembalikan ke `false` |
| **Cron tidak jalan** | Coba path PHP berbeda: `/usr/bin/php` atau `/usr/local/bin/php82` |

---

## Checklist Deploy ✅

```
[ ] npm run build di lokal
[ ] zip project & upload ke server
[ ] Extract di folder laravel/
[ ] Pindahkan isi public/ ke public_html/
[ ] Hapus index.html default di public_html/
[ ] Edit index.php di public_html/ (ganti path)
[ ] Upload & extract vendor.zip ke laravel/
[ ] Buat database di DirectAdmin
[ ] Buat & edit .env (production config)
[ ] Cron: php artisan key:generate
[ ] Cron: php artisan migrate --force
[ ] Cron: php artisan db:seed --force
[ ] Cron: php artisan storage:link
[ ] Set permission 775 (storage & bootstrap/cache)
[ ] Cron: php artisan config:cache
[ ] Cron: php artisan route:cache
[ ] Cron: php artisan view:cache
[ ] Setup SSL (Let's Encrypt)
[ ] Hapus semua cron sementara
[ ] Test akses website
[ ] Pastikan APP_DEBUG=false
```

---

## Update di Kemudian Hari

Untuk deploy update:

1. Build assets di lokal: `npm run build`
2. Zip file yang berubah
3. Upload & replace di File Manager
4. Jika ada migration baru → jalankan via Cron trick
5. Clear cache via Cron:
   ```
   * * * * * /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan config:cache && /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan route:cache && /usr/local/bin/php /home/username/domains/mptebet.berkahost.my.id/laravel/artisan view:cache
   ```
6. Hapus cron setelah selesai
