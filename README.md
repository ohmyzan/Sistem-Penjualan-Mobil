# 🚗 Sigma Automobil - Sistem Informasi Dealer Mobil Terintegrasi

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-Payment_Gateway-00A859?style=for-the-badge&logo=convertio&logoColor=white)

**Sigma Automobil** adalah aplikasi web sistem informasi penjualan dan pemesanan mobil modern. Sistem ini memfasilitasi pelanggan dari tahap pencarian katalog armada, pemesanan (SPK), hingga penyelesaian transaksi _Booking Fee_ secara aman dan instan menggunakan Payment Gateway. Dilengkapi dengan _Admin Dashboard_ berkinerja tinggi untuk operasional dealer.

---

## ✨ Fitur Unggulan

1. **Autentikasi Modern (SSO):** Pengguna dapat mendaftar secara manual atau _login_ instan dengan sekali klik menggunakan integrasi **Google OAuth 2.0**.
2. **Automated Payment Gateway:** Terintegrasi penuh dengan **Midtrans Snap API**. Pembayaran DP/Booking Fee divalidasi secara otomatis melalui sistem _Webhook/Callback_, tanpa perlu verifikasi manual.
3. **Katalog Armada Dinamis:** Filter cerdas berdasarkan tipe mobil, dilengkapi manajemen status ketersediaan unit dan harga.
4. **Member Area Premium:** Dashboard khusus bagi pelanggan untuk melacak riwayat status transaksi menggunakan `kode_booking`.
5. **Role-Based Access Control (RBAC):** Sistem manajemen akses ketat yang memisahkan otoritas antara Pelanggan, Admin (Operasional), dan Super Admin (Manajemen).

---

## 📸 Tangkapan Layar (Screenshots)

_(Akan diperbarui - Tempatkan screenshot aplikasi di sini)_

- `[Screenshot Beranda & Katalog]`
- `[Screenshot Form Login & Google SSO]`
- `[Screenshot Admin Dashboard]`
- `[Screenshot Pop-up Pembayaran Midtrans]`

---

## 📊 Arsitektur & Pemodelan Sistem (UML)

Diagram di bawah ini dirender secara otomatis menggunakan sintaks Mermaid.js untuk memetakan alur bisnis Sigma Automobil berdasarkan struktur _database_ aktual.

### 1. Entity Relationship Diagram (ERD) & Logical Record Structure (LRS)

Mendeskripsikan rancangan basis data dan relasi antar entitas kunci.

```mermaid
erDiagram
    USERS ||--o{ TRANSAKSIS : melakukan
    TIPES ||--o{ MOBILS : mengkategorikan
    MOBILS ||--o{ TRANSAKSIS : dipesan_dalam

    USERS {
        bigint id PK
        varchar nama
        varchar email
        varchar google_id
        tinyint role
        boolean status
        varchar password
        varchar no_hp
        text alamat
    }

    TIPES {
        bigint id PK
        varchar nama_tipe
        text deskripsi
    }

    MOBILS {
        bigint id PK
        bigint tipe_id FK
        varchar nama_mobil
        int tahun
        int stok
        varchar warna
        bigint harga
        int kapasitas
        varchar gambar_mobil
    }

    TRANSAKSIS {
        bigint id PK
        bigint user_id FK
        bigint mobil_id FK
        varchar kode_booking
        varchar no_hp
        text alamat_pengiriman
        int booking_fee
        varchar bukti_bayar
        varchar status
    }
```

### 2. Use Case Diagram

Memetakan batas interaksi antara aktor (Pelanggan, Admin, Super Admin) dengan sistem.

```mermaid
flowchart LR
    P([Pelanggan / Role 2])
    A([Admin / Role 0])
    SA([Super Admin / Role 1])

    subgraph System [SIGMA AUTOMOBIL SYSTEM]
        UC1((Akses Katalog & Promosi))
        UC2((Buat Transaksi Booking))
        UC3((Bayar DP via Midtrans))
        UC4((Kelola Data Tipe & Mobil))
        UC5((Pantau Data Transaksi))
        UC6((Kelola Hak Akses User))
        UC7((Akses Dashboard Analitik))
    end

    P --> UC1
    P --> UC2
    P --> UC3

    A --> UC1
    A --> UC4
    A --> UC5
    A --> UC7

    SA --> UC4
    SA --> UC5
    SA --> UC6
    SA --> UC7
```

### 3. Sequence Diagram: Alur Pemesanan & Pembayaran Otomatis

Menggambarkan interaksi real-time sistem dengan Midtrans API.

```mermaid
sequenceDiagram
    participant P as Pelanggan
    participant S as Sistem (Laravel)
    participant DB as Database
    participant M as Midtrans API

    P->>S: Klik Pesan & Isi Alamat Kirim
    S->>S: Generate kode_booking unik
    S->>DB: Simpan Transaksi (Status PENDING)
    DB-->>S: Return Data Transaksi
    S->>M: Request Snap Token API
    M-->>S: Return Token JSON
    S-->>P: Tampilkan UI Midtrans Snap
    P->>M: Selesaikan Pembayaran (VA/Qris)
    M->>S: Webhook / API Callback
    S->>DB: Update Status Transaksi ke DIPROSES
    S-->>P: Tampilkan Invoice Lunas
```

### 4. Class Diagram (Model MVC)

Representasi relasi struktur kode Object-Oriented pada Model Laravel.

```mermaid
classDiagram
    class User {
        +int id
        +string nama
        +string email
        +int role
        +string no_hp
        +text alamat
        +transaksis()
    }
    class Tipe {
        +int id
        +string nama_tipe
        +text deskripsi
        +mobils()
    }
    class Mobil {
        +int id
        +int tipe_id
        +string nama_mobil
        +int tahun
        +int stok
        +bigint harga
        +tipe()
        +transaksis()
    }
    class Transaksi {
        +int id
        +int user_id
        +int mobil_id
        +string kode_booking
        +int booking_fee
        +string status
        +user()
        +mobil()
    }

    User "1" -- "*" Transaksi : melakukan >
    Tipe "1" -- "*" Mobil : memiliki >
    Mobil "1" -- "*" Transaksi : terhubung >
```

---

## 📁 Struktur Direktori Utama

Proyek ini mengadopsi arsitektur MVC Laravel dengan penempatan Controller yang terpusat untuk pengunjung dan terpisah khusus untuk operasional Admin.

```

---

## 👥 Hak Akses Kredensial (Testing)

| Role | Keterangan Akses | Email Default | Password |
|---|---|---|---|
| **Super Admin (1)** | Akses seluruh fitur + Data User | `superadmin@gmail.com` | `password` |
| **Admin (0)** | Akses operasional armada & transaksi | `ichwan@gmail.com` | `password` |
| **Pelanggan (2)** | Akses halaman utama & booking mobil | `mario@gmail.com` | `password` |

> Gunakan email di atas untuk pengujian, atau jalankan seeder untuk generate ulang data.

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti instruksi berikut untuk menjalankan proyek ini di mesin lokal Anda:

### Persyaratan Sistem

- PHP >= 8.1
- Composer 2.x
- MySQL / MariaDB
- Node.js & NPM

### Langkah Instalasi

#### 1. Kloning Repositori

```bash
git clone https://github.com/USERNAME_ANDA/sigma-automobil.git
cd sigma-automobil
```

#### 2. Install Library & Dependencies

```bash
composer install
npm install && npm run build
```

#### 3. Konfigurasi Environment

Salin file konfigurasi bawaan dan sesuaikan nilainya:

```bash
cp .env.example .env
```

Buka file `.env` dan atur konfigurasi database serta API:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_project_penjualan_mobil
DB_USERNAME=root
DB_PASSWORD=

# MIDTRANS API KEYS
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx

# GOOGLE OAUTH
GOOGLE_CLIENT_ID=xxxxxxxxxxxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=xxxxxxxxxxxx
```

#### 4. Generate Application Key & Sinkronisasi Database

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

#### 5. Symlink Storage (Untuk Gambar Armada)

```bash
php artisan storage:link
```

#### 6. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi siap diakses di http://127.0.0.1:8000

---

Dibuat untuk keperluan Proyek Web Programming 3 © 2026 Sigma Automobil.
