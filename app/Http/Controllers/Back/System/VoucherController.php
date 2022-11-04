<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Voucher')) {
            return view('back.system.voucher.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Voucher')) {
            return view('back.system.voucher.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Voucher')) {
            DB::beginTransaction();
            try {
                $voucher                    = new Voucher();
                $voucher->kode              = $request->kode;
                $voucher->nama              = $request->nama;
                $voucher->tanggal_mulai     = $request->tanggal_mulai;
                $voucher->tanggal_berakhir  = $request->tanggal_berakhir;
                $voucher->potongan          = $request->potongan;
                $voucher->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Voucher Berhasil Ditambahkan');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Voucher')) {
            $voucher = Voucher::findOrFail($id);
    
            return view('back.system.voucher.edit', compact('voucher'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Voucher')) {
            DB::beginTransaction();
            try {
                $voucher                    = Voucher::findOrFail($id);
                $voucher->kode              = $request->kode;
                $voucher->nama              = $request->nama;
                $voucher->tanggal_mulai     = $request->tanggal_mulai;
                $voucher->tanggal_berakhir  = $request->tanggal_berakhir;
                $voucher->potongan          = $request->potongan;
                $voucher->save();
    
                DB::commit();
                return redirect()->back()->with('success', 'Data Voucher Berhasil Di Edit');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function destroy($id)
    {
        if (HelpersUser::checkPermission('Edit Voucher')) {
            DB::beginTransaction();
            try {
                $voucher = Voucher::findOrFail($id);
                $voucher->delete();
    
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
        if (HelpersUser::checkPermission('Edit Voucher')) {
            $columns = array(
                0 => 'id',
                1 => 'kode',
                2 => 'nama',
                3 => 'potongan',
                4 => 'tanggal_mulai',
            );
    
            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');
    
            $rows = Voucher::select('*');
    
            // Search section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('nama', 'like', '%'.$input_search.'%')
                        ->orWhere('kode', 'like', '%'.$input_search.'%');
                });
            }
    
            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();
    
            $data = array();
            $no = 0;
    
            foreach ($rows as $item) {
                $no++;
                $nestedData['id'] = $item->id;
                $nestedData['kode'] = $item->kode;
                $nestedData['nama'] = $item->nama;
                $nestedData['potongan'] = number_format($item->potongan,0,',','.');
                $nestedData['tanggal'] = $item->tanggalVoucher();
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.system.voucher.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Voucher"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.system.voucher.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
