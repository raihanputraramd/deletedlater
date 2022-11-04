<?php

namespace Database\Seeders;

use App\Models\CMS\TestimoniJudul;
use Illuminate\Database\Seeder;

class TestimoniJudulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestimoniJudul::create([
            'judul'     => 'Testimonial Pelanggan Setia Kami',
        ]);
    }
}
