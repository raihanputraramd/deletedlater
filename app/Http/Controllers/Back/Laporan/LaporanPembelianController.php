<?php

namespace App\Http\Controllers\Back\Laporan;

use App\Exports\Laporan\LaporanPembelianExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Pembelian;
use App\Models\Transaksi\PembelianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LaporanPembelianController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Laporan Pembelian')) {
            return view('back.laporan.pembelian.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Pembelian')) {
            $columns = array(
                0 => 'pembelian.no_faktur',
                1 => 'barang.nama',
                2 => 'barang.kode',
                3 => 'pembelian_barang.tanggal',
                4 => 'pembelian_barang.harga',
                5 => 'pembelian_barang.banyak',
                6 => 'pembelian_barang.diskon',
                7 => 'pembelian_barang.total',
                8 => 'supplier.nama',
            );
    
            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
    
            $rows = PembelianBarang::select(
                'pembelian.no_faktur',
                'pembelian_barang.tanggal',
                'barang.kode',
                'barang.nama as barang',
                'pembelian_barang.harga',
                'pembelian_barang.banyak',
                'pembelian_barang.diskon',
                'pembelian_barang.total',
                'supplier.nama as supplier',
            )->join('pembelian', 'pembelian.id', '=', 'pembelian_barang.pembelian_id')
            ->join('supplier', 'supplier.id', '=', 'pembelian.supplier_id')
            ->join('barang', 'barang.id', '=', 'pembelian_barang.barang_id');
    
            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereBetween("pembelian_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $rows->where('pembelian_barang.tanggal', Carbon::now()->format('Y-m-d'));
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
                $nestedData['harga']        = number_format($item->harga,0,',','.');
                $nestedData['banyak']       = number_format($item->banyak,0,',','.');
                $nestedData['diskon']       = number_format($item->diskon,0,',','.');
                $nestedData['total']        = number_format($item->total,0,',','.');
                $nestedData['supplier']     = $item->supplier;
    
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
        if (HelpersUser::checkPermission('Laporan Pembelian')) {
            $filter = $request->tanggal;
    
            $diskonItem = PembelianBarang::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('diskon');
    
            $subTotal = Pembelian::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('sub_total');
    
            $potongan = Pembelian::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('potongan');
    
            $ppn = Pembelian::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('tanggal', Carbon::now()->format('Y-m-d'));
                }
            })->sum('ppn');
    
            $total  = Pembelian::when($filter, function ($q, $filter) use ($request) {
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
        if (HelpersUser::checkPermission('Laporan Pembelian')) {
            $pembelianBarang = PembelianBarang::select(
                'pembelian.no_faktur',
                'pembelian_barang.tanggal',
                'barang.kode',
                'barang.nama as barang',
                'pembelian_barang.harga',
                'pembelian_barang.banyak',
                'pembelian_barang.diskon',
                'pembelian_barang.total',
                'supplier.nama as supplier',
            )->join('pembelian', 'pembelian.id', '=', 'pembelian_barang.pembelian_id')
            ->join('supplier', 'supplier.id', '=', 'pembelian.supplier_id')
            ->join('barang', 'barang.id', '=', 'pembelian_barang.barang_id');
    
            if(!empty($request->startDate)) {
                $pembelianBarang->where(function($query) use($request) {
                    $query->whereBetween("pembelian_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $pembelianBarang->where('pembelian_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }
    
            $pembelianBarang = $pembelianBarang->get();
    
            $pdf = PDF::loadview('back.laporan.pembelian.pdf', compact('pembelianBarang'))->setPaper('a4', 'portrait');
    
            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Pembelian')) {
            $pembelianBarang = PembelianBarang::select(
                'pembelian.no_faktur',
                'pembelian_barang.tanggal',
                'barang.kode',
                'barang.nama as barang',
                'pembelian_barang.harga',
                'pembelian_barang.banyak',
                'pembelian_barang.diskon',
                'pembelian_barang.total',
                'supplier.nama as supplier',
            )->join('pembelian', 'pembelian.id', '=', 'pembelian_barang.pembelian_id')
            ->join('supplier', 'supplier.id', '=', 'pembelian.supplier_id')
            ->join('barang', 'barang.id', '=', 'pembelian_barang.barang_id');
    
            if(!empty($request->startDate)) {
                $pembelianBarang->where(function($query) use($request) {
                    $query->whereBetween("pembelian_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $pembelianBarang->where('pembelian_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }
    
            $pembelianBarang = $pembelianBarang->get();

            return Excel::download(new LaporanPembelianExport($pembelianBarang),  'list-laporan-pembelian-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
