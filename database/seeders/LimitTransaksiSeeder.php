<?php

namespace Database\Seeders;

use App\Models\System\LimitTransaksi;
use Illuminate\Database\Seeder;

class LimitTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LimitTransaksi::create([
            'nominal' => 20000000
        ]);
    }
}
