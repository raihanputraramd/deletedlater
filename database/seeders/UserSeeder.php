<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'adminaw',
            'email'     => 'adminaw@mail.com',
            'password'  => Hash::make('secret')
        ]);

        User::create([
            'name'      => 'adminefata',
            'email'     => 'adminefata@mail.com',
            'password'  => Hash::make('secret')
        ]);
    }
}
