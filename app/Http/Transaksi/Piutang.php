<?php

namespace App\Models\Transaksi;

use App\Models\MasterData\Pelanggan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'piutang';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function piutangBarang()
    {
        return $this->hasMany(PiutangBarang::class, 'piutang_id');
    }

    public function statusLunasCondition()
    {
        if($this->status_lunas == "Cash") {
            $status = "Lunas (Cash)";
        } elseif ($this->status_lunas == "Bank") {
            $status = "Lunas (Bank)";
        }
        else {
            $status = $this->status_lunas;
        }

        return $status;
    }
}
