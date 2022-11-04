<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\LimitTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LimitTransaksiController extends Controller
{
    public function create()
    {
        if (auth()->user()->nama == "Superadmin Ahlinyaweb") {
            $limitTransaksi = LimitTransaksi::first();
    
            return view('back.system.limit-transaksi.create', compact('limitTransaksi'));
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        if (auth()->user()->nama == "Superadmin Ahlinyaweb") {
            DB::beginTransaction();
            try {
                $limitTransaksi = LimitTransaksi::first();
    
                if ($limitTransaksi == null) {
                    LimitTransaksi::create([
                        'nominal' => $request->nominal
                    ]);
                    
                } else {
                    LimitTransaksi::first()->update([
                        'nominal' => $request->nominal
                    ]);
                }
    
                DB::commit();
                return redirect()->back()->with('success', 'Limit Transaksi berhasil disetting');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return abort(404);
    }
}
