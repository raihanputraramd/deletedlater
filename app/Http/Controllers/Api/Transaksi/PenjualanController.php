<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;
use App\Models\System\Point;
use App\Models\System\Voucher;
use App\Models\Transaksi\Penjualan;
use App\Models\Transaksi\PenjualanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function getFaktur(Request $request)
    {
        $penjualan = Penjualan::where('no_faktur', $request->kodeFaktur)->firstOrFail();
        $pelanggan = Pelanggan::select('nama', 'kode', 'email')->find($penjualan->pelanggan_id);

        $penjualanBarang = PenjualanBarang::select(
            'barang.id as barangId',
            'barang.kode',
            'barang.nama as barang',
            'penjualan_barang.harga',
            'penjualan_barang.banyak',
            'penjualan_barang.diskon',
            'penjualan_barang.total',
        )->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id')
        ->where('penjualan_id', $penjualan->id)
        ->get();

        return response()->json([$penjualan, $pelanggan, $penjualanBarang]);
    }

    public function calculatePoint($total)
    {
        $nominal = Point::first() != null ? Point::first()->nominal : 0;

        $point = 0;

        if ($nominal > 0) {
            $point = $total / $nominal;
            $point = $point >= 1 ? $point : 0;

            return $point;
        }

        return $point;
    }

    public function getVoucher($kode)
    {
        $now = Carbon::now()->getTimestamp();

        $voucher = Voucher::select('id', 'kode', 'potongan', 'tanggal_mulai', 'tanggal_berakhir')
            ->where('kode', $kode)
            ->firstOrFail();

        $start = Carbon::parse($voucher->tanggal_mulai)->getTimestamp();
        $end = Carbon::parse($voucher->tanggal_berakhir)->getTimestamp();

        $data = null;
        if($now >= $start && $now <= $end) {
            $data = $voucher;
            return response()->json($data);
        }

        return $data;
    }
}
