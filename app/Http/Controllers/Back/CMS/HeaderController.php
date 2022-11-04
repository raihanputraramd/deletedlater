<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\CMS\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HeaderController extends Controller
{
    public function index()
    {
        $header = Header::first();

        return view('back.cms.header.index', compact('header'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $header = Header::first();

        try {
            if ($header != null) {
                $header->judul      = $request->judul;
                $header->deskripsi  = $request->deskripsi;

                if($request->hasfile('logo')) {
                    if($header->logo != 'logo.jpg') {
                        File::delete('back_assets/dist/img/cms/header/'. $header->logo);
                    }
                    $header->logo = HelpersUser::uploadImage($request, 'logo', 'back_assets/dist/img/cms/header/');
                }

                if($request->hasfile('gambar')) {
                    if($header->gambar != 'header-img.jpg') {
                        File::delete('back_assets/dist/img/cms/header/'. $header->gambar);
                    }
                    $header->gambar = HelpersUser::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/header/');
                }

                $header->save();
            } else {
                $header             = new Header();
                $header->judul      = $request->judul;
                $header->deskripsi  = $request->deskripsi;

                if($request->hasfile('logo')) {
                    $header->logo = HelpersUser::uploadImage($request, 'logo', 'back_assets/dist/img/cms/header/');
                }

                if($request->hasfile('gambar')) {
                    $header->gambar = HelpersUser::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/header/');
                }

                $header->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten Header Berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
