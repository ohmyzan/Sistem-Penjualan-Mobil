Saya sudah perbaiki README kamu agar lebih konsisten, rapi, dan profesional. Berikut versi yang sudah dioptimalkan:

````markdown
# 🚗 Sigma Automobil - Sistem Informasi Dealer Mobil Terintegrasi

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-00A859?style=for-the-badge&logo=midtrans&logoColor=white)

**Sigma Automobil** adalah aplikasi web sistem informasi penjualan dan pemesanan mobil modern. Sistem ini memfasilitasi pelanggan dari tahap pencarian katalog armada, pemesanan (SPK), hingga penyelesaian transaksi _Booking Fee_ secara aman. Mendukung metode pembayaran otomatis (Midtrans) maupun unggah bukti transfer manual, serta dilengkapi dengan _Admin Dashboard_ berkinerja tinggi untuk operasional dealer.

---

## ✨ Fitur Utama

1. **Autentikasi Modern (SSO):** Registrasi manual atau _login_ instan dengan integrasi **Google OAuth 2.0**.
2. **Sistem Pembayaran Hibrida:** Integrasi **Midtrans Snap API** untuk validasi otomatis + opsi transfer manual dengan unggah bukti bayar.
3. **Katalog Armada Dinamis:** Filter cerdas berdasarkan tipe mobil, lengkap dengan detail unit (tahun, stok, kapasitas, harga).
4. **Member Area Premium:** Dashboard pelanggan untuk melacak riwayat transaksi (Pending, Diproses, Selesai, Batal) menggunakan `kode_booking`.
5. **Role-Based Access Control (RBAC):** Pemisahan otoritas antara Pelanggan, Admin, dan Super Admin.
6. **UI/UX Modern:** Antarmuka bersih, responsif, dan profesional untuk pengalaman terbaik.

---

## 📸 Tangkapan Layar

_(Segera diperbarui – tempatkan screenshot aplikasi di sini)_

- Beranda & Katalog
- Form Login & Google SSO
- Admin Dashboard
- Form Pemesanan & Pembayaran

---

## 📊 Arsitektur & Pemodelan Sistem (UML)

### 1. Entity Relationship Diagram (ERD)

Relasi antar entitas database.

```mermaid
erDiagram
    users ||--o{ transaksis : "melakukan"
    tipes ||--o{ mobils : "mengkategorikan"
    mobils ||--o{ transaksis : "dipesan dalam"

    users {
        bigint id PK
        string nama
        string email
        string google_id "Nullable (SSO)"
        tinyint role "0:Admin, 1:S.Admin, 2:Pelanggan"
        boolean status
        string password
        string no_hp
        text alamat
    }

    tipes {
        bigint id PK
        string nama_tipe
        text deskripsi
    }

    mobils {
        bigint id PK
        bigint tipe_id FK
        string nama_mobil
        int tahun
        int stok
        string warna
        bigint harga
        int kapasitas
        string gambar_mobil
    }

    transaksis {
        bigint id PK
        bigint user_id FK
        bigint mobil_id FK
        string kode_booking "Unik"
        string no_hp
        text alamat_pengiriman
        int booking_fee "Default: 5000000"
        string bukti_bayar "Upload Manual / Gateway"
        string status "Pending, Diproses, Selesai, Batal"
    }
```
````

### 2. Use Case Diagram

Interaksi aktor dengan sistem.

```mermaid
flowchart LR
    P([Pelanggan / Role 2])
    A([Admin / Role 0])
    SA([Super Admin / Role 1])

    subgraph System ["SIGMA AUTOMOBIL SYSTEM"]
        UC1((Akses Katalog & Promosi))
        UC2((Buat Transaksi Booking))
        UC3((Bayar DP & Upload Bukti))
        UC4((Kelola Data Tipe & Mobil))
        UC5((Verifikasi Transaksi))
        UC6((Kelola Hak Akses User))
        UC7((Akses Dashboard Analitik))
    end

    P --> UC1
    P --> UC2
    P --> UC3

    A --> UC4
    A --> UC5
    A --> UC7

    SA --> UC4
    SA --> UC5
    SA --> UC6
    SA --> UC7
```

### 3. Sequence Diagram: Alur Transaksi Booking

```mermaid
sequenceDiagram
    participant P as Pelanggan
    participant S as Sistem (Laravel)
    participant DB as Database
    participant M as Midtrans API

    P->>S: Klik "Pesan Unit Ini" & Isi Alamat
    S->>S: Generate kode_booking unik
    S->>DB: Simpan Transaksi (Status: Pending)
    DB-->>S: Return Data Transaksi
    S-->>P: Tampilkan Halaman Pembayaran

    alt Pembayaran Gateway (Midtrans)
        P->>S: Pilih Metode VA / E-Wallet
        S->>M: Request Snap Token
        M-->>S: Return Token
        S-->>P: Tampilkan UI Midtrans
        P->>M: Selesaikan Pembayaran
        M->>S: Webhook Callback
        S->>DB: Update Status -> Diproses
    else Transfer Manual
        P->>S: Upload Bukti Bayar
        S->>DB: Simpan File ke Storage
        S-->>P: Notifikasi "Menunggu Verifikasi Admin"
    end
```

### 4. Class Diagram (Model MVC)

```mermaid
classDiagram
    class User {
        +int id
        +string nama
        +string email
        +int role
        +string no_hp
        +string alamat
        +transaksis()
    }
    class Tipe {
        +int id
        +string nama_tipe
        +string deskripsi
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

## 📁 Struktur Direktori

```text
sigma-automobil/
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/     # Logika bisnis halaman pengunjung & member
│   │   └── Backend/      # Logika bisnis dashboard admin
│   └── Models/           # Struktur Database (User, Mobil, Tipe, Transaksi)
├── routes/
│   └── web.php           # Routing & Middleware
└── resources/
    └── views/
        ├── frontend/     # Tampilan publik & keranjang
        └── backend/      # Tampilan Admin Panel
```

---

## 👥 Kredensial Testing

| Role                | Akses                                       | Email                  | Password   |
| :------------------ | :------------------------------------------ | :--------------------- | :--------- |
| **Super Admin (1)** | Semua fitur + Data User                     | `superadmin@gmail.com` | `password` |
| **Admin (0)**       | Operasional armada & verifikasi bukti bayar | `ichwan@gmail.com`     | `password` |
| **Pelanggan (2)**   | Halaman utama, booking, unggah bukti        | `mario@gmail.com`      | `password` |

---

## 🚀 Panduan Instalasi

### Persyaratan

- PHP >= 8.1
- Composer 2.x
- MySQL / MariaDB
- Node.js & NPM

### Langkah

1. **Clone Repo**

    ```bash
    git clone https://github.com/USERNAME_ANDA/sigma-automobil.git
    cd sigma-automobil
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Konfigurasi Environment**

    ```bash
    cp .env.example .env
    ```

    Sesuaikan `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_project_penjualan_mobil
    DB_USERNAME=root
    DB_PASSWORD=

    MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
    MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx

    GOOGLE_CLIENT_ID=xxxxxxxxxxxx.apps.googleusercontent.com
    GOOGLE_CLIENT_SECRET=xxxxxxxxxxxx
    ```

4. **Generate Key & Migrasi**
    ```bash
    php artisan key
    ```
