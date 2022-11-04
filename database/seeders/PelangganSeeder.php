<?php

namespace Database\Seeders;

use App\Models\MasterData\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelanggan::create([
            'nama' => 'Umum',
            'kode' => '111',
        ]);
    }
}
