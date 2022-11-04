<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\CMS\Keunggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KeunggulanController extends Controller
{
    public function index()
    {
        $keunggulan = Keunggulan::first();

        return view('back.cms.keunggulan.index', compact('keunggulan'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $keunggulan = Keunggulan::first();

        try {
            if ($keunggulan != null) {
                $keunggulan->judul        = $request->judul;
                $keunggulan->deskripsi    = $request->deskripsi;

                $keunggulan->keunggulan_1_judul = $request->keunggulan_1_judul;
                $keunggulan->keunggulan_1_deskripsi = $request->keunggulan_1_deskripsi;

                $keunggulan->keunggulan_2_judul = $request->keunggulan_2_judul;
                $keunggulan->keunggulan_2_deskripsi = $request->keunggulan_2_deskripsi;

                $keunggulan->keunggulan_3_judul = $request->keunggulan_3_judul;
                $keunggulan->keunggulan_3_deskripsi = $request->keunggulan_3_deskripsi;

                $keunggulan->keunggulan_4_judul = $request->keunggulan_4_judul;
                $keunggulan->keunggulan_4_deskripsi = $request->keunggulan_4_deskripsi;

                $keunggulan->save();
            } else {
                $keunggulan             = new Keunggulan();
                $keunggulan->judul      = $request->judul;
                $keunggulan->deskripsi  = $request->deskripsi;

                $keunggulan->keunggulan_1_judul = $request->keunggulan_1_judul;
                $keunggulan->keunggulan_1_deskripsi = $request->keunggulan_1_deskripsi;

                $keunggulan->keunggulan_2_judul = $request->keunggulan_2_judul;
                $keunggulan->keunggulan_2_deskripsi = $request->keunggulan_2_deskripsi;

                $keunggulan->keunggulan_3_judul = $request->keunggulan_3_judul;
                $keunggulan->keunggulan_3_deskripsi = $request->keunggulan_3_deskripsi;

                $keunggulan->keunggulan_4_judul = $request->keunggulan_4_judul;
                $keunggulan->keunggulan_4_deskripsi = $request->keunggulan_4_deskripsi;

                $keunggulan->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten Keunggulan Berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
