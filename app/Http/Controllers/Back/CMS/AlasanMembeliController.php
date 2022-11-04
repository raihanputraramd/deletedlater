<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\CMS\AlasanMembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AlasanMembeliController extends Controller
{
    public function index()
    {
        $alasanMembeli = AlasanMembeli::first();

        return view('back.cms.alasan-membeli.index', compact('alasanMembeli'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $alasanMembeli = AlasanMembeli::first();

        try {
            if ($alasanMembeli != null) {
                $alasanMembeli->judul        = $request->judul;
                $alasanMembeli->deskripsi    = $request->deskripsi;

                $alasanMembeli->alasan_1_judul          = $request->alasan_1_judul;
                $alasanMembeli->alasan_1_deskripsi      = $request->alasan_1_deskripsi;

                $alasanMembeli->alasan_2_judul          = $request->alasan_2_judul;
                $alasanMembeli->alasan_2_deskripsi      = $request->alasan_2_deskripsi;

                $alasanMembeli->alasan_3_judul          = $request->alasan_3_judul;
                $alasanMembeli->alasan_3_deskripsi      = $request->alasan_3_deskripsi;

                $alasanMembeli->alasan_4_judul          = $request->alasan_4_judul;
                $alasanMembeli->alasan_4_deskripsi      = $request->alasan_4_deskripsi;

                $alasanMembeli->save();
            } else {
                $alasanMembeli             = new AlasanMembeli();
                $alasanMembeli->judul      = $request->judul;
                $alasanMembeli->deskripsi  = $request->deskripsi;

                $alasanMembeli->alasan_1_judul          = $request->alasan_1_judul;
                $alasanMembeli->alasan_1_deskripsi      = $request->alasan_1_deskripsi;

                $alasanMembeli->alasan_2_judul          = $request->alasan_2_judul;
                $alasanMembeli->alasan_2_deskripsi      = $request->alasan_2_deskripsi;

                $alasanMembeli->alasan_3_judul          = $request->alasan_3_judul;
                $alasanMembeli->alasan_3_deskripsi      = $request->alasan_3_deskripsi;

                $alasanMembeli->alasan_4_judul          = $request->alasan_4_judul;
                $alasanMembeli->alasan_4_deskripsi      = $request->alasan_4_deskripsi;

                $alasanMembeli->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten Alasan Membeli Berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
