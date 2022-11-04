<?php

namespace Database\Seeders;

use App\Models\CMS\AlasanMembeli;
use Illuminate\Database\Seeder;

class AlasanMembeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AlasanMembeli::create([
            'judul'                 => 'Alasan Membeli Kepada Kami',
            'deskripsi'             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio.',
            'alasan_1_judul'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'alasan_1_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.',
            'alasan_2_judul'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'alasan_2_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.',
            'alasan_3_judul'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'alasan_3_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.',
            'alasan_4_judul'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'alasan_4_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.',
        ]);
    }
}
