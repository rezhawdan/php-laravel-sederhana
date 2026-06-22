# Rencana Fitur Registrasi User & Konfigurasi Database Docker

Rencana high-level untuk mengimplementasikan fitur registrasi user dengan penyimpanan database MySQL menggunakan Docker Compose, serta antarmuka sederhana tanpa npm.

---

## 1. Setup Database dengan Docker Compose
- Buat file `docker-compose.yml` yang mendefinisikan service:
  - **laravel-app**: Service untuk aplikasi Laravel (menggunakan Dockerfile yang ada).
  - **mysql-db**: Service database MySQL yang dapat diakses oleh container Laravel.
- Konfigurasi file `.env` di Laravel untuk menghubungkan ke service database MySQL tersebut.

## 2. Struktur Database (Migration)
- Pastikan migration tabel `users` memiliki kolom yang sesuai:
  - `name` (nama lengkap)
  - `email` (unik)
  - `password`

## 3. Logika Registrasi (Controller & Route)
- Buat route untuk menampilkan halaman registrasi (GET) dan memproses registrasi (POST).
- Buat Controller (misal: `RegisterController`) untuk memproses pendaftaran:
  - Validasi input (nama lengkap, email, password).
  - Simpan data user ke database dengan password dienkripsi menggunakan `bcrypt` (`Hash::make`).
  - Redirect user setelah berhasil mendaftar (misal ke halaman utama dengan pesan sukses).

## 4. Antarmuka Registrasi (View & Style)
- Buat template view baru (misal: `resources/views/auth/register.blade.php`).
- Sediakan form input: Nama Lengkap, Email, Password, dan Konfirmasi Password.
- Terapkan styling CSS sederhana menggunakan CSS internal atau file stylesheet statis di folder `public/` (tanpa instalasi npm/build tools).
