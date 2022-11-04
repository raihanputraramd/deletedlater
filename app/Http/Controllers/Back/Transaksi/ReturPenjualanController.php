<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Barang\BarangStok;
use App\Models\Transaksi\Penjualan;
use App\Models\Transaksi\PenjualanBarang;
use App\Models\Transaksi\ReturPenjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturPenjualanController extends Controller
{
    public function create()
    {
        if (HelpersUser::checkPermission('Transaksi Retur Penjualan')) {
            return view('back.transaksi.retur-penjualan.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');

    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Transaksi Retur Penjualan')) {
            DB::beginTransaction();
            try {
                $penjualan = Penjualan::where('no_faktur', $request->faktur)->firstOrFail();
    
                if (!empty($request->barang)) {
                    $requestBarang = count($request->barang);
                    for ($i = 0; $i < $requestBarang; $i++) {
                        $returPenjualan = new ReturPenjualan();
                        $returPenjualan->penjualan_id = $penjualan->id;
                        $returPenjualan->barang_id = $request->barang[$i];
                        $returPenjualan->tanggal = Carbon::now();
                        $returPenjualan->banyak = $request->banyak[$i];
                        $returPenjualan->total = $request->total_retur[$i];
                        $returPenjualan->save();
    
                        $penjualanBarang = PenjualanBarang::where('penjualan_id', $penjualan->id)
                            ->where('barang_id', $request->barang[$i])->firstOrFail();
    
                        $banyak = $penjualanBarang->banyak - $request->banyak[$i];
                        $subTotal = $penjualanBarang->harga * $banyak;
                        $diskon = $penjualanBarang->diskon != 0 ? ($penjualanBarang->diskon / $penjualanBarang->banyak) * $banyak : 0;
                        $total = $subTotal - $diskon;
    
                        $penjualanBarang->banyak = $banyak;
                        $penjualanBarang->sub_total = $subTotal;
                        $penjualanBarang->diskon = $diskon;
                        $penjualanBarang->total = $total;
                        $penjualanBarang->save();
    
                        $barangStok = BarangStok::where('barang_id', $request->barang[$i])->first();
                        $barangStok->stok = $barangStok->stok + $request->banyak[$i];
                        $barangStok->save();
                    }
                }
    
                $penjualan->no_faktur = 'R' . $penjualan->no_faktur;
                $penjualan->sub_total = $penjualan->subTotal();
                $penjualan->total = $penjualan->hitungTotal();
                $penjualan->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Retur berhasil');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
