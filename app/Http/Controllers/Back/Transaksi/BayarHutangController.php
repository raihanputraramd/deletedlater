<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\BayarHutangExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Hutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class BayarHutangController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Hutang')) {
            return view('back.transaksi.bayar-hutang.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        return view('back.transaksi.bayar-hutang.create');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Hutang')) {
            $hutang = Hutang::findOrFail($id);

            return view('back.transaksi.bayar-hutang.edit', compact('hutang'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request,$id)
    {
        if (HelpersUser::checkPermission('Edit Hutang')) {
            DB::beginTransaction();
            try {
                $hutang                 = Hutang::findOrFail($id);
                $hutang->tanggal_lunas  = $request->tanggal_lunas;
                $hutang->jatuh_tempo    = $request->jatuh_tempo;
                $hutang->status_lunas   = $request->status_lunas;
                $hutang->nominal        = $request->nominal;
                $hutang->save();

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
        if (HelpersUser::checkPermission('Edit Hutang')) {
            $columns = array(
                0 => 'pembelian.no_faktur',
                1 => 'supplier.nama',
                2 => 'hutang.status_lunas',
                3 => 'hutang.nominal',
                4 => 'hutang.tanggal_lunas',
                5 => 'hutang.jatuh_tempo',
            );

            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $rows = Hutang::select(
                'hutang.id',
                'hutang.status_lunas',
                'hutang.nominal',
                'hutang.tanggal_lunas',
                'hutang.jatuh_tempo',
                'pembelian.no_faktur',
                'supplier.nama as supplier',
            )->leftJoin('pembelian', 'pembelian.id', '=', 'hutang.pembelian_id')
            ->leftJoin('supplier', 'supplier.id', '=', 'hutang.supplier_id');

            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereBetween("hutang.jatuh_tempo", [$request->startDate, $request->endDate]);
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
                $nestedData['supplier']         = $item->supplier;
                $nestedData['status_lunas']     = $item->status_lunas;
                $nestedData['nominal']          = number_format($item->nominal,0,',','.');
                $nestedData['tanggal_lunas']    = Carbon::parse($item->tanggal_lunas)->format('d/m/Y');
                $nestedData['jatuh_tempo']      = Carbon::parse($item->jatuh_tempo)->format('d/m/Y');
                $nestedData['item']             = $this->getItems($item->hutangBarang);
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.transaksi.bayar-hutang.edit', $item->id).'" class="btn btn-outline-warning btn-page" target="_blank" data-title="Edit Hutang">
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
        if (HelpersUser::checkPermission('Edit Hutang')) {
            $filter = $request->tanggal;

            $total  = Hutang::when($filter, function ($q, $filter) use ($request) {
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
        if (HelpersUser::checkPermission('Edit Hutang')) {
            $hutang = Hutang::select(
                'hutang.id',
                'hutang.status_lunas',
                'hutang.nominal',
                'hutang.tanggal_lunas',
                'hutang.jatuh_tempo',
                'pembelian.no_faktur',
                'supplier.nama as supplier',
            )->leftJoin('pembelian', 'pembelian.id', '=', 'hutang.pembelian_id')
            ->leftJoin('supplier', 'supplier.id', '=', 'hutang.supplier_id');

            if(!empty($request->startDate)) {
                $hutang->where(function($query) use($request) {
                    $query->whereBetween("hutang.jatuh_tempo", [$request->startDate, $request->endDate]);
                });
            }

            $hutang = $hutang->get();

            $pdf = PDF::loadview('back.transaksi.bayar-hutang.pdf', compact('hutang'))->setPaper('a4', 'portrait');

            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    private function getItems($hutangBarang)
    {
        $output = '<ul>';
        foreach ($hutangBarang as $item) {
            $output .= '
                <li>'. $item->barang != null ? $item->barang->nama : '' .'</li>
            ';
        }

        $output .= '</ul>';
        return $output;
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Hutang')) {
            $hutang = Hutang::select(
                'hutang.id',
                'hutang.status_lunas',
                'hutang.nominal',
                'hutang.tanggal_lunas',
                'hutang.jatuh_tempo',
                'pembelian.no_faktur',
                'supplier.nama as supplier',
            )->leftJoin('pembelian', 'pembelian.id', '=', 'hutang.pembelian_id')
            ->leftJoin('supplier', 'supplier.id', '=', 'hutang.supplier_id');

            if(!empty($request->startDate)) {
                $hutang->where(function($query) use($request) {
                    $query->whereBetween("hutang.jatuh_tempo", [$request->startDate, $request->endDate]);
                });
            }

            $hutang = $hutang->get();

            return Excel::download(new BayarHutangExport($hutang),  'list-pembayaran-hutang-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

}
