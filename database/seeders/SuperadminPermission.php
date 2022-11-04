<?php

namespace Database\Seeders;

use App\Models\System\Grup;
use App\Models\System\Modul;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperadminPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grup = new Grup();
        $grup->nama = 'Superadmin';
        $grup->save();

        $user = User::first();
        $user->grup_id = $grup->id;
        $user->save();

        $modul = Modul::pluck('id');
        $grupPermission = Grup::findOrFail($grup->id);
        $grupPermission->modul()->sync($modul);
    }
}
