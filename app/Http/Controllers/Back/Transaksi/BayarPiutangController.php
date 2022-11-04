<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\BayarPiutangExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BayarPiutangController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Piutang')) {
            return view('back.transaksi.bayar-piutang.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        return view('back.transaksi.bayar-piutang.create');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Piutang')) {
            $piutang = Piutang::findOrFail($id);

            return view('back.transaksi.bayar-piutang.edit', compact('piutang'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request,$id)
    {
        if (HelpersUser::checkPermission('Edit Piutang')) {
            DB::beginTransaction();
            try {
                $piutang                 = Piutang::findOrFail($id);
                $piutang->tanggal_lunas  = $request->tanggal_lunas;
                $piutang->jatuh_tempo    = $request->jatuh_tempo;
                $piutang->status_lunas   = $request->status_lunas;
                $piutang->nominal        = $request->nominal;
                $piutang->save();

                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil diedit');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Piutang')) {
            $columns = array(
                0 => 'penjualan.no_faktur',
                1 => 'pelanggan.nama',
                2 => 'piutang.status_lunas',
                3 => 'piutang.nominal',
                4 => 'piutang.tanggal_lunas',
                5 => 'piutang.jatuh_tempo',
            );

            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $rows = Piutang::select(
                'piutang.id',
                'piutang.status_lunas',
                'piutang.nominal',
                'piutang.tanggal_lunas',
                'piutang.jatuh_tempo',
                'penjualan.no_faktur',
                'pelanggan.nama as pelanggan',
            )->leftJoin('penjualan', 'penjualan.id', '=', 'piutang.penjualan_id')
            ->leftJoin('pelanggan', 'pelanggan.id', '=', 'piutang.pelanggan_id');

            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereBetween("piutang.jatuh_tempo", [$request->startDate, $request->endDate]);
                });
            }


            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no_faktur']        = $item->no_faktur;
                $nestedData['pelanggan']        = $item->pelanggan;
                $nestedData['status_lunas']     = $item->statusLunasCondition();
                $nestedData['nominal']          = number_format($item->nominal,0,',','.');
                $nestedData['tanggal_lunas']    = Carbon::parse($item->tanggal_lunas)->format('d/m/Y');
                $nestedData['jatuh_tempo']      = Carbon::parse($item->jatuh_tempo)->format('d/m/Y');
                $nestedData['item']             = $this->getItems($item->piutangBarang);
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.transaksi.bayar-piutang.edit', $item->id).'" class="btn btn-outline-warning btn-page" target="_blank" data-title="Edit Piutang">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>';

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
        if (HelpersUser::checkPermission('Edit Piutang')) {
            $filter = $request->tanggal;

            $total  = Piutang::when($filter, function ($q, $filter) use ($request) {
                if($filter == "tanggal") {
                    return $q->whereBetween("jatuh_tempo", [$request->startDate, $request->endDate]);
                }
            })->sum('nominal');

            return response()->json([
                // 'diskonItem' => number_format($diskonItem,0,',','.'),
                // 'subTotal' => number_format($subTotal,0,',','.'),
                // 'potongan' => number_format($potongan,0,',','.'),
                // 'ppn' => number_format($ppn,0,',','.'),
                'total' => number_format($total,0,',','.'),
            ]);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function pdf(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Piutang')) {
            $piutang = Piutang::select(
                'piutang.id',
                'piutang.status_lunas',
                'piutang.nominal',
                'piutang.tanggal_lunas',
                'piutang.jatuh_tempo',
                'penjualan.no_faktur',
                'pelanggan.nama as pelanggan',
            )->leftJoin('penjualan', 'penjualan.id', '=', 'piutang.penjualan_id')
            ->leftJoin('pelanggan', 'pelanggan.id', '=', 'piutang.pelanggan_id');

            if(!empty($request->startDate)) {
                $piutang->where(function($query) use($request) {
                    $query->whereBetween("piutang.jatuh_tempo", [$request->startDate, $request->endDate]);
                });
            }

            $piutang = $piutang->get();

            $pdf = PDF::loadview('back.transaksi.bayar-piutang.pdf', compact('piutang'))->setPaper('a4', 'portrait');

            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    private function getItems($piutangBarang)
    {
        $output = '<ul>';
        foreach ($piutangBarang as $item) {
            $output .= '
                <li>'. $item->barang != null ? $item->barang->nama : '' .'</li>
            ';
        }

        $output .= '</ul>';
        return $output;
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Piutang')) {
            $piutang = Piutang::select(
                'piutang.id',
                'piutang.status_lunas',
                'piutang.nominal',
                'piutang.tanggal_lunas',
                'piutang.jatuh_tempo',
                'penjualan.no_faktur',
                'pelanggan.nama as pelanggan',
            )->leftJoin('penjualan', 'penjualan.id', '=', 'piutang.penjualan_id')
            ->leftJoin('pelanggan', 'pelanggan.id', '=', 'piutang.pelanggan_id');

            if(!empty($request->startDate)) {
                $piutang->where(function($query) use($request) {
                    $query->whereBetween("piutang.jatuh_tempo", [$request->startDate, $request->endDate]);
                });
            }

            $piutang = $piutang->get();

            return Excel::download(new BayarPiutangExport($piutang),  'data-piutang-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
