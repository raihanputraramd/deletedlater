<?php

namespace App\Models\MasterData\Barang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangDiskon extends Model
{
    use HasFactory;

    protected $table = 'barang_diskon';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
