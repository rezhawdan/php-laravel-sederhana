# Rencana Setup Project PHP Laravel Sederhana

Rencana inisiasi project Laravel minimalis dengan halaman utama "Hello World", styling CSS sederhana (tanpa build tools/npm), serta dukungan container menggunakan Docker.

---

## 1. Setup Project Laravel
- Inisialisasi project Laravel baru (misalnya menggunakan Composer).
- Konfigurasi environment dasar pada file `.env`.

## 2. Pembuatan Halaman Utama ("Hello World")
- Sesuaikan route default di `routes/web.php` agar mengarah ke halaman utama.
- Buat template view baru (misal: `resources/views/home.blade.php`) dengan pesan **"Hello World"**.
- Terapkan styling CSS sederhana:
  - Menggunakan CSS internal atau file stylesheet statis di folder `public/`.
  - **Catatan:** Tidak menggunakan npm, Vite, Tailwind build, atau pustaka frontend compiler lainnya.

## 3. Containerisasi dengan Docker
- Buat `Dockerfile` untuk setup environment PHP yang memadai beserta dependensi yang dibutuhkan oleh Laravel.
- Buat file `.dockerignore` untuk membatasi file/folder yang disalin ke dalam container image (misal mengabaikan `vendor`, `.env`, dll).
- Sediakan konfigurasi server dasar (Apache/Nginx/PHP-FPM) di dalam container untuk menyajikan aplikasi Laravel.
