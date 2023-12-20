# Caldera Nova

Aplikasi web berbasis Laravel untuk mengelola inventaris dan perangkat monitoring.

## Daftar Isi

- [Pengantar](#pengantar)
- [Persyaratan](#persyaratan)
- [Fitur-fitur](#fitur-fitur)
- [Instalasi](#instalasi)

## Pengantar

Caldera Nova adalah aplikasi web yang bertujuan sebagai pusat informasi yang relevan dengan proyek dept. Automation, PT. TKG Taekwang Indonesia.


## Persyaratan

- Composer - Untuk manajemen dependensi PHP, kunjungi getcomposer.org untuk instruksi instalasi.
- Node.js & npm - Untuk manajemen dependensi JavaScript, kunjungi nodejs.org untuk instruksi instalasi.
  

## Fitur-fitur

- Inventaris: Kelola barang dengan format yang menyerupai situs belanja online
- Wawasan: Lihat data ringkasan dari berbagai sistem yang dimonitoring menggunakan mikrokontroller atau perangkat lainnya.
  

## Instalasi

1. **Kloning repositori**

   ```bash
   git clone https://github.com/andimendunia/caldera-nova.git
   ```
   
2. **Menginstal dependensi**

    ```bash
    cd caldera-nova
    composer install
    npm install
    ```

3. **Mengatur variabel lingkungan**

    Duplikasi file .env.example dan ganti namanya menjadi .env. Perbarui konfigurasi yang diperlukan seperti kredensial database, dll.

4. **Men-generate key**

    ```bash
    php artisan key:generate
    ```
    
5. **Menjalankan Migrasi**

    ```bash
    php artisan migrate
    ```

6. **Memulai server development**
    ```bash
    php artisan serve
    ```
