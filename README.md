# SportMate

Aplikasi web pencarian teman olahraga berdasarkan minat, lokasi, dan jadwal aktivitas.
Dibangun dengan **Laravel 12**, Blade, dan Tailwind CSS (via CDN, tanpa proses build).

Fitur sesuai rancangan (lihat `Aplikasi_Sportmate_kel7_PEMWEBII.pdf`):
- Registrasi & Login
- Profil pengguna & pemilihan olahraga favorit
- Cari teman olahraga (filter olahraga, kota, kata kunci) + persentase match
- Sistem pertemanan (kirim, terima, tolak, batalkan)
- Buat & gabung event olahraga, riwayat aktivitas
- Panel Admin: dashboard statistik, kelola users, kelola sports, kelola events, laporan

## 1. Instalasi

Proyek ini dibuat sebagai **source code lengkap** siap pakai. Karena repository ini dibangun
tanpa akses internet, folder `vendor/` (dependency Composer) **belum ter-install**.
Jalankan langkah berikut di komputer kamu yang terhubung internet:

```bash
# 1. Ekstrak zip lalu masuk ke folder project
cd sportmate

# 2. Install dependency PHP
composer install

# 3. Duplikat file environment (sudah tersedia .env, cukup generate key)
php artisan key:generate

# 4. Buat database MySQL bernama `sportmate` (atau sesuaikan .env),
#    lalu sesuaikan kredensial DB_* di file .env

# 5. Jalankan migrasi + seeder data contoh
php artisan migrate --seed

# 6. Buat symlink storage (untuk foto profil & event)
php artisan storage:link

# 7. Jalankan server
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

## 2. Akun Demo (hasil seeder)

| Role  | Email                    | Password |
|-------|--------------------------|----------|
| Admin | admin@sportmate.test     | password |
| User  | verlyn@sportmate.test    | password |
| User  | rizky@sportmate.test     | password |
| User  | dinda@sportmate.test     | password |
| User  | fajar@sportmate.test     | password |
| User  | nadia@sportmate.test     | password |
| User  | budi@sportmate.test      | password |

## 3. Struktur Database

Mengikuti rancangan pada dokumen PDF:
- `users` — data akun & profil (+ kolom `role` untuk membedakan admin/user)
- `sports` — master data olahraga
- `user_sports` — pivot minat olahraga user + jadwal
- `events` — event olahraga yang dibuat user
- `event_participants` — peserta event
- `friends` — status pertemanan (pending / diterima / ditolak)

## 4. Catatan Teknis

- Styling menggunakan Tailwind CSS via CDN sehingga **tidak perlu** `npm install` / `npm run build`.
- Upload foto profil & event disimpan di disk `public` (`storage/app/public`), diakses lewat
  `php artisan storage:link`.
- Middleware `admin` (`app/Http/Middleware/IsAdmin.php`) melindungi seluruh route `/admin/*`.
- Jika ingin memakai SQLite untuk uji coba cepat tanpa MySQL, ubah `.env`:
  ```
  DB_CONNECTION=sqlite
  ```
  lalu buat file kosong `database/database.sqlite` dan jalankan `php artisan migrate --seed`.

Selamat mencoba! 🏸🏃‍♂️⚽
