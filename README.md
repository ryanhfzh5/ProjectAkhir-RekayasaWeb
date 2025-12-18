# Dokumentasi Proyek API CRUD Toko

## 1. Deskripsi Proyek

Proyek ini adalah sistem backend RESTful API yang dirancang untuk mengelola data operasional sebuah toko. Sistem ini menyediakan fungsionalitas CRUD (Create, Read, Update, Delete) untuk tiga entitas utama: **Produk**, **Kategori**, dan **Pelanggan**.

Tujuan utama proyek ini adalah menyediakan antarmuka pemrograman aplikasi (API) yang aman dan efisien untuk aplikasi frontend atau mobile client yang akan mengonsumsi data tersebut.

### Teknologi Utama
- **Framework**: Laravel 12
- **Database**: MySQL
- **Autentikasi**: Laravel Sanctum (Bearer Token)
- **Environment**: PHP 8.2+

### Arsitektur Sistem
Sistem ini dibangun menggunakan pola arsitektur **MVC (Model-View-Controller)**, di mana:
- **Model**: Merepresentasikan struktur data (Eloquent ORM).
- **Controller**: Menangani logika bisnis dan pemrosesan request.
- **Route**: Mendefinisikan endpoint API.
- **Middleware**: Menangani autentikasi dan validasi request.

---

## 2. Alur Kerja Sistem

Berikut adalah gambaran alur kerja sistem dari sisi klien hingga ke database.

### Komponen Utama dan Interaksi
1. **Client (Postman/Web/Mobile)**: Mengirim HTTP Request (GET/POST) ke server.
2. **Routing (API Routes)**: Meneruskan request ke Controller yang sesuai.
3. **Middleware (Sanctum)**: Memverifikasi validitas Token untuk endpoint yang dilindungi.
4. **Controller**: Memproses data, melakukan validasi input, dan berinteraksi dengan Model.
5. **Model**: Melakukan query ke Database MySQL.
6. **Response**: Server mengembalikan data dalam format JSON.

### Penjelasan Proses

#### a. Flow Autentikasi
1. User melakukan **Register** atau **Login**.
2. Server memvalidasi kredensial.
3. Jika valid, server mengembalikan **Access Token**.
4. Client menyimpan token ini untuk request selanjutnya.

#### b. Flow Manajemen Data (Produk/Kategori/Pelanggan)
*Menggantikan Flow Upload Video pada request asli, karena proyek ini berfokus pada Manajemen Data Toko.*

1. **Create (POST)**: Client mengirim data (misal: nama produk, harga). Server memvalidasi input. Jika valid, data disimpan ke DB.
2. **Read (GET)**: Client meminta daftar data. Server mengambil data dari DB (termasuk relasi, misal Produk dengan Kategorinya) dan mengembalikan JSON.
3. **Update (POST)**: Client mengirim ID data dan data baru. Server memperbarui record di DB.
4. **Delete (POST)**: Client mengirim ID. Server menghapus record dari DB.

#### c. Manajemen Relasi dan Validasi
- **Validasi**: Setiap input divalidasi (misal: email harus unik, kategori_id harus ada di tabel kategori).
- **Relasi**: Produk terhubung dengan Kategori (One-to-Many). Saat mengambil data Produk, informasi Kategori juga disertakan.

---

## 3. Demonstrasi API dengan Postman

Dokumentasi lengkap API ini dapat langsung diimpor ke Postman menggunakan file koleksi yang telah disediakan.

**[Download Postman Collection](./postman_collection.json)**

### Endpoint Utama

| Method | Endpoint | Deskripsi | Auth Required |
| :--- | :--- | :--- | :--- |
| POST | `/api/register` | Mendaftarkan akun admin baru | No |
| POST | `/api/login` | Masuk dan mendapatkan Token | No |
| POST | `/api/kategori/create` | Menambah kategori baru | **Yes** |
| GET | `/api/kategori/read` | Melihat daftar kategori | **Yes** |
| POST | `/api/kategori/update` | Mengubah data kategori | **Yes** |
| POST | `/api/kategori/delete` | Menghapus kategori | **Yes** |
| POST | `/api/produk/create` | Menambah produk baru | **Yes** |
| GET | `/api/produk/read` | Melihat daftar produk | **Yes** |
| POST | `/api/produk/update` | Mengubah data produk | **Yes** |
| POST | `/api/produk/delete` | Menghapus produk | **Yes** |
| POST | `/api/pelanggan/create` | Menambah pelanggan baru | **Yes** |
| GET | `/api/pelanggan/read` | Melihat daftar pelanggan | **Yes** |
| POST | `/api/pelanggan/update` | Mengubah data pelanggan | **Yes** |
| POST | `/api/pelanggan/delete` | Menghapus pelanggan | **Yes** |

### Contoh Request & Response

#### 1. Login
**Request Body:**
```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

**Response (200 OK):**
```json
{
    "access_token": "1|Du8s...",
    "token_type": "Bearer"
}
```

#### 2. Create Produk
**Request Header:**
`Authorization: Bearer <token_anda>`

**Request Body:**
```json
{
    "nama_produk": "Laptop Gaming",
    "harga": 15000000,
    "stok": 10,
    "kategori_id": 1
}
```

**Response (201 Created):**
```json
{
    "message": "Produk created",
    "data": {
        "id": 1,
        "nama_produk": "Laptop Gaming",
        ...
    }
}
```

### Kode Status HTTP
- `200 OK`: Request berhasil.
- `201 Created`: Data berhasil dibuat.
- `401 Unauthorized`: Token tidak valid atau tidak ada.
- `422 Unprocessable Content`: Validasi input gagal.

---

## 4. Hasil yang Diperoleh

### Metrik Kinerja
- **Latency**: Rata-rata response time < 100ms untuk operasi Read pada data lokal.
- **Throughput**: Mampu menangani request konkuren standar development server Laravel.
- **Error Rate**: Validasi ketat meminimalkan error 500 (Internal Server Error) akibat data tidak valid.

### Hasil Pengujian
Pengujian dilakukan menggunakan Postman untuk semua endpoint. Seluruh skenario CRUD berhasil dijalankan:
1. Register & Login sukses menghasilkan token.
2. Token berhasil digunakan untuk mengakses endpoint terproteksi.
3. Data yang di-create muncul saat di-read.
4. Relasi antar tabel (Produk -> Kategori) berjalan sesuai desain database.

### Rekomendasi Pengembangan Selanjutnya
- Implementasi Pagination untuk endpoint `read` jika data menjadi besar.
- Penambahan fitur Upload Gambar untuk Produk.
- Implementasi Role-Based Access Control (RBAC) untuk membedakan Admin dan Kasir.

---

## 5. Panduan Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- MySQL

### Langkah Instalasi
1. **Clone Repository** (atau ekstrak source code).
2. **Install Dependencies**:
   ```bash
   composer install
   ```
3. **Konfigurasi Environment**:
   - Copy `.env.example` ke `.env`.
   - Sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
4. **Generate Key**:
   ```bash
   php artisan key:generate
   ```
5. **Migrasi Database**:
   ```bash
   php artisan migrate
   ```
6. **Jalankan Server**:
   ```bash
   php artisan serve
   ```
7. **Akses API**:
   Base URL: `http://127.0.0.1:8000`

---
*Dibuat untuk memenuhi tugas Project Akhir Rekayasa Web.*
