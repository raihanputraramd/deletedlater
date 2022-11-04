<?php

namespace App\Models\Transaksi;

use App\Models\MasterData\Barang\Barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    use HasFactory;

    protected $table = 'penjualan_barang';

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function harga()
    {
        if($this->total == 0) {
            $harga = 0;
        } else {
            $harga = $this->harga;
        }

        return $harga;
    }

    public function persen()
    {
        $total = $this->harga * $this->banyak;
        $diskon = $this->diskon;

        return (100 * $diskon) / $total;
    }

}
