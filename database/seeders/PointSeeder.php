<?php

namespace Database\Seeders;

use App\Models\System\Point;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Point::create([
            'nominal' => 0
        ]);
    }
}
