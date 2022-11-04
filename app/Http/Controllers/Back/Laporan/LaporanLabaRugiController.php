<?php

namespace App\Http\Controllers\Back\Laporan;

use App\Exports\Laporan\LabaRugiExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Penjualan;
use App\Models\Transaksi\PenjualanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class LaporanLabaRugiController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Laporan Laba Rugi')) {
            return view('back.laporan.laporan-laba-rugi.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Laba Rugi')) {
            $columns = array(
                0 => 'barang.kode',
                1 => 'barang.nama',
                2 => 'barang.harga_beli',
                3 => 'barang_harga.harga_jual',
                4 => 'total',
                5 => 'totalDiskon',
                6 => 'labaRugi',
            );

            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $rows = PenjualanBarang::select(
                'barang.id',
                'barang.kode',
                'barang.nama',
                'barang.harga_beli',
                'barang_harga.harga_jual',
                DB::raw('sum(penjualan_barang.banyak) AS total'),
                DB::raw('sum(penjualan_barang.diskon) AS totalDiskon'),
                DB::raw('barang_harga.harga_jual * sum(penjualan_barang.banyak) - barang.harga_beli * sum(penjualan_barang.banyak) - sum(penjualan_barang.diskon) AS labaRugi'),
            )->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id')
            ->leftJoin('barang_harga', 'barang_harga.barang_id', '=', 'barang.id')
            ->groupBy('barang.nama');

            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $rows->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }

            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();

            $data = array();
            $i = 1;
            foreach ($rows as $item) {
                $nestedData['kode'] = $item->kode;
                $nestedData['nama'] = $item->nama;
                $nestedData['harga_beli'] = $item->harga_beli;
                $nestedData['harga_jual'] = $item->harga_jual;
                $nestedData['total'] = $item->total;
                $nestedData['totalDiskon'] = $item->totalDiskon;
                $nestedData['labaRugi'] = $item->labaRugi;

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
        if (HelpersUser::checkPermission('Laporan Laba Rugi')) {
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

            $labaRugi  = PenjualanBarang::select(
                DB::raw('barang_harga.harga_jual * sum(penjualan_barang.banyak) - barang.harga_beli * sum(penjualan_barang.banyak) - sum(penjualan_barang.diskon) AS labaRugi'),
            )->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id')
            ->leftJoin('barang_harga', 'barang_harga.barang_id', '=', 'barang.id')
            ->when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
                } else {
                    return $q->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
                }
            })
            ->groupBy('barang.nama')->get()->sum('labaRugi');

            $totalLabaRugi = $total - $labaRugi;

            return response()->json([
                'diskonItem' => number_format($diskonItem,0,',','.'),
                'subTotal' => number_format($subTotal,0,',','.'),
                'potongan' => number_format($potongan,0,',','.'),
                'ppn' => number_format($ppn,0,',','.'),
                'totalLabaRugi' => number_format($totalLabaRugi,0,',','.'),
            ]);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function pdf(Request $request) {
        $labaRugi = PenjualanBarang::select(
            'barang.id',
            'barang.kode',
            'barang.nama',
            'barang.harga_beli',
            'barang_harga.harga_jual',
            DB::raw('sum(penjualan_barang.banyak) AS total'),
            DB::raw('sum(penjualan_barang.diskon) AS totalDiskon'),
            DB::raw('barang_harga.harga_jual * sum(penjualan_barang.banyak) - barang.harga_beli * sum(penjualan_barang.banyak) - sum(penjualan_barang.diskon) AS labaRugi'),
        )->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id')
        ->leftJoin('barang_harga', 'barang_harga.barang_id', '=', 'barang.id')
        ->groupBy('barang.nama');

        if(!empty($request->startDate)) {
            $labaRugi->where(function($query) use($request) {
                $query->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
            });
        } else {
            $labaRugi->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
        }

        $labaRugi = $labaRugi->get();

        $pdf = PDF::loadview('back.laporan.laporan-laba-rugi.pdf', compact('labaRugi'))->setPaper('a4', 'portrait');

        return $pdf->stream();

    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Laba Rugi')) {
            $labaRugi = PenjualanBarang::select(
                'barang.id',
                'barang.kode',
                'barang.nama',
                'barang.harga_beli',
                'barang_harga.harga_jual',
                DB::raw('sum(penjualan_barang.banyak) AS total'),
                DB::raw('sum(penjualan_barang.diskon) AS totalDiskon'),
                DB::raw('barang_harga.harga_jual * sum(penjualan_barang.banyak) - barang.harga_beli * sum(penjualan_barang.banyak) - sum(penjualan_barang.diskon) AS labaRugi'),
            )->leftJoin('barang', 'barang.id', '=', 'penjualan_barang.barang_id')
            ->leftJoin('barang_harga', 'barang_harga.barang_id', '=', 'barang.id')
            ->groupBy('barang.nama');

            if(!empty($request->startDate)) {
                $labaRugi->where(function($query) use($request) {
                    $query->whereBetween("penjualan_barang.tanggal", [$request->startDate, $request->endDate]);
                });
            } else {
                $labaRugi->where('penjualan_barang.tanggal', Carbon::now()->format('Y-m-d'));
            }

            $labaRugi = $labaRugi->get();

            return Excel::download(new LabaRugiExport($labaRugi),  'laporan-laba-rugi-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
