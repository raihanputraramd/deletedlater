<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Modul')) {
            return view('back.system.modul.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Modul')) {
            return view('back.system.modul.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Modul')) {
            DB::beginTransaction();
            try {
                $modul              = new Modul();
                $modul->nama        = $request->nama;
                $modul->keterangan  = $request->keterangan;
                $modul->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Modul Berhasil Ditambahkan');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Modul')) {
            $modul = Modul::findOrFail($id);
    
            return view('back.system.modul.edit', compact('modul'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Modul')) {
            DB::beginTransaction();
            try {
                $modul              = Modul::findOrFail($id);
                $modul->nama        = $request->nama;
                $modul->keterangan  = $request->keterangan;
                $modul->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Modul Berhasil Di Edit');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function destroy($id)
    {
        if (HelpersUser::checkPermission('Edit Modul')) {
            DB::beginTransaction();
            try {
                $modul = Modul::findOrFail($id);
                $modul->delete();
    
                DB::commit();
                return response()->json([
                    'message' => 'Data berhasil dihapus'
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
        if (HelpersUser::checkPermission('Edit Modul')) {
            $columns = array(
                0 => 'id',
                1 => 'nama',
                2 => 'keterangan'
            );
    
            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');
    
            $rows = Modul::select('*');
    
            // Search section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('nama', 'like', '%'.$input_search.'%')
                        ->orWhere('keterangan', 'like', '%'.$input_search.'%');
                });
            }
    
            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();
    
            $data = array();
            $no = 0;
    
            foreach ($rows as $item) {
                $no++;
                $nestedData['id']           = $item->id;
                $nestedData['nama']         = $item->nama;
                $nestedData['keterangan']   = $item->keterangan;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.system.modul.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Modul"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.system.modul.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>';
    
                $data[] = $nestedData;
            }
    
            $json_data = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalData),
                "data" => $data
            );
    
            return response()->json($json_data);
        }
        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }
}
