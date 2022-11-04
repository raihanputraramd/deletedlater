<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $table = 'grup';

    public function modul()
    {
        return $this->belongsToMany(Modul::class, 'grup_modul', 'grup_id', 'modul_id');
    }
}
