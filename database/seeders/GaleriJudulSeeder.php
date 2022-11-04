<?php

namespace Database\Seeders;

use App\Models\CMS\GaleriJudul;
use Illuminate\Database\Seeder;

class GaleriJudulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GaleriJudul::create([
            'judul'     => 'Galeri PlayStation Toko Kami',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio.',
        ]);
    }
}
