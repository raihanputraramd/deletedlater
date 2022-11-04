<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\PembelianExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Barang\BarangStok;
use App\Models\Transaksi\BankTransfer;
use App\Models\Transaksi\Hutang;
use App\Models\Transaksi\HutangBarang;
use App\Models\Transaksi\KasTunai;
use App\Models\Transaksi\Pembelian;
use App\Models\Transaksi\PembelianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PembelianController extends Controller
{
    public function create()
    {
        if (HelpersUser::checkPermission('Transaksi Pembelian')) {
            $count = Pembelian::where('tanggal', Carbon::now()->format('Y-m-d'))->count();
            $kodeTanggal = Carbon::now()->format('d.m.y');
            $nomorFaktur = $kodeTanggal . '#'. str_pad($count + 1 , 3, '0', STR_PAD_LEFT);

            return view('back.transaksi.pembelian.create', compact('nomorFaktur'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Transaksi Pembelian')) {
            DB::beginTransaction();
            try {
                $pembelian = new Pembelian();
                $pembelian->supplier_id     = $request->supplier;
                $pembelian->no_faktur       = $request->faktur;
                $pembelian->tanggal         = $request->tanggal;
                $pembelian->sub_total       = $request->sub_total;
                $pembelian->potongan        = $request->potongan;
                $pembelian->ppn             = $request->ppn;
                $pembelian->total           = $request->totalBelanja;
                $pembelian->tipe_pembayaran = $request->tipe_pembayaran;
                $pembelian->save();
    
                if (!empty($request->barang)) {
                    $requestBarang = count($request->barang);
                    for ($i = 0; $i < $requestBarang; $i++) {
                        $pembelianBarang                       = new PembelianBarang();
                        $pembelianBarang->pembelian_id         = $pembelian->id;
                        $pembelianBarang->barang_id            = $request->barang[$i];
                        $pembelianBarang->tanggal              = $request->tanggal;
                        $pembelianBarang->harga                = $request->harga[$i];
                        $pembelianBarang->banyak               = $request->banyak[$i];
                        $pembelianBarang->sub_total            = $request->harga[$i] * $request->banyak[$i];
                        $pembelianBarang->diskon               = $request->diskon[$i];
                        $pembelianBarang->total                = $request->total[$i];
                        $pembelianBarang->save();
    
                        $barangStok = BarangStok::where('barang_id', $request->barang[$i])->first();
                        $barangStok->stok = $barangStok->stok + $request->banyak[$i];
                        $barangStok->save();
                    }
                }
    
                if ($pembelian->tipe_pembayaran == "Cash") {
                    $kasTunai                  = new KasTunai();
                    $kasTunai->transaksi       = 'Kas Keluar';
                    $kasTunai->jumlah_keluar   = $request->totalBelanja;
                    $kasTunai->keterangan      = 'Faktur Beli: '. $pembelian->no_faktur . ' - ' . $pembelian->supplier->nama;
                    $kasTunai->user_id         = auth()->user()->id;
                    $kasTunai->save();
                }
    
                if ($pembelian->tipe_pembayaran == "Transfer" || $pembelian->tipe_pembayaran == "Debit Card" || $pembelian->tipe_pembayaran == "Credit Card") {
                    $bankTransfer                  = new BankTransfer();
                    $bankTransfer->transaksi       = 'Keluar';
                    $bankTransfer->jumlah_keluar   = $request->totalBelanja;
                    $bankTransfer->keterangan      = 'Faktur Beli: '. $pembelian->no_faktur . ' - ' . $pembelian->supplier->nama;
                    $bankTransfer->user_id         = auth()->user()->id;
                    $bankTransfer->save();
                }
    
                if ($pembelian->tipe_pembayaran == "Hutang") {
                    $hutang                    = new Hutang();
                    $hutang->pembelian_id      = $pembelian->id;
                    $hutang->supplier_id       = $request->supplier;
                    $hutang->jatuh_tempo       = $request->jatuh_tempo;
                    $hutang->nominal           = $request->nominal;
                    $hutang->save();
    
                    if (!empty($request->barang)) {
                        $requestBarang = count($request->barang);
                        for ($i = 0; $i < $requestBarang; $i++) {
                            $hutangBarang = new HutangBarang();
                            $hutangBarang->hutang_id   = $hutang->id;
                            $hutangBarang->barang_id   = $request->barang[$i];
                            $hutangBarang->save();
                        }
                    }
                }
    
                DB::commit();
                return redirect()->route('back.transaksi.pembelian.print', $pembelian->id)->with('success', 'Transaksi telah berhasil');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function print($id)
    {
        if (HelpersUser::checkPermission('Transaksi Pembelian')) {
            $pembelian = Pembelian::findOrFail($id);

            return view('back.transaksi.pembelian.print', compact('pembelian'));
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function exportExcel($id)
    {
        if (HelpersUser::checkPermission('Transaksi Pembelian')) {
            $pembelian = Pembelian::findOrFail($id);

            return Excel::download(new PembelianExport($pembelian),  'list-pembelian-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
