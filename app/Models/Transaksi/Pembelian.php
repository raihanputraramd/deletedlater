<?php

namespace App\Models\Transaksi;

use App\Models\MasterData\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function pembelianBarang()
    {
        return $this->hasMany(PembelianBarang::class, 'pembelian_id');
    }
}
