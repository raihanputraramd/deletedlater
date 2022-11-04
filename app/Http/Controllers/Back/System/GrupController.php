<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\Grup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Grup')) {
            return view('back.system.grup.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Grup')) {
            return view('back.system.grup.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Grup')) {
            DB::beginTransaction();
            try {
                $grup                  = new Grup();
                $grup->nama            = $request->nama;
                $grup->keterangan      = $request->keterangan;
                $grup->save();
    
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
        if (HelpersUser::checkPermission('Edit Grup')) {
            $grup = Grup::findOrFail($id);
    
            return view('back.system.grup.edit', compact('grup'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Grup')) {
            DB::beginTransaction();
            try {
                $grup                 = Grup::findOrFail($id);
                $grup->nama            = $request->nama;
                $grup->keterangan      = $request->keterangan;
                $grup->save();
    
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
        if (HelpersUser::checkPermission('Edit Grup')) {
            DB::beginTransaction();
            try {
                $grup = Grup::findOrFail($id);
                $grup->delete();
    
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
        if (HelpersUser::checkPermission('Edit Grup')) {
            $columns = array(
                0 => 'id',
                1 => 'nama',
                2 => 'keterangan',
            );
    
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');
    
            $rows = Grup::select('*');
    
            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('nama', 'like', '%'.$input_search.'%')
                        ->orWhere('keterangan', 'like', '%'.$input_search.'%');
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
                $nestedData['nama']             = $item->nama;
                $nestedData['keterangan']       = $item->keterangan;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.system.grup.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Grup"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.system.grup.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
}
