<?php

namespace App\Models\System;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'voucher';

    public function tanggalVoucher()
    {
        $start = Carbon::parse($this->tanggal_mulai)->translatedFormat("d F Y");
        $end = Carbon::parse($this->tanggal_berakhir)->translatedFormat("d F Y");

        return $start . ' - ' . $end;
    }
}
