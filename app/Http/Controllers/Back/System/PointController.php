<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\System\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function create()
    {
        if (HelpersUser::checkPermission('Transaksi Point')) {
            $point = Point::first();

            return view('back.system.point.create', compact('point'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Transaksi Point')) {
            DB::beginTransaction();
            try {
                $point = Point::first();

                if ($point == null) {
                    Point::create([
                        'nominal' => $request->nominal
                    ]);
                    
                } else {
                    Point::first()->update([
                        'nominal' => $request->nominal
                    ]);
                }

                DB::commit();
                return redirect()->back()->with('success', 'Transaksi point berhasil disetting');
            } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
