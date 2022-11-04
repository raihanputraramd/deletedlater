<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\PenjualanExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Barang\Barang;
use App\Models\MasterData\Barang\BarangStok;
use App\Models\MasterData\Pelanggan;
use App\Models\System\LimitTransaksi;
use App\Models\Transaksi\BankTransfer;
use App\Models\Transaksi\KasTunai;
use App\Models\Transaksi\Penjualan;
use App\Models\Transaksi\PenjualanBarang;
use App\Models\Transaksi\Piutang;
use App\Models\Transaksi\PiutangBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanController extends Controller
{
    public function create()
    {
        if (HelpersUser::checkPermission('Transaksi Penjualan')) {
            $totalTransaksi = Penjualan::where('tanggal', Carbon::now()->format('Y-m-d'))->sum('total');
            $limitTransaksi = LimitTransaksi::first() != null ? LimitTransaksi::first()->nominal : 20000000;
            if ($totalTransaksi > $limitTransaksi) {
                return redirect()->route('back.home.index')->with('limitTransaksi', 'Limit Transaksi');
            }

            $count = Penjualan::where('tanggal', Carbon::now()->format('Y-m-d'))->count();
            $kodeTanggal = Carbon::now()->format('d.m.y');
            $nomorFaktur = $kodeTanggal . '#'. str_pad($count + 1 , 3, '0', STR_PAD_LEFT);

            return view('back.transaksi.penjualan.create', compact('nomorFaktur'));
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Transaksi Penjualan')) {
            DB::beginTransaction();
            try {
                $count = Penjualan::where('tanggal', Carbon::now()->format('Y-m-d'))->count();
                $kodeTanggal = Carbon::now()->format('d.m.y');
                $nomorFaktur = $kodeTanggal . '#'. str_pad($count + 1 , 3, '0', STR_PAD_LEFT);

                $pelanggan = Pelanggan::findOrFail($request->pelanggan);
                $pelanggan->point = $pelanggan->point + $request->point;
                $pelanggan->save(); 
    
                $penjualan = new Penjualan();
                $penjualan->pelanggan_id    = $request->pelanggan;
                $penjualan->no_faktur       = $nomorFaktur;
                $penjualan->tanggal         = $request->tanggal;
                $penjualan->sub_total       = $request->sub_total;
                $penjualan->potongan        = $request->potongan;
                $penjualan->ppn             = $request->ppn;
                $penjualan->bayar           = $request->bayar;
                $penjualan->kembali         = $request->kembali;
                $penjualan->total           = $request->totalBelanja;
                $penjualan->tipe_pembayaran = $request->tipe_pembayaran;
                $penjualan->save();
    
                if (!empty($request->barang)) {
                    $requestBarang = count($request->barang);
                    for ($i = 0; $i < $requestBarang; $i++) {
                        $penjualanBarang                       = new PenjualanBarang();
                        $penjualanBarang->penjualan_id         = $penjualan->id;
                        $penjualanBarang->barang_id            = $request->barang[$i];
                        $penjualanBarang->tanggal              = $request->tanggal;
                        $penjualanBarang->harga                = $request->harga[$i];
                        $penjualanBarang->banyak               = $request->banyak[$i];
                        $penjualanBarang->sub_total            = $request->harga[$i] * $request->banyak[$i];
                        $penjualanBarang->diskon               = $request->diskon[$i];
                        $penjualanBarang->total                = $request->total[$i];
                        $penjualanBarang->save();
    
                        $barang = Barang::findOrFail($request->barang[$i]);
                        $barang->omset = $barang->omset + $request->banyak[$i];
                        $barang->save();
    
                        $barangStok = BarangStok::where('barang_id', $request->barang[$i])->first();
                        $barangStok->stok = $barangStok->stok - $request->banyak[$i];
                        $barangStok->save();
                    }
                }
    
                if ($penjualan->tipe_pembayaran == "Cash") {
                    $kasTunai                  = new KasTunai();
                    $kasTunai->transaksi       = 'Kas Masuk';
                    $kasTunai->jumlah_masuk    = $request->totalBelanja;
                    $kasTunai->keterangan      = 'Faktur Jual: '. $penjualan->no_faktur . ' - ' . $penjualan->pelanggan->nama;
                    $kasTunai->user_id         = auth()->user()->id;
                    $kasTunai->save();
                }
    
                if ($penjualan->tipe_pembayaran == "Transfer" || $penjualan->tipe_pembayaran == "Debit Card" || $penjualan->tipe_pembayaran == "Credit Card") {
                    $bankTransfer                  = new BankTransfer();
                    $bankTransfer->transaksi       = 'Masuk';
                    $bankTransfer->jumlah_masuk    = $request->totalBelanja;
                    $bankTransfer->keterangan      = 'Faktur Jual: '. $penjualan->no_faktur . ' - ' . $penjualan->pelanggan->nama;
                    $bankTransfer->tanggal         = $request->tanggal_transfer;
                    $bankTransfer->bank            = $request->bank;
                    $bankTransfer->user_id         = auth()->user()->id;
                    $bankTransfer->save();
                }
    
                if ($penjualan->tipe_pembayaran == "Piutang") {
                    $piutang                    = new Piutang();
                    $piutang->penjualan_id      = $penjualan->id;
                    $piutang->pelanggan_id      = $request->pelanggan;
                    $piutang->nik               = $request->nik;
                    $piutang->jatuh_tempo       = $request->jatuh_tempo;
                    $piutang->nominal           = $request->nominal;
                    $piutang->save();
    
                    if (!empty($request->barang)) {
                        $requestBarang = count($request->barang);
                        for ($i = 0; $i < $requestBarang; $i++) {
                            $piutangBarang = new PiutangBarang();
                            $piutangBarang->piutang_id  = $piutang->id;
                            $piutangBarang->barang_id   = $request->barang[$i];
                            $piutangBarang->save();
                        }
                    }
                }
    
                DB::commit();
                return redirect()->route('back.transaksi.penjualan.print', $penjualan->id)->with('success', 'Transaksi telah berhasil');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function print($id)
    {
        if (HelpersUser::checkPermission('Transaksi Penjualan')) {
            $penjualan = Penjualan::findOrFail($id);

            return view('back.transaksi.penjualan.print', compact('penjualan'));
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function exportExcel($id)
    {
        if (HelpersUser::checkPermission('Transaksi Penjualan')) {
            $penjualan = Penjualan::findOrFail($id);

            return Excel::download(new PenjualanExport($penjualan),  'list-penjualan-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
