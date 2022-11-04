<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\PenukaranPointExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;
use App\Models\Transaksi\PenukaranPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PenukaranPointController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Penukaran Point')) {
            return view('back.transaksi.penukaran-point.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Penukaran Point')) {
            return view('back.transaksi.penukaran-point.create');
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Penukaran Point')) {
            DB::beginTransaction();
            try {
                $penukaranPoint                  = new PenukaranPoint();
                $penukaranPoint->pelanggan_id    = $request->pelanggan;
                $penukaranPoint->point           = $request->point;
                $penukaranPoint->keterangan      = $request->keterangan;
                $penukaranPoint->user_id         = auth()->user()->id;
                $penukaranPoint->save();

                $pelanggan = Pelanggan::findOrFail($request->pelanggan);
                $pelanggan->point = $pelanggan->point - $request->point;
                $pelanggan->save();

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
        if (HelpersUser::checkPermission('Edit Penukaran Point')) {
            $penukaranPoint = PenukaranPoint::findOrFail($id);

            return view('back.transaksi.penukaran-point.edit', compact('penukaranPoint'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Penukaran Point')) {
            DB::beginTransaction();
            try {
                $penukaranPoint                  = PenukaranPoint::findOrFail($id);
                $penukaranPoint->keterangan      = $request->keterangan;

                if ($penukaranPoint->pelanggan_id != $request->pelanggan) {
                    $pelangganLama = Pelanggan::findOrFail($penukaranPoint->pelanggan_id);
                    $pelangganLama->point = $pelangganLama->point + $penukaranPoint->point;
                    $pelangganLama->save();

                    $pelangganBaru = Pelanggan::findOrFail($request->pelanggan);
                    $pelangganBaru->point = $pelangganBaru->point - $request->point;
                    $pelangganBaru->save();
                } else {
                    $pelangganLama = Pelanggan::findOrFail($penukaranPoint->pelanggan_id);
                    $pelangganLama->point = $pelangganLama->point + $penukaranPoint->point - $request->point;
                    $pelangganLama->save();
                }

                $penukaranPoint->pelanggan_id    = $request->pelanggan;
                $penukaranPoint->point           = $request->point;
                $penukaranPoint->save();

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
        if (HelpersUser::checkPermission('Edit Penukaran Point')) {
            DB::beginTransaction();
            try {
                $penukaranPoint = PenukaranPoint::findOrFail($id);
                $pelangganLama = Pelanggan::findOrFail($penukaranPoint->pelanggan_id);
                $pelangganLama->point = $pelangganLama->point + $penukaranPoint->point;
                $pelangganLama->save();
                $penukaranPoint->delete();

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
        if (HelpersUser::checkPermission('Edit Penukaran Point')) {
            $columns = array(
                0 => 'penukaran_point.id',
                1 => 'pelanggan.nama',
                2 => 'penukaran_point.point',
                3 => 'penukaran_point.keterangan',
                4 => 'penukaran_point.created_at',
                5 => 'users.nama',
            );

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');

            $rows = PenukaranPoint::select(
                'penukaran_point.id',
                'penukaran_point.point',
                'penukaran_point.keterangan',
                'penukaran_point.created_at',
                'users.nama as user',
                'pelanggan.nama as pelanggan',
            )->leftJoin('pelanggan', 'pelanggan.id', '=', 'penukaran_point.pelanggan_id')
            ->leftJoin('users', 'users.id', '=', 'penukaran_point.user_id');

            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('pelanggan.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('users.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('penukaran_point.keterangan', 'like', '%'.$input_search.'%');
                });
            }

            $totalData = $rows->count();
            $rows = $rows->offset($start)->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']         = $no;
                $nestedData['pelanggan']  = $item->pelanggan;
                $nestedData['point']      = $item->point;
                $nestedData['keterangan'] = $item->keterangan;
                $nestedData['tanggal']    = Carbon::parse($item->created_at)->isoformat('D MMMM Y');
                $nestedData['user']       = $item->user;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.transaksi.penukaran-point.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit PenukaranPoint"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.transaksi.penukaran-point.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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

    public function pdf(Request $request)
    {
        $penukaranPoint = PenukaranPoint::select(
            'penukaran_point.id',
            'penukaran_point.point',
            'penukaran_point.keterangan',
            'penukaran_point.created_at',
            'users.nama as user',
            'pelanggan.nama as pelanggan',
        )->leftJoin('pelanggan', 'pelanggan.id', '=', 'penukaran_point.pelanggan_id')
        ->leftJoin('users', 'users.id', '=', 'penukaran_point.user_id')->get();

        $pdf = PDF::loadview('back.transaksi.penukaran-point.pdf', compact('penukaranPoint'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Penukaran Point')) {
            $penukaranPoint = PenukaranPoint::select(
                'penukaran_point.id',
                'penukaran_point.point',
                'penukaran_point.keterangan',
                'penukaran_point.created_at',
                'users.nama as user',
                'pelanggan.nama as pelanggan',
            )->leftJoin('pelanggan', 'pelanggan.id', '=', 'penukaran_point.pelanggan_id')
            ->leftJoin('users', 'users.id', '=', 'penukaran_point.user_id')->get();

            return Excel::download(new PenukaranPointExport($penukaranPoint),  'data-penukaran-point-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
