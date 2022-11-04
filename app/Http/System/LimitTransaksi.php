<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitTransaksi extends Model
{
    use HasFactory;

    protected $table = 'limit_transaksi';

    protected $guarded = ['id'];
}
