<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HapusDataPenjualanController extends Controller
{
    public function create()
    {
        if (HelpersUser::checkPermission('Hapus Penjualan')) {
            return view('back.system.hapus-data-penjualan.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Hapus Penjualan')) {
            DB::beginTransaction();
            try {
                Penjualan::where('tanggal', '<', $request->tanggal)->delete();

                DB::commit();
                return redirect()->back()->with('success', 'Data penjualan berhasil dihapus');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
