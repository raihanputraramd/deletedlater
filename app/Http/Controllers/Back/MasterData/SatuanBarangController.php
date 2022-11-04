<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Barang\SatuanBarang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanBarangController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Satuan Barang')) {
            return view('back.master-data.satuan-barang.index');
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Satuan Barang')) {
            return view('back.master-data.satuan-barang.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Satuan Barang')) {
            DB::beginTransaction();
            try {
                $satuanBarang               = new SatuanBarang();
                $satuanBarang->nama         = $request->nama;
                $satuanBarang->keterangan   = $request->keterangan;
                $satuanBarang->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Satuan Barang Berhasil Ditambah');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Satuan Barang')) {
            $satuanBarang = SatuanBarang::findOrFail($id);
    
            return view('back.master-data.satuan-barang.edit', compact('satuanBarang'));
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Satuan Barang')) {
            DB::beginTransaction();
            try {
                $satuanBarang               = SatuanBarang::findOrFail($id);
                $satuanBarang->nama         = $request->nama;
                $satuanBarang->keterangan   = $request->keterangan;
                $satuanBarang->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Satuan Barang Berhasil Di Edit');
            } catch(Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function destroy($id)
    {
        if (HelpersUser::checkPermission('Edit Satuan Barang')) {
            DB::beginTransaction();
            try {
                $satuanBarang = SatuanBarang::findOrFail($id);
                $satuanBarang->delete();
    
                DB::commit();
                return response()->json([
                    'message' => 'Data Berhasil Dihapus'
                ], $id != null ? 200 : 201);
            } catch(\Exception $e) {
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
        if (HelpersUser::checkPermission('Edit Satuan Barang')) {
            $columns = array(
                0 => 'id',
                1 => 'nama',
                2 => 'keterangan'
            );
    
            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');
    
            $rows = SatuanBarang::select('*');
    
            // Search Section
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
    
            foreach($rows as $item) {
                $no++;
                $nestedData['id'] = $item->id;
                $nestedData['nama'] = $item->nama;
                $nestedData['keterangan'] = $item->keterangan;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.master-data.satuan-barang.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Satuan Barang"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.master-data.satuan-barang.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
