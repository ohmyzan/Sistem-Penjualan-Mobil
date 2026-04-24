````markdown
# 🚗 Sigma Automobil - Sistem Informasi Dealer Mobil Terintegrasi

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-00A859?style=for-the-badge&logo=midtrans&logoColor=white)

**Sigma Automobil** adalah aplikasi web sistem informasi penjualan dan pemesanan mobil modern. Sistem ini memfasilitasi pelanggan dari tahap pencarian katalog armada, pemesanan (SPK), hingga penyelesaian transaksi _Booking Fee_ secara aman dan instan menggunakan Payment Gateway. Dilengkapi dengan _Admin Dashboard_ berkinerja tinggi untuk operasional dealer.

---

## ✨ Fitur Unggulan

1. **Autentikasi Modern (SSO):** Pengguna dapat mendaftar secara manual atau _login_ instan dengan sekali klik menggunakan integrasi **Google OAuth 2.0**.
2. **Automated Payment Gateway:** Terintegrasi langsung dengan **Midtrans Snap API**. Pembayaran DP/Booking Fee divalidasi secara otomatis melalui sistem _Webhook/Callback_.
3. **Katalog Armada Dinamis:** Filter cerdas berdasarkan tipe mobil, dilengkapi manajemen status ketersediaan unit.
4. **Member Area:** Dashboard khusus bagi pelanggan untuk melacak riwayat transaksi dan status pesanan.
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

Diagram di bawah ini dirender secara otomatis menggunakan sintaks Mermaid.js untuk memetakan alur bisnis Sigma Automobil.

### 1. Entity Relationship Diagram (ERD) & Logical Record Structure (LRS)

Mendeskripsikan rancangan basis data dan relasi antar entitas kunci.

```mermaid
erDiagram
    USERS ||--o{ PESANANS : "melakukan"
    TIPES ||--o{ MOBILS : "mengkategorikan"
    MOBILS ||--o{ PESANANS : "dipesan dalam"

    USERS {
        bigint id PK
        string nama
        string email
        string password
        int role "0:Admin, 1:S.Admin, 2:Pelanggan"
        string google_id "Nullable (SSO)"
    }

    TIPES {
        bigint id PK
        string nama_tipe
    }

    MOBILS {
        bigint id PK
        bigint tipe_id FK
        string nama_mobil
        string warna
        int kapasitas
        decimal harga
        string gambar_mobil
    }

    PESANANS {
        bigint id PK
        bigint user_id FK
        bigint mobil_id FK
        string kode_pesanan "Unik"
        date tanggal_pesan
        string status_pembayaran "Pending, Success, Expired"
        string snap_token "Token Midtrans"
    }
```
````

### 2. Use Case Diagram

Memetakan batas interaksi antara aktor (Pelanggan, Admin, Super Admin) dengan sistem.

```mermaid
flowchart LR
    P([Pelanggan / Role 2])
    A([Admin / Role 0])
    SA([Super Admin / Role 1])

    subgraph System ["SIGMA AUTOMOBIL SYSTEM"]
        UC1((Akses Katalog & Promosi))
        UC2((Buat Pesanan & SPK))
        UC3((Bayar Booking Fee))
        UC4((Kelola Data Tipe & Mobil))
        UC5((Verifikasi Pesanan))
        UC6((Kelola Hak Akses))
        UC7((Akses Analitik))
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

### 3. Sequence Diagram: Alur Pemesanan & Pembayaran (Midtrans)

Menggambarkan interaksi _real-time_ objek dari sisi klien, server, database, hingga pihak ketiga (API).

```mermaid
sequenceDiagram
    participant P as Pelanggan
    participant S as Sistem (Laravel)
    participant DB as Database
    participant M as Midtrans API

    P->>S: Klik "Pesan Unit Ini"
    S->>DB: Simpan Transaksi (Status PENDING)
    DB-->>S: Kembalikan ID Pesanan
    S->>M: Request Snap Token (Kirim Harga & Item)
    M-->>S: Return Snap Token
    S-->>P: Tampilkan UI Pembayaran Midtrans
    P->>M: Input Metode Pembayaran (BCA/Qris/dll)
    M->>S: Webhook / Callback (Status SETTLEMENT)
    S->>DB: Update Transaksi menjadi SUCCESS
    S-->>P: Redirect ke Halaman Sukses
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
        +pesanans()
    }
    class Tipe {
        +int id
        +string nama_tipe
        +mobils()
    }
    class Mobil {
        +int id
        +int tipe_id
        +string nama_mobil
        +decimal harga
        +tipe()
        +pesanans()
    }
    class Pesanan {
        +int id
        +int user_id
        +int mobil_id
        +string status_pembayaran
        +user()
        +mobil()
    }

    User "1" -- "*" Pesanan : memiliki >
    Tipe "1" -- "*" Mobil : memiliki >
    Mobil "1" -- "*" Pesanan : terkait >
```

---

## 📁 Struktur Direktori Utama

Proyek ini mengadopsi pemisahan folder yang ketat antara _Frontend_ (Pengunjung) dan _Backend_ (Admin Panel).

```text
sigma-automobil/
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/     # Logika bisnis untuk halaman pengunjung & member
│   │   └── Backend/      # Logika bisnis untuk dashboard admin
│   └── Models/           # Struktur Database (User, Mobil, Tipe, Pesanan)
├── routes/
│   └── web.php           # Konfigurasi routing & Middleware
└── resources/
    └── views/
        ├── frontend/     # Tampilan (UI) publik & keranjang
        └── backend/      # Tampilan (UI) Admin Panel
```

---

## 👥 Hak Akses Kredensial (Testing)

| Role                | Keterangan Akses                   | Email Default          | Password   |
| :------------------ | :--------------------------------- | :--------------------- | :--------- |
| **Super Admin (1)** | Akses seluruh fitur + Data User    | `superadmin@gmail.com` | `password` |
| **Admin (0)**       | Akses operasional armada & pesanan | `ichwan@gmail.com`     | `password` |
| **Pelanggan (2)**   | Akses halaman utama & _checkout_   | `mario@gmail.com`      | `password` |

*(Gunakan email di atas untuk pengujian, atau jalankan seeder untuk *generate* ulang data).*

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti instruksi berikut untuk menjalankan proyek ini di mesin lokal Anda:

### Persyaratan Sistem

- PHP >= 8.1
- Composer 2.x
- MySQL / MariaDB
- Node.js & NPM

### Langkah Instalasi

1. **Kloning Repositori**

    ```bash
    git clone [https://github.com/USERNAME_ANDA/sigma-automobil.git](https://github.com/USERNAME_ANDA/sigma-automobil.git)
    cd sigma-automobil
    ```

2. **Install Library & Dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Konfigurasi Environment**
   Salin file konfigurasi bawaan dan sesuaikan nilainya:

    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan atur konfigurasi database serta API:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_sigma_automobil
    DB_USERNAME=root
    DB_PASSWORD=

    # MIDTRANS API KEYS
    MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
    MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx

    # GOOGLE OAUTH
    GOOGLE_CLIENT_ID=xxxxxxxxxxxx.apps.googleusercontent.com
    GOOGLE_CLIENT_SECRET=xxxxxxxxxxxx
    ```

4. **Generate Application Key & Sinkronisasi Database**

    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```

    _(Perintah `--seed` akan memasukkan dummy data untuk Tipe, Mobil, dan Akun Default)._

5. **Symlink Storage (Untuk Gambar)**

    ```bash
    php artisan storage:link
    ```

6. **Jalankan Aplikasi**
    ```bash
    php artisan serve
    ```
    Aplikasi siap diakses di `http://127.0.0.1:8000`

---

_Dibuat untuk keperluan Proyek Web Programming 3 © 2026 Sigma Automobil._
