<?php

namespace Database\Seeders;

use App\Models\CMS\Footer;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Footer::create([
            'judul_alamat'          => 'Alamat',
            'judul_telepon'         => 'Ponsel',
            'judul_email'           => 'Email',
            'judul_marketplace'     => 'Marketplace',
            'alamat'                => 'Jl.a.yani no 238 Bandung pertokoan jaya plaza blok s 3-4, Kacapiring, Kec. Batununggal,',
            'jam_buka'              => 'Kami Buka Senin - Sabtu, jam 10:00 - 17:00',
            'telepon_1'             => '0858-9130-0614',
            'telepon_2'             => '0858-9130-0614',
            'email_1'               => 'email1@gmail.com',
            'email_2'               => 'email2@gmail.com',
            'icon_alamat'           => 'noimage.png',
            'icon_telepon'          => 'noimage.png',
            'icon_email'            => 'noimage.png',
            'icon_marketplace'      => 'noimage.png',
            'sosial_1_gambar'       => 'footer-facebook.svg',
            'sosial_1_link'         => 'https://www.facebook.com/profile.php?id=100063673075868',
            'sosial_2_gambar'       => 'footer-youtube.svg',
            'sosial_2_link'         => 'https://www.youtube.com/channel/UCWsMdd9JG09XFk4QmY3T36w',
            'sosial_3_gambar'       => 'footer-instagram.svg',
            'sosial_3_link'         => 'https://www.instagram.com/efata_game_solution/',
            'sosial_4_gambar'       => 'footer-tiktok.svg',
            'sosial_4_link'         => 'https://www.tiktok.com/@efatagamessolution',
            'marketplace_1_nama'    => 'Shopee',
            'marketplace_1_link'    => 'https://www.tokopedia.com/efatagames',
            'marketplace_2_nama'    => 'Tokopedia',
            'marketplace_2_link'    => 'https://www.tokopedia.com/efatagames',
            'marketplace_3_nama'    => 'Bukalapak',
            'marketplace_3_link'    => 'https://www.bukalapak.com/u/andre_buntoro212?from=omnisearch&from_keyword_history=false&search_source=omnisearch_user&source=navbar',
        ]);
    }
}
