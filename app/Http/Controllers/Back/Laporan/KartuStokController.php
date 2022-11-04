<?php

namespace App\Http\Controllers\Back\Laporan;

use App\Exports\Laporan\KartuStokExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Laporan\KartuStok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class KartuStokController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            return view('back.laporan.kartu-stok.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            return view('back.laporan.kartu-stok.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            DB::beginTransaction();
            try{
                $kartuStok              = new KartuStok();
                $kartuStok->tanggal     = $request->tanggal;
                $kartuStok->keterangan  = $request->keterangan;
                $kartuStok->masuk       = $request->masuk;
                $kartuStok->keluar      = $request->keluar;
                $kartuStok->sisa        = $request->sisa;
                $kartuStok->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Kartu Stok Berhasil Ditambahkan');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            $kartuStok = KartuStok::findOrFail($id);
    
            return view('back.laporan.kartu-stok.edit', compact('kartuStok'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            DB::beginTransaction();
    
            try {
                $kartuStok              = KartuStok::findOrFail($id);
                $kartuStok->tanggal     = $request->tanggal;
                $kartuStok->keterangan  = $request->keterangan;
                $kartuStok->masuk       = $request->masuk;
                $kartuStok->keluar      = $request->keluar;
                $kartuStok->sisa        = $request->sisa;
                $kartuStok->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Kartu Stok Berhasil Di Edit');
            }catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function destroy($id)
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            DB::beginTransaction();
            try {
                $kartuStok = KartuStok::findOrFail($id);
                $kartuStok->delete();
    
                DB::commit();
                return response()->json([
                    'message' => 'Data Berhasil Dihapus'
                ], $id != null ? 200 : 201);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            $columns = array(
                0 => 'id',
                1 => 'tanggal',
                2 => 'keterangan',
                3 => 'masuk',
                4 => 'keluar',
                5 => 'sisa'
            );
    
            $limit = $request->input('lenght');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');
    
            $rows = KartuStok::select('*');
    
            if(!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('keterangan', 'like', '%'.$input_search.'%');
                });
            }

            if(!empty($request->startDate)) {
                $rows->where(function($query) use($request) {
                    $query->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                });
            }
    
            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();
    
            $data = array();
            $no = 0;
    
            foreach ($rows as $item) {
                $no++;
                $nestedData['id']           = $item->id;
                $nestedData['tanggal']      = Carbon::parse($item->tanggal)->isoFormat('D MMMM Y');
                $nestedData['keterangan']   = $item->keterangan;
                $nestedData['masuk']        = number_format($item->masuk,0,',','.');
                $nestedData['keluar']       = number_format($item->keluar,0,',','.');
                $nestedData['sisa']         = number_format($item->sisa,0,',','.');
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.laporan.kartu-stok.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Kartu Stok"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.laporan.kartu-stok.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>';
    
                $data[] = $nestedData;
            }
    
            $json_data = array(
                "draw"              => intval($request->input('draw')),
                "recordsTotal"      => intval($totalData),
                "recordsFiltered"   => intval($totalData),
                "data"              => $data,
            );
    
            return response()->json($json_data);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function pdf(Request $request)
    {
        if (HelpersUser::checkPermission('Laporan Kartu Stok')) {
            $kartuStok = KartuStok::select('*');

            if (!empty($request->startDate)) {
                $kartuStok->where(function($query) use($request) {
                    $query->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                });
            }

            $kartuStok = $kartuStok->get();

            $pdf = PDF::loadview('back.laporan.kartu-stok.pdf', compact('kartuStok'))->setPaper('a4', 'portrait');

            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Hutang')) {
            $kartuStok = KartuStok::select('*');

            if(!empty($request->startDate)) {
                $kartuStok->where(function($query) use($request) {
                    $query->whereBetween("tanggal", [$request->startDate, $request->endDate]);
                });
            }

            $kartuStok = $kartuStok->get();

            return Excel::download(new KartuStokExport($kartuStok),  'list-kartu-stok-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
