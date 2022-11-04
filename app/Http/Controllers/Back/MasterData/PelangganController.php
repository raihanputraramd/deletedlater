<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Exports\MasterData\PelangganExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PelangganController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            return view('back.master-data.pelanggan.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Pelanggan')) {
            return view('back.master-data.pelanggan.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Pelanggan')) {
            DB::beginTransaction();
            try {
                $pelanggan                  = new Pelanggan();
                $pelanggan->nama            = $request->nama;
                $pelanggan->kode            = $request->kode;
                $pelanggan->email           = $request->email;
                $pelanggan->no_hp           = $request->no_hp;
                $pelanggan->no_telepon      = $request->no_telepon;
                $pelanggan->kota            = $request->kota;
                $pelanggan->alamat          = $request->alamat;
                $pelanggan->diskon          = $request->diskon;
                $pelanggan->level_harga     = $request->level_harga;
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
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            $pelanggan = Pelanggan::findOrFail($id);

            return view('back.master-data.pelanggan.edit', compact('pelanggan'));
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            DB::beginTransaction();
            try {
                $pelanggan                  = Pelanggan::findOrFail($id);
                $pelanggan->nama            = $request->nama;
                $pelanggan->kode            = $request->kode;
                $pelanggan->email           = $request->email;
                $pelanggan->no_hp           = $request->no_hp;
                $pelanggan->no_telepon      = $request->no_telepon;
                $pelanggan->kota            = $request->kota;
                $pelanggan->alamat          = $request->alamat;
                $pelanggan->diskon          = $request->diskon;
                $pelanggan->level_harga     = $request->level_harga;
                $pelanggan->save();

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
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            DB::beginTransaction();
            try {
                $pelanggan = Pelanggan::findOrFail($id);
                $pelanggan->delete();

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
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            $columns = array(
                0 => 'id',
                1 => 'kode',
                2 => 'nama',
                3 => 'diskon',
                4 => 'level_harga',
                5 => 'point',
                6 => 'email',
                7 => 'no_hp',
                8 => 'no_telepon',
                9 => 'kota',
                10 => 'alamat',
            );

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');

            $rows = Pelanggan::select('*');

            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('nama', 'like', '%'.$input_search.'%')
                        ->orWhere('kode', 'like', '%'.$input_search.'%')
                        ->orWhere('email', 'like', '%'.$input_search.'%')
                        ->orWhere('no_hp', 'like', '%'.$input_search.'%')
                        ->orWhere('no_telepon', 'like', '%'.$input_search.'%')
                        ->orWhere('kota', 'like', '%'.$input_search.'%')
                        ->orWhere('alamat', 'like', '%'.$input_search.'%');
                });
            }

            $totalData = $rows->count();
            $rows = $rows->offset($start)->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']               = $no;
                $nestedData['kode']             = $item->kode;
                $nestedData['nama']             = $item->nama;
                $nestedData['diskon']           = $item->diskon;
                $nestedData['level_harga']      = $item->level_harga;
                $nestedData['point']            = $item->point;
                $nestedData['email']            = $item->email;
                $nestedData['no_hp']            = $item->no_hp;
                $nestedData['no_telepon']       = $item->no_telepon;
                $nestedData['kota']             = $item->kota;
                $nestedData['alamat']           = $item->alamat;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.master-data.pelanggan.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Pelanggan"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.master-data.pelanggan.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            $pelanggan = Pelanggan::select('*')->get();

            $pdf = PDF::loadview('back.master-data.pelanggan.pdf', compact('pelanggan'))->setPaper('a4', 'portrait');
    
            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
    
    public function exportExcel()
    {
        if (HelpersUser::checkPermission('Edit Pelanggan')) {
            $pelanggan = Pelanggan::all();

            return Excel::download(new PelangganExport($pelanggan),  'list-data-pelanggan-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
