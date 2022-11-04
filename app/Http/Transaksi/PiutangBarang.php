<?php

namespace App\Models\Transaksi;

use App\Models\MasterData\Barang\Barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiutangBarang extends Model
{
    use HasFactory;

    protected $table = 'piutang_barang';

    public function piutang()
    {
        return $this->belongsTo(Piutang::class, 'piutang_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
