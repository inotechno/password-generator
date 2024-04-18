# Password Manager

## Deskripsi
Proyek ini adalah aplikasi manajemen kata sandi yang dibangun menggunakan Laravel 8 sebagai backend, jQuery untuk interaksi antarmuka pengguna, dan MySQL sebagai basis data. Aplikasi ini dirancang untuk menyimpan dan mengelola kata sandi perusahaan secara lokal, tanpa tersambung ke internet. Pengguna dapat menambah, menghapus, dan mencari kata sandi perusahaan yang tersimpan dalam basis data.

## Fitur
1. **Penyimpanan kata sandi perusahaan:** Pengguna dapat menambahkan, mengedit, dan menghapus kata sandi perusahaan beserta deskripsi dan kategori yang sesuai.
2. **Pencarian kata sandi:** Fitur pencarian memungkinkan pengguna untuk mencari kata sandi berdasarkan nama perusahaan atau kategori.
3. **Antarmuka Pengguna Sederhana:** Antarmuka pengguna yang bersih dan ramah pengguna memudahkan pengguna untuk mengelola kata sandi dengan mudah.
4. **Keamanan:** Kata sandi disimpan dengan aman dalam basis data MySQL. Aplikasi ini dirancang untuk digunakan secara lokal, sehingga mengurangi risiko kebocoran data.

## Teknologi yang Digunakan
- Laravel 8: Framework PHP yang kuat dan ekstensibel untuk membangun aplikasi web modern.
- jQuery: Library JavaScript yang ringan dan cepat untuk membuat interaksi antarmuka pengguna yang dinamis.
- MySQL: Sistem manajemen basis data relasional yang digunakan untuk menyimpan dan mengelola kata sandi perusahaan.

## Cara Menggunakan
1. Pastikan PHP dan MySQL sudah terpasang di komputer lokal Anda.
2. Clone repositori ini ke komputer Anda.
3. Buatlah database MySQL baru untuk proyek ini.
4. Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan basis data (nama database, username, password, dll.).
5. Jalankan `composer install` untuk menginstal dependensi PHP.
6. Jalankan `php artisan key:generate` untuk menghasilkan kunci aplikasi baru.
7. Jalankan `php artisan migrate` untuk membuat tabel-tabel yang diperlukan di dalam basis data.
8. Jalankan `php artisan serve` untuk menjalankan server lokal.
9. Buka browser Anda dan akses `http://localhost:8000` untuk menggunakan aplikasi.

## Catatan
- Aplikasi ini hanya ditujukan untuk penggunaan lokal dan tidak seharusnya di-hosting secara online untuk alasan keamanan.
- Pastikan untuk melindungi akses ke komputer Anda dan database MySQL dengan kuat.
- Gunakan aplikasi ini dengan bijak dan tidak menyimpan informasi sensitif lainnya ke dalamnya.

Silakan berkontribusi, melaporkan masalah, atau memberikan saran untuk meningkatkan proyek ini. Terima kasih telah menggunakan Password Manager!

## Screenshot
![gambar](https://github.com/inotechno/password-generator/assets/151206616/01ef928a-beaf-4a8d-aaed-dcca91f514fe)

![gambar](https://github.com/inotechno/password-generator/assets/151206616/d9ffbb21-4185-4d1f-9808-45dc6711acdf)

