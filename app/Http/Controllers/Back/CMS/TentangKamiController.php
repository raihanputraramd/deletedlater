<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\CMS\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentangKami = TentangKami::first();

        return view('back.cms.tentang-kami.index', compact('tentangKami'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $tentangKami = TentangKami::first();

        try {
            if ($tentangKami != null) {
                $tentangKami->judul     = $request->judul;
                $tentangKami->deskripsi = $request->deskripsi;
                $tentangKami->save();

            } else {
                $tentangKami             = new TentangKami();
                $tentangKami->judul     = $request->judul;
                $tentangKami->deskripsi = $request->deskripsi;
                $tentangKami->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten Tentang Kami Berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
