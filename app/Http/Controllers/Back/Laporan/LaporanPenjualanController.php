<?php

namespace App\Http\Controllers\Back\Laporan;

use App\Exports\Laporan\LaporanPenjualanExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Penjualan;
use App\Models\Transaksi\PenjualanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Laporan Penjualan')) {
            return view('back.laporan.penjualan.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Penjualan')) {
            $columns = array(
                0 => 'penjualan.no_faktur',
                1 => 'barang.nama',
                2 => 'barang.kode',
                3 => 'penjualan_barang.tanggal',
                4 => 'penjualan_barang.harga',
                5 => 'penjualan_barang.banyak',
                6 => 'penjualan_barang.diskon',
                7 => 'penjualan_barang.total',
                8 => 'pelanggan.nama',
            );
    
            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
    
            $rows = PenjualanBarang::select(
                'penjualan.no_faktur',
                'penjualan_barang.tanggal',
                'barang.kode',
                'barang.nama as barang',
                'penjualan_barang.harga',
                'penjualan_barang.banyak',
                'penjualan_barang.diskon',
                'penjualan_barang.total',
                'pelanggan.nama as pelanggan',
            )->join('penjualan', 'penjualan.id', '=', 'penjualan_barang.penjualan_id')
            ->leftJoin('pelanggan', 'pelanggan.id', '=', 'penjualan.pelanggan_id')
            ->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id');
    
            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $rows->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }
    
    
            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();
    
            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no_faktur']    = $item->no_faktur;
                $nestedData['tanggal']      = $item->tanggal;
                $nestedData['kode']         = $item->kode;
                $nestedData['barang']       = $item->barang;
                $nestedData['harga']        = number_format($item->harga(),0,',','.');
                $nestedData['banyak']       = number_format($item->banyak,0,',','.');
                $nestedData['diskon']       = number_format($item->diskon,0,',','.');
                $nestedData['total']        = number_format($item->total,0,',','.');
                $nestedData['pelanggan']    = $item->pelanggan;
    
                $data[] = $nestedData;
            }
    
            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalData),
                "data"            => $data
            );
    
            return response()->json($json_data);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function dataTotal(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Penjualan')) {
            $filter = $request->tanggal;
    
            $diskonItem = PenjualanBarang::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('diskon');
    
            $subTotal = Penjualan::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('sub_total');
    
            $potongan = Penjualan::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('potongan');
    
            $ppn = Penjualan::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('ppn');
    
            $total  = Penjualan::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('total');
    
            return response()->json([
                'diskonItem' => number_format($diskonItem,0,',','.'),
                'subTotal' => number_format($subTotal,0,',','.'),
                'potongan' => number_format($potongan,0,',','.'),
                'ppn' => number_format($ppn,0,',','.'),
                'total' => number_format($total,0,',','.'),
            ]);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function pdf(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Penjualan')) {
            $penjualanBarang = PenjualanBarang::select(
                'penjualan.no_faktur',
                'penjualan_barang.tanggal',
                'barang.kode',
                'barang.nama as barang',
                'penjualan_barang.harga',
                'penjualan_barang.banyak',
                'penjualan_barang.diskon',
                'penjualan_barang.total',
                'pelanggan.nama as pelanggan',
            )->join('penjualan', 'penjualan.id', '=', 'penjualan_barang.penjualan_id')
            ->leftJoin('pelanggan', 'pelanggan.id', '=', 'penjualan.pelanggan_id')
            ->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id');
    
            if(!empty($request->startDate)) {
                $penjualanBarang->where(function($query) use($request) {
                    $query->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $penjualanBarang->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }
    
            $penjualanBarang = $penjualanBarang->get();
    
            $pdf = PDF::loadview('back.laporan.penjualan.pdf', compact('penjualanBarang'))->setPaper('a4', 'portrait');
    
            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Penjualan')) {
            $penjualanBarang = PenjualanBarang::select(
                'penjualan.no_faktur',
                'penjualan_barang.tanggal',
                'barang.kode',
                'barang.nama as barang',
                'penjualan_barang.harga',
                'penjualan_barang.banyak',
                'penjualan_barang.diskon',
                'penjualan_barang.total',
                'pelanggan.nama as pelanggan',
            )->join('penjualan', 'penjualan.id', '=', 'penjualan_barang.penjualan_id')
            ->leftJoin('pelanggan', 'pelanggan.id', '=', 'penjualan.pelanggan_id')
            ->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id');
    
            if(!empty($request->startDate)) {
                $penjualanBarang->where(function($query) use($request) {
                    $query->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $penjualanBarang->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }
    
            $penjualanBarang = $penjualanBarang->get();

            return Excel::download(new LaporanPenjualanExport($penjualanBarang),  'list-laporan-penjualan-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
