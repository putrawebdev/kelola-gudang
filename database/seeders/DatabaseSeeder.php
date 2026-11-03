<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Gudang',
                'password' => bcrypt('password'),
            ]
        );

        $kategoriElektronik = Kategori::firstOrCreate(['nama' => 'Elektronik']);
        $kategoriAksesoris = Kategori::firstOrCreate(['nama' => 'Aksesoris']);

        Barang::firstOrCreate([
            'nama' => 'Monitor',
        ], [
            'kategori_id' => $kategoriElektronik->id,
            'harga' => 2000000,
            'stok' => 98,
        ]);

        Barang::firstOrCreate([
            'nama' => 'Handphone',
        ], [
            'kategori_id' => $kategoriElektronik->id,
            'harga' => 3000000,
            'stok' => 70,
        ]);

        Barang::firstOrCreate([
            'nama' => 'Keyboard',
        ], [
            'kategori_id' => $kategoriAksesoris->id,
            'harga' => 450000,
            'stok' => 120,
        ]);
    }
}
