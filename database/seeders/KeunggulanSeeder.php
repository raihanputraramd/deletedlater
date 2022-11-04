<?php

namespace Database\Seeders;

use App\Models\CMS\Keunggulan;
use Illuminate\Database\Seeder;

class KeunggulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Keunggulan::create([
            'judul'                     => 'Keunggulan Ahlinya Toko Playstation',
            'deskripsi'                 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent.',
            'keunggulan_1_judul'        => 'Original',
            'keunggulan_1_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.',
            'keunggulan_2_judul'        => 'Berkualitas',
            'keunggulan_2_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.',
            'keunggulan_3_judul'        => 'Garansi',
            'keunggulan_3_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.',
            'keunggulan_4_judul'        => 'Aman',
            'keunggulan_4_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.',
        ]);
    }
}
