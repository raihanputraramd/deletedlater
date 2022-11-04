<?php

namespace App\Http\Controllers\Api\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Barang\Barang;
use App\Models\MasterData\Pelanggan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getBarang()
    {
        $barang = Barang::select('id', 'kode', 'nama')->get();

        return response()->json($barang);
    }

    public function getBarangPenjualan($barangId, $pelangganId, $qty, $hargaEdit = null)
    {
        $barang = Barang::findOrFail($barangId);
        $pelanggan = Pelanggan::findOrFail($pelangganId);

        $harga = $barang->harga($pelanggan->level_harga, $hargaEdit);
        $diskon = $barang->diskon($pelanggan->level_harga, $qty, $hargaEdit);
        $gambar = $barang->gambar();

        return response()->json([$harga, $diskon, $gambar]);
    }

    public function getBarangPembelian($barangId)
    {
        $barang = Barang::findOrFail($barangId);

        $harga = $barang->hargaBeli();
        $diskon = $barang->diskonBeli();
        $gambar = $barang->gambar();

        return response()->json([$harga, $diskon, $gambar]);
    }
}
