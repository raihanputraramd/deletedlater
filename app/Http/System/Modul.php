<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'modul';

    public function grup()
    {
        return $this->belongsToMany(Grup::class, 'grup_modul', 'grup_id', 'modul_id');
    }
}
