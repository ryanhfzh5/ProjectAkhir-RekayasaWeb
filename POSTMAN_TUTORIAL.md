# Tutorial Pengujian API dengan Postman

Berikut adalah langkah-langkah lengkap untuk menguji API menggunakan Postman.

## 1. Persiapan Awal
Pastikan server Laravel sudah berjalan. Jika belum, jalankan perintah berikut di terminal:
```bash
php artisan serve --port=8000
```
API akan dapat diakses di `http://127.0.0.1:8000/api`.

> **PENTING:**
> Pada setiap request di Postman, pastikan Anda menambahkan Header berikut agar server selalu merespons dengan JSON (bukan HTML) jika terjadi error:
> - **Key**: `Accept`
> - **Value**: `application/json`

---

## 2. Autentikasi (Mendapatkan Token)
API ini menggunakan Laravel Sanctum, jadi kita harus login terlebih dahulu untuk mendapatkan **Bearer Token**.

### A. Register (Pendaftaran Akun Baru)
1. Buat request baru di Postman.
2. Set method ke **POST**.
3. Masukkan URL: `http://127.0.0.1:8000/api/register`
4. Pilih tab **Headers**.
   - Tambahkan Key: `Accept`, Value: `application/json`
5. Pilih tab **Body** > **form-data**.
6. Masukkan key dan value berikut:
   - `name`: `Nama Admin`
   - `email`: `admin@example.com`
   - `password`: `password123`
7. Klik **Send**.
8. Salin `access_token` dari respons JSON.

### B. Login (Masuk)
1. Buat request baru.
2. Set method ke **POST**.
3. Masukkan URL: `http://127.0.0.1:8000/api/login`
4. Pilih tab **Headers**.
   - Tambahkan Key: `Accept`, Value: `application/json`
5. Pilih tab **Body**.
6. Masukkan key dan value berikut:
   - `email`: `admin@example.com`
   - `password`: `password123`
7. Klik **Send**.
8. Salin `access_token` dari respons JSON.

---

## 3. Mengatur Authorization Header
Untuk semua request di bawah ini (CRUD), Anda **wajib** menyertakan token.

1. Di setiap request Postman, buka tab **Authorization**.
2. Pilih Type: **Bearer Token**.
3. Tempelkan `access_token` yang didapat dari langkah Login/Register ke kolom **Token**.
4. Jangan lupa tetap menyertakan Header `Accept: application/json`.

---

## 4. CRUD Kategori

### Create Kategori
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/kategori/create`
- **Headers**:
  - `Accept`: `application/json`
  - `Authorization`: `Bearer <token_anda>`
- **Body** (Pilih `form-data`):
  - **Key**: `nama_kategori`
  - **Value**: `Elektronik`
  - *(Pastikan checkbox di sebelah kiri Key dicentang)*

### Read Kategori
- **Method**: GET
- **URL**: `http://127.0.0.1:8000/api/kategori/read`

### Update Kategori
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/kategori/update`
- **Body** (form-data):
  - `id`: `1` (Sesuaikan dengan ID kategori yang ada)
  - `nama_kategori`: `Elektronik Rumah Tangga`

### Delete Kategori
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/kategori/delete`
- **Body** (form-data):
  - `id`: `1`

---

## 5. CRUD Produk
Pastikan sudah ada data Kategori sebelum membuat Produk.

### Create Produk
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/produk/create`
- **Body** (form-data):
  - `nama_produk`: `Laptop Gaming`
  - `harga`: `15000000`
  - `stok`: `10`
  - `kategori_id`: `1` (Gunakan ID kategori yang valid)

### Read Produk
- **Method**: GET
- **URL**: `http://127.0.0.1:8000/api/produk/read`

### Update Produk
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/produk/update`
- **Body** (form-data):
  - `id`: `1`
  - `harga`: `14500000`

### Delete Produk
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/produk/delete`
- **Body** (form-data):
  - `id`: `1`

---

## 6. CRUD Pelanggan

### Create Pelanggan
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/pelanggan/create`
- **Body** (form-data):
  - `nama`: `Budi Santoso`
  - `email`: `budi@example.com`
  - `nomor_telepon`: `08123456789`
  - `alamat`: `Jl. Merdeka No. 10`

### Read Pelanggan
- **Method**: GET
- **URL**: `http://127.0.0.1:8000/api/pelanggan/read`

### Update Pelanggan
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/pelanggan/update`
- **Body** (form-data):
  - `id`: `1`
  - `alamat`: `Jl. Sudirman No. 5`

### Delete Pelanggan
- **Method**: POST
- **URL**: `http://127.0.0.1:8000/api/pelanggan/delete`
- **Body** (form-data):
  - `id`: `1`
