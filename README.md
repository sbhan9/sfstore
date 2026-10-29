# SFStore

Toko online sederhana berbasis **Laravel** untuk penjualan produk dengan alur pemesanan terintegrasi **WhatsApp**. Pelanggan bisa melihat katalog, memesan produk, dan otomatis diarahkan ke WhatsApp untuk konfirmasi, sementara admin mengelola produk, pesanan, dan keuangan melalui panel admin.

## Fitur

### Untuk Pelanggan
- **Katalog produk** — daftar produk aktif beserta produk unggulan (*featured*).
- **Checkout** — pesanan tercatat otomatis ke database sebelum pelanggan membuka WhatsApp (dengan proteksi *rate limit* `throttle:10,1`).
- **Halaman pesanan** — pelanggan dapat melihat detail pesanannya lewat token unik (`/order/{token}`).
- **Arahkan ke WhatsApp** — setelah checkout, pesanan terbentuk dan pelanggan diarahkan ke WhatsApp admin untuk konfirmasi.

### Untuk Admin (`/admin`)
- **Login admin** — akses halaman admin dilindungi autentikasi.
- **Dashboard** — ringkasan toko (jumlah produk, total pesanan, penjualan lunas, estimasi laba) dan daftar pesanan terbaru
  - Ubah status pembayaran & status pesanan langsung dari dropdown tanpa pindah halaman.
  - Tombol **Hubungi WhatsApp** untuk menghubungi pelanggan terkait pesanan.
  - Pesanan aktif selalu di atas, pesanan berstatus *Selesai* otomatis turun ke bawah.
- **Kelola Produk** — CRUD produk lengkap (nama, kategori, deskripsi, harga, harga banding, modal/ *cost*, gambar, aktif, featured).
- **Manajemen Pesanan** — daftar pesanan lengkap dengan detail item, catatan pelanggan, ubah status pembayaran (`Belum Bayar` / `Lunas` / `Refund`) dan status pesanan (`Baru` / `Diproses` / `Selesai` / `Dibatalkan`) lewat tombol Simpan Perubahan, serta hubungi pelanggan via WhatsApp.
- **Keuangan (Finance)** — pendapatan, modal dari pesanan lunas, pencatatan pengeluaran (*expense*) dan pemantauan laba.
- **Pengaturan** — nama toko dan nomor WhatsApp yang dipakai di seluruh aplikasi.

## Teknologi

| Komponen | Keterangan |
| --- | --- |
| [Laravel](https://laravel.com) | Framework backend (PHP) |
| [Blade](https://laravel.com/docs/blade) | Templating (komponen layout admin & storefront) |
| [Tailwind CSS](https://tailwindcss.com) | Styling antarmuka |
| MySQL | Basis data (`sfstore`) |
| WhatsApp API (`wa.me`) | Integrasi konfirmasi pesanan & komunikasi pelanggan |

## Struktur Utama

```
app/Http/Controllers/
├── StoreController.php    # Storefront: katalog, checkout, halaman pesanan
└── AdminController.php    # Panel admin: dashboard, produk, pesanan, keuangan, pengaturan

resources/views/
├── store.blade.php        # Halaman katalog
├── order.blade.php        # Detail pesanan pelanggan
└── admin/
    ├── dashboard.blade.php
    ├── products.blade.php
    ├── product-form.blade.php
    ├── orders.blade.php
    ├── finance.blade.php
    └── settings.blade.php
```

## Instalasi

Syarat: PHP ≥ 8.1, Composer, dan MySQL (contoh: via XAMPP).

```bash
# 1. Pasang dependensi
composer install

# 2. Salin konfigurasi lingkungan
cp .env.example .env
php artisan key:generate

# 3. Sesuaikan koneksi database di .env
DB_CONNECTION=mysql
DB_DATABASE=sfstore
DB_USERNAME=root
DB_PASSWORD=

# 4. Jalankan migrasi (opsional: --seed)
php artisan migrate

# 5. Hubungkan penyimpanan publik untuk gambar produk
php artisan storage:link

# 6. Jalankan server
php artisan serve
```

Buka `http://localhost:8000` untuk storefront, atau `http://localhost:8000/admin` untuk panel admin ( Gunakan email dan password akun admin yang telah dibuat ).

## Alur Pemesanan

1. Pelanggan memilih produk di katalog lalu melakukan checkout.
2. Pesanan beserta itemnya tersimpan ke database dengan status **Belum Bayar** dan **Baru**.
3. Pelanggan diarahkan ke WhatsApp admin dengan detail pesanan.
4. Admin memverifikasi pembayaran dan mengubah status pesanan dari panel admin.
5. Pesanan berstatus **Lunas** ikut memengaruhi angka pendapatan, laba, dan halaman keuangan.

## Lisensi

Dikembangkan untuk kebutuhan internal / pembelajaran. Silakan sesuaikan dengan kebutuhan Anda.
