<?php

namespace Database\Seeders;

use App\Models\CMS\Header;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Header::create([
            'judul'     => 'Bermain Tanpa Batas',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per.',
            'logo'      => 'noimage.png',
            'gambar'    => 'noimage.png',
        ]);
    }
}
