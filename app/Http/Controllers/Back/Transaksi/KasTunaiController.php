<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\KasTunaiExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\KasTunai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class KasTunaiController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Kas Tunai')) {
            return view('back.transaksi.kas-tunai.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Kas Tunai')) {
            return view('back.transaksi.kas-tunai.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Kas Tunai')) {
            DB::beginTransaction();
            try {
                $kasTunai                  = new KasTunai();
                $kasTunai->transaksi       = $request->transaksi;
                if($request->transaksi == "Kas Masuk") {
                    $kasTunai->jumlah_masuk = $request->jumlah;
                }
                if($request->transaksi == "Kas Keluar") {
                    $kasTunai->jumlah_keluar = $request->jumlah;
                }
                $kasTunai->keterangan      = $request->keterangan;
                $kasTunai->user_id         = auth()->user()->id;
                $kasTunai->save();

                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil ditambah');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Kas Tunai')) {
            $kasTunai = KasTunai::findOrFail($id);

            return view('back.transaksi.kas-tunai.edit', compact('kasTunai'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Kas Tunai')) {
            DB::beginTransaction();
            try {
                $kasTunai                  = KasTunai::findOrFail($id);
                $kasTunai->transaksi       = $request->transaksi;
                if($request->transaksi == "Kas Masuk") {
                    $kasTunai->jumlah_masuk  = $request->jumlah;
                    $kasTunai->jumlah_keluar = null;
                }
                if($request->transaksi == "Kas Keluar") {
                    $kasTunai->jumlah_keluar = $request->jumlah;
                    $kasTunai->jumlah_masuk  = null;
                }
                $kasTunai->keterangan      = $request->keterangan;
                $kasTunai->save();

                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil diedit');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function destroy($id)
    {
        if (HelpersUser::checkPermission('Edit Kas Tunai')) {
            DB::beginTransaction();
            try {
                $kasTunai = KasTunai::findOrFail($id);
                $kasTunai->delete();

                DB::commit();
                return response()->json([
                    'message' => 'Data berhasil dihapus'
                ], $id != null ? 200 : 201);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Kas Tunai')) {
            $columns = array(
                0 => 'kas_tunai.id',
                1 => 'kas_tunai.transaksi',
                2 => 'kas_tunai.jumlah_masuk',
                3 => 'kas_tunai.jumlah_keluar',
                4 => 'kas_tunai.keterangan',
                5 => 'kas_tunai.created_at',
                6 => 'users.nama',
            );

            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');

            $rows = KasTunai::select(
                'kas_tunai.id',
                'kas_tunai.transaksi',
                'kas_tunai.jumlah_masuk',
                'kas_tunai.jumlah_keluar',
                'kas_tunai.keterangan',
                'kas_tunai.created_at',
                'users.nama as user',
            )->leftJoin('users', 'users.id', '=', 'kas_tunai.user_id');

            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('kas_tunai.transaksi', 'like', '%'.$input_search.'%')
                        ->orWhere('users.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('kas_tunai.keterangan', 'like', '%'.$input_search.'%');
                });
            }

            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']         = $no;
                $nestedData['transaksi']  = $item->transaksi;
                $nestedData['tanggal']    = Carbon::parse($item->created_at)->isoformat('D MMMM Y');
                $nestedData['amount']     = $item->amount();
                $nestedData['keterangan'] = $item->keterangan;
                $nestedData['user']       = $item->user;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.transaksi.kas-tunai.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit KasTunai"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.transaksi.kas-tunai.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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

    public function pdf(Request $request) {
        $kasTunai = KasTunai::select(
            'kas_tunai.id',
            'kas_tunai.transaksi',
            'kas_tunai.jumlah_masuk',
            'kas_tunai.jumlah_keluar',
            'kas_tunai.keterangan',
            'kas_tunai.created_at',
            'users.nama as user',
        )->leftJoin('users', 'users.id', '=', 'kas_tunai.user_id')->get();


        $pdf = PDF::loadview('back.transaksi.kas-tunai.pdf', compact('kasTunai'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Kas Tunai')) {
            $kasTunai = KasTunai::select(
                'kas_tunai.id',
                'kas_tunai.transaksi',
                'kas_tunai.jumlah_masuk',
                'kas_tunai.jumlah_keluar',
                'kas_tunai.keterangan',
                'kas_tunai.created_at',
                'users.nama as user',
            )->leftJoin('users', 'users.id', '=', 'kas_tunai.user_id')->get();

            return Excel::download(new KasTunaiExport($kasTunai),  'data-kas-tunai-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

}
