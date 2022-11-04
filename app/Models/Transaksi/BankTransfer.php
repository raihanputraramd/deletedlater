<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    use HasFactory;

    protected $table = 'bank_transfer';

    public function masuk()
    {
        $jumlah = 0;
        if ($this->transaksi == "Masuk") {
            $jumlah = number_format($this->jumlah_masuk,0,',','.');
        }

        return $jumlah;
    }

    public function keluar()
    {
        $jumlah = 0;
        if ($this->transaksi == "Keluar") {
            $jumlah = number_format($this->jumlah_keluar,0,',','.');
        }

        return $jumlah;
    }

    public function amount()
    {
        $jumlah = 0;
        if ($this->transaksi == "Keluar") {
            $jumlah = number_format($this->jumlah_keluar,0,',','.');
        } else {
            $jumlah = number_format($this->jumlah_masuk,0,',','.');
        }

        return $jumlah;
    }

    public function exportAmount()
    {
        $jumlah = 0;
        if ($this->transaksi == "Keluar") {
            $jumlah = $this->jumlah_keluar;
        } else {
            $jumlah = $this->jumlah_masuk;
        }

        return $jumlah;
    }
}
