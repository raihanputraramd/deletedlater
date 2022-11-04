<?php

namespace Database\Seeders;

use App\Models\CMS\ProdukJudul;
use Illuminate\Database\Seeder;

class ProdukJudulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukJudul::create([
            'judul'     => 'Daftar Produk Kami',
        ]);
    }
}
