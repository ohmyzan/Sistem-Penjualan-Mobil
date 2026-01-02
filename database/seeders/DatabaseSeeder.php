<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mobil;
use App\Models\Merk;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===============================
        //  SEED DATA USER
        // ===============================
        User::create([
            'nama'     => 'Ambaminstrator',
            'email'    => 'superadmin@gmail.com',
            'role'     => '1',
            'status'   => 1,
            'no_hp'    => '0812345678901',
            'alamat'   => 'Saranjana',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'Andrea Minstaf',
            'email'    => 'andrea@gmail.com',
            'role'     => '0',
            'status'   => 1,
            'no_hp'    => '08557635131',
            'alamat'   => 'Bandung',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'Satria Stecu',
            'email'    => 'satria@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '081234111111',
            'alamat'   => 'Surabaya',
            'password' => bcrypt('P@55word'),
        ]);
        
        User::create([
            'nama'     => 'juju',
            'email'    => 'juju@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '081111111111',
            'alamat'   => 'Jakarta',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'muhty',
            'email'    => 'muhty@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '082222222222',
            'alamat'   => 'Bandung',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'wak yusak',
            'email'    => 'wak yusak@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '083333333333',
            'alamat'   => 'Surabaya',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'aldo belok',
            'email'    => 'aldo belok@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '084444444444',
            'alamat'   => 'Medan',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'fadlah starboy',
            'email'    => 'fadlah starboy@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '085555555555',
            'alamat'   => 'Yogyakarta',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'akbar',
            'email'    => 'akbar@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '086666666666',
            'alamat'   => 'Semarang',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'eko',
            'email'    => 'eko@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '087777777777',
            'alamat'   => 'Makassar',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'ali gondrong',
            'email'    => 'ali gondrong@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '088888888888',
            'alamat'   => 'Denpasar',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'koko ridho',
            'email'    => 'koko ridho@gmail.com',
            'role'     => '2',
            'status'   => 1,
            'no_hp'    => '089999999999',
            'alamat'   => 'Palembang',
            'password' => bcrypt('P@55word'),
        ]);

        // ===============================
        //  SEED DATA MOBIL
        // ===============================
        Mobil::create([
            'nama_mobil' => 'Toyota Supra MK5',
            'brand'      => 'Toyota',
            'tahun'      => 2021,
            'stok'       => 3,
            'warna'      => 'Merah',
            'harga'      => 200000000,
            'kapasitas'  => 2,
        ]);

        Mobil::create([
            'nama_mobil' => 'Tesla Model S Plaid',
            'brand'      => 'Tesla',
            'tahun'      => 2024,
            'stok'       => 4,
            'warna'      => 'Putih',
            'harga'      => 350000000,
            'kapasitas'  => 5,
        ]);

        Mobil::create([
            'nama_mobil' => 'Porsche 911 Turbo S',
            'brand'      => 'Porsche',
            'tahun'      => 2022,
            'stok'       => 3,
            'warna'      => 'Hitam',
            'harga'      => 500000000,
            'kapasitas'  => 2,
        ]);

        Mobil::create([
            'nama_mobil' => 'Honda Civic Type R',
            'brand'      => 'Honda',
            'tahun'      => 2023,
            'stok'       => 5,
            'warna'      => 'Putih',
            'harga'      => 180000000,
            'kapasitas'  => 4,
        ]);

        Mobil::create([
            'nama_mobil' => 'BMW M4 Competition',
            'brand'      => 'BMW',
            'tahun'      => 2022,
            'stok'       => 2,
            'warna'      => 'Biru',
            'harga'      => 450000000,
            'kapasitas'  => 4,
        ]);

        Mobil::create([
            'nama_mobil' => 'Mercedes AMG GT',
            'brand'      => 'Mercedes-Benz',
            'tahun'      => 2021,
            'stok'       => 1,
            'warna'      => 'Abu-abu',
            'harga'      => 520000000,
            'kapasitas'  => 2,
        ]);

        Mobil::create([
            'nama_mobil' => 'Toyota Fortuner GR',
            'brand'      => 'Toyota',
            'tahun'      => 2023,
            'stok'       => 6,
            'warna'      => 'Hitam',
            'harga'      => 300000000,
            'kapasitas'  => 7,
        ]);

        Mobil::create([
            'nama_mobil' => 'Tesla Model 3',
            'brand'      => 'Tesla',
            'tahun'      => 2023,
            'stok'       => 5,
            'warna'      => 'Merah',
            'harga'      => 280000000,
            'kapasitas'  => 5,
        ]);

        Mobil::create([
            'nama_mobil' => 'Porsche Cayman GT4',
            'brand'      => 'Porsche',
            'tahun'      => 2022,
            'stok'       => 2,
            'warna'      => 'Kuning',
            'harga'      => 480000000,
            'kapasitas'  => 2,
        ]);

        Mobil::create([
            'nama_mobil' => 'Mitsubishi Pajero Sport',
            'brand'      => 'Mitsubishi',
            'tahun'      => 2021,
            'stok'       => 7,
            'warna'      => 'Putih',
            'harga'      => 260000000,
            'kapasitas'  => 7,
        ]);


        // ===============================
        //  SEED DATA MERK
        // ===============================
      Merk::create([
    'nama_merk'   => 'Toyota',
    'negara_asal' => 'Jepang'
]);

Merk::create([
    'nama_merk'   => 'Porsche',
    'negara_asal' => 'Jerman'
]);

Merk::create([
    'nama_merk'   => 'Tesla',
    'negara_asal' => 'Amerika Serikat'
]);

Merk::create([
    'nama_merk'   => 'Honda',
    'negara_asal' => 'Jepang'
]);

Merk::create([
    'nama_merk'   => 'BMW',
    'negara_asal' => 'Jerman'
]);

Merk::create([
    'nama_merk'   => 'Mercedes-Benz',
    'negara_asal' => 'Jerman'
]);

Merk::create([
    'nama_merk'   => 'Mitsubishi',
    'negara_asal' => 'Jepang'
]);

    }
       
}
