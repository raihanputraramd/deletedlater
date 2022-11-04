<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\CMS\KeunggulanProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KeunggulanProdukController extends Controller
{
    public function index()
    {
        $keunggulan = KeunggulanProduk::first();

        return view('back.cms.keunggulan-produk.index', compact('keunggulan'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $keunggulan = KeunggulanProduk::first();

        try {
            if ($keunggulan != null) {
                $keunggulan->judul        = $request->judul;

                $keunggulan->keunggulan_1_judul = $request->keunggulan_1_judul;
                $keunggulan->keunggulan_1_deskripsi = $request->keunggulan_1_deskripsi;

                $keunggulan->keunggulan_2_judul = $request->keunggulan_2_judul;
                $keunggulan->keunggulan_2_deskripsi = $request->keunggulan_2_deskripsi;

                $keunggulan->keunggulan_3_judul = $request->keunggulan_3_judul;
                $keunggulan->keunggulan_3_deskripsi = $request->keunggulan_3_deskripsi;

                if($request->hasfile('gambar')) {
                    if($keunggulan->gambar != 'noimage.png') {
                        File::delete('back_assets/dist/img/cms/keunggulan-produk/'. $keunggulan->gambar);
                    }
                    $keunggulan->gambar = HelpersUser::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/keunggulan-produk/');
                }

                $keunggulan->save();
            } else {
                $keunggulan             = new KeunggulanProduk();
                $keunggulan->judul      = $request->judul;

                $keunggulan->keunggulan_1_judul = $request->keunggulan_1_judul;
                $keunggulan->keunggulan_1_deskripsi = $request->keunggulan_1_deskripsi;

                $keunggulan->keunggulan_2_judul = $request->keunggulan_2_judul;
                $keunggulan->keunggulan_2_deskripsi = $request->keunggulan_2_deskripsi;

                $keunggulan->keunggulan_3_judul = $request->keunggulan_3_judul;
                $keunggulan->keunggulan_3_deskripsi = $request->keunggulan_3_deskripsi;

                if($request->hasfile('gambar')) {
                    $keunggulan->gambar = HelpersUser::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/keunggulan-produk/');
                }

                $keunggulan->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten Keunggulan Produk Berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
