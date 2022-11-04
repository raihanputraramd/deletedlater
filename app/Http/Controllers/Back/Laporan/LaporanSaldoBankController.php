<?php

namespace App\Http\Controllers\Back\Laporan;

use App\Exports\Laporan\SaldoBankExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\BankTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class LaporanSaldoBankController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Laporan Saldo Bank')) {
            return view('back.laporan.laporan-saldo-bank.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Saldo Bank')) {
            $columns = array(
                0 => 'created_at',
                1 => 'keterangan',
                2 => 'jumlah_masuk',
                3 => 'jumlah_keluar',
            );

            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $rows = BankTransfer::select('*');

            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereDate('created_at', '>=', $request->startDate)
                        ->whereDate('created_at', '<=', $request->endDate);
                });
            } else {
                $rows->whereDate('created_at', Carbon::now()->format('Y-m-d'));
            }

            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no_faktur']    = $item->no_faktur;
                $nestedData['tanggal']      = Carbon::parse($item->created_at)->format('d-m-Y');
                $nestedData['keterangan']   = $item->keterangan;
                $nestedData['masuk']        = $item->masuk();
                $nestedData['keluar']       = $item->keluar();

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
        if (HelpersUser::checkPermission('Laporan Saldo Bank')) {
            $filter = $request->tanggal;

            $saldoAwal = BankTransfer::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereDate('created_at', '>=', $request->startDate)
                        ->whereDate('created_at', '<=', $request->endDate);
                } else {
                    return $q->whereDate('created_at', Carbon::now()->format('Y-m-d'));
                }
            })->sum('jumlah_masuk');

            $masuk = BankTransfer::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereDate('created_at', '>=', $request->startDate)
                        ->whereDate('created_at', '<=', $request->endDate);
                } else {
                    return $q->whereDate('created_at', Carbon::now()->format('Y-m-d'));
                }
            })->sum('jumlah_masuk');

            $keluar = BankTransfer::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereDate('created_at', '>=', $request->startDate)
                        ->whereDate('created_at', '<=', $request->endDate);
                } else {
                    return $q->whereDate('created_at', Carbon::now()->format('Y-m-d'));
                }
            })->sum('jumlah_keluar');

            $saldoAkhir = $saldoAwal - $keluar;

            return response()->json([
                'saldoAwal' => number_format($saldoAwal,0,',','.'),
                'masuk' => number_format($masuk,0,',','.'),
                'keluar' => number_format($keluar,0,',','.'),
                'saldoAkhir' => number_format($saldoAkhir,0,',','.')
            ]);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function pdf(Request $request)
    {
        $bankTransfer = BankTransfer::select('*');

        if(!empty($request->startDate)) {
            $bankTransfer->where(function($query) use($request) {
                $query->whereDate('created_at', '>=', $request->startDate)
                    ->whereDate('created_at', '<=', $request->endDate);
            });
        } else {
            $bankTransfer->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }

        $bankTransfer = $bankTransfer->get();

        $pdf = PDF::loadview('back.laporan.laporan-saldo-bank.pdf', compact('bankTransfer'))->setPaper('a4', 'portrait');

        return $pdf->stream();


        // return view('back.laporan.laporan-saldo-tunai.pdf', compact('bankTransfer'));
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Saldo Bank')) {
            $bankTransfer = BankTransfer::select('*');

            if(!empty($request->startDate)) {
                $bankTransfer->where(function($query) use($request) {
                    $query->whereDate('created_at', '>=', $request->startDate)
                        ->whereDate('created_at', '<=', $request->endDate);
                });
            } else {
                $bankTransfer->whereDate('created_at', Carbon::now()->format('Y-m-d'));
            }

            $bankTransfer = $bankTransfer->get();

            return Excel::download(new SaldoBankExport($bankTransfer),  'laporan-saldo-bank-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
