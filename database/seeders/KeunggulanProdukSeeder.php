<?php

namespace Database\Seeders;

use App\Models\CMS\KeunggulanProduk;
use Illuminate\Database\Seeder;

class KeunggulanProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KeunggulanProduk::create([
            'judul'                     => 'Keunggulan Produk Di Ahlinya Toko PlayStation',
            'keunggulan_1_judul'        => 'Langsung Dari Amerika',
            'keunggulan_1_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
            'keunggulan_2_judul'        => 'Distributor Berlisensi Asli',
            'keunggulan_2_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
            'keunggulan_3_judul'        => 'Garansi Resmi Dari Sony PlayStation',
            'keunggulan_3_deskripsi'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
            'gambar'                    => 'noimage.png',
        ]);
    }
}
