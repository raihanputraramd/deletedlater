<?php

namespace App\Models\Transaksi;

use App\Models\MasterData\Pelanggan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function penjualanBarang()
    {
        return $this->hasMany(PenjualanBarang::class, 'penjualan_id');
    }

    public function subTotal()
    {
        $subTotal = $this->penjualanBarang->sum('total');

        return $subTotal;
    }

    public function hitungTotal()
    {
        $subTotal = $this->penjualanBarang->sum('total');
        $potongan = $this->potongan;
        $ppn = $this->ppn;
        $total = $subTotal - $potongan + $ppn;
        if ($subTotal < 1) {
            $total = 0;
        }

        return $total;
    }
}
