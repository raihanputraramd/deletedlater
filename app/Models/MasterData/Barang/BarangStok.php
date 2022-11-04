<?php

namespace App\Models\MasterData\Barang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangStok extends Model
{
    use HasFactory;

    protected $table = 'barang_stok';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
