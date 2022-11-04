<?php

namespace App\Http\Controllers\Api\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function getPelanggan()
    {
        $pelanggan = Pelanggan::select('id', 'nama', 'point', 'kode', 'diskon')->get();

        return response()->json($pelanggan);
    }
}
