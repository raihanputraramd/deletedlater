<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\Grup;
use App\Models\System\HakAksesModul;
use App\Models\System\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HakAksesModulController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Hak Akses Modul')) {
            return view('back.system.hak-akses-modul.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Hak Akses Modul')) {
            $grup = Grup::doesntHave('modul')->get();
            $modul = Modul::all();
    
            return view('back.system.hak-akses-modul.create', compact('grup', 'modul'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Hak Akses Modul')) {
            DB::beginTransaction();
            try {
                $grup = Grup::findOrFail($request->grup);
                $grup->modul()->sync($request->modul);
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Hak Akses Modul')) {
            $grup = Grup::findOrFail($id);
            $modul = Modul::all();
    
            return view('back.system.hak-akses-modul.edit', compact('grup', 'modul'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Hak Akses Modul')) {
            DB::beginTransaction();
            try{
                $grup = Grup::findOrFail($id);
                $grup->modul()->sync($request->modul);
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request) {
        if (HelpersUser::checkPermission('Edit Hak Akses Modul')) {
            $columns = array(
                0 => 'id',
                1 => 'nama',
            );
    
            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');
    
            $rows = Grup::select('id', 'nama as grup');
    
            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('nama', 'like', '%'.$input_search.'%');
                });
            }
    
            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();
    
            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']       = $no;
                $nestedData['grup']     = $item->grup;
                $nestedData['modul']    = $this->getModuls($item->modul);
                $nestedData['actions']  = '
                <div class="btn-group">
                    <a href="'.route('back.system.hak-akses-modul.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Hak Akses Modul">
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

    private function getModuls($moduls)
    {
        $output = '<ul>';
        foreach ($moduls as $item) {
            $output .= '
                <li>'.  $item->nama .'</li>
            ';
        }

        $output .= '</ul>';
        return $output;
    }
}
