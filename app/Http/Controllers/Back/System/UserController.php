<?php

namespace App\Http\Controllers\Back\System;

use App\Exports\System\UserExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\Grup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit User')) {
            return view('back.system.users.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Edit User')) {
            $grup = Grup::select('id', 'nama')->get();

            return view('back.system.users.create', compact('grup'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah User')) {
            DB::beginTransaction();
            try {
                $user                  = new User();
                $user->nama            = $request->nama;
                $user->username        = $request->username;
                $user->password        = Hash::make($request->password);
                $user->gender          = $request->gender;
                $user->no_induk        = $request->no_induk;
                $user->no_hp           = $request->no_hp;
                $user->no_telepon      = $request->no_telepon;
                $user->jabatan         = $request->jabatan;
                $user->alamat          = $request->alamat;
                $user->grup_id         = $request->grup;
                $user->save();

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
        if (HelpersUser::checkPermission('Edit User')) {
            $user = User::findOrFail($id);
            $grup = Grup::select('id', 'nama')->get();

            return view('back.system.users.edit', compact('user', 'grup'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit User')) {
            DB::beginTransaction();
            try {
                $user                  = User::findOrFail($id);
                $user->nama            = $request->nama;
                $user->username        = $request->username;
                if ($request->password) {
                    $user->password    = Hash::make($request->password);
                }
                $user->gender          = $request->gender;
                $user->status          = $request->status;
                $user->no_induk        = $request->no_induk;
                $user->no_hp           = $request->no_hp;
                $user->no_telepon      = $request->no_telepon;
                $user->jabatan         = $request->jabatan;
                $user->alamat          = $request->alamat;
                $user->grup_id         = $request->grup;
                $user->save();

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
        if (HelpersUser::checkPermission('Edit User')) {
            DB::beginTransaction();
            try {
                $user = User::findOrFail($id);
                $user->delete();

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
        if (HelpersUser::checkPermission('Edit User')) {
            $columns = array(
                0 => 'users.id',
                1 => 'users.username',
                2 => 'users.nama',
                3 => 'users.status',
                4 => 'users.gender',
                5 => 'users.jabatan',
                6 => 'grup.nama',
                7 => 'users.no_induk',
                8 => 'users.no_hp',
                9 => 'users.no_telepon',
                10 => 'users.alamat',
            );

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');

            $rows = User::select(
                'users.id',
                'users.username',
                'users.nama',
                'users.status',
                'users.gender',
                'users.jabatan',
                'users.no_induk',
                'users.no_hp',
                'users.no_telepon',
                'users.alamat',
                'grup.nama as grup')->leftJoin('grup', 'grup.id', '=', 'users.grup_id');

            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('users.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('users.username', 'like', '%'.$input_search.'%')
                        ->orWhere('users.no_induk', 'like', '%'.$input_search.'%')
                        ->orWhere('users.no_hp', 'like', '%'.$input_search.'%')
                        ->orWhere('users.no_telepon', 'like', '%'.$input_search.'%')
                        ->orWhere('users.alamat', 'like', '%'.$input_search.'%')
                        ->orWhere('grup.nama', 'like', '%'.$input_search.'%');
                });
            }

            $totalData = $rows->count();
            $rows = $rows->offset($start)->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']           = $no;
                $nestedData['nama']         = $item->nama;
                $nestedData['username']     = $item->username;
                $nestedData['status']       = $item->status();
                $nestedData['no_induk']     = $item->no_induk;
                $nestedData['gender']       = $item->gender;
                $nestedData['jabatan']      = $item->jabatan;
                $nestedData['grup']         = $item->grup;
                $nestedData['no_hp']        = $item->no_hp;
                $nestedData['no_telepon']   = $item->no_telepon;
                $nestedData['alamat']       = $item->alamat;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.system.users.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit User"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.system.users.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
        $users = User::select(
            'users.id',
            'users.username',
            'users.nama',
            'users.status',
            'users.gender',
            'users.jabatan',
            'users.no_induk',
            'users.no_hp',
            'users.no_telepon',
            'users.alamat',
            'grup.nama as grup')->leftJoin('grup', 'grup.id', '=', 'users.grup_id')->get();

        $pdf = PDF::loadview('back.system.users.pdf', compact('users'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit User')) {
            $users = User::select(
                'users.id',
                'users.username',
                'users.nama',
                'users.status',
                'users.gender',
                'users.jabatan',
                'users.no_induk',
                'users.no_hp',
                'users.no_telepon',
                'users.alamat',
                'grup.nama as grup')->leftJoin('grup', 'grup.id', '=', 'users.grup_id')->get();

            return Excel::download(new UserExport($users),  'data-user-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
