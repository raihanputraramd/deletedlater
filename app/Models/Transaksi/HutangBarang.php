<?php

namespace App\Models\Transaksi;

use App\Models\MasterData\Barang\Barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HutangBarang extends Model
{
    use HasFactory;

    protected $table = 'hutang_barang';

    public function hutang()
    {
        return $this->belongsTo(Hutang::class, 'hutang_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
