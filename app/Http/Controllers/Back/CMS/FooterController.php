<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\CMS\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::first();

        return view('back.cms.footer.index', compact('footer'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $footer = Footer::first();

        try {
            if ($footer != null) {
                $footer->judul_alamat           = $request->judul_alamat;
                $footer->judul_telepon          = $request->judul_telepon;
                $footer->judul_email            = $request->judul_email;
                $footer->judul_marketplace      = $request->judul_marketplace;
                $footer->jam_buka               = $request->jam_buka;
                $footer->telepon_1              = $request->telepon_1;
                $footer->telepon_2              = $request->telepon_2;
                $footer->email_1                = $request->email_1;
                $footer->email_2                = $request->email_2;
                $footer->alamat                 = $request->alamat;
                $footer->sosial_1_link          = $request->sosial_1_link;
                $footer->sosial_2_link          = $request->sosial_2_link;
                $footer->sosial_3_link          = $request->sosial_3_link;
                $footer->sosial_4_link          = $request->sosial_3_link;
                $footer->marketplace_1_nama     = $request->marketplace_1_nama;
                $footer->marketplace_2_nama     = $request->marketplace_2_nama;
                $footer->marketplace_3_nama     = $request->marketplace_3_nama;
                $footer->marketplace_1_link     = $request->marketplace_1_link;
                $footer->marketplace_2_link     = $request->marketplace_2_link;
                $footer->marketplace_3_link     = $request->marketplace_3_link;


                if($request->hasfile('icon_alamat')) {
                    if($footer->icon_alamat != 'noimage.png') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_1_gambar);
                    }
                    $footer->icon_alamat = HelpersUser::uploadImage($request, 'icon_alamat', 'back_assets/dist/img/cms/footer/');
                }
                if($request->hasfile('icon_email')) {
                    if($footer->icon_email != 'noimage.png') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_2_gambar);
                    }
                    $footer->icon_email = HelpersUser::uploadImage($request, 'icon_email', 'back_assets/dist/img/cms/footer/');
                }
                if($request->hasfile('icon_telepon')) {
                    if($footer->icon_telepon != 'noimage.png') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_3_gambar);
                    }
                    $footer->icon_telepon = HelpersUser::uploadImage($request, 'icon_telepon', 'back_assets/dist/img/cms/footer/');
                }
                if($request->hasfile('icon_marketplace')) {
                    if($footer->icon_marketplace != 'noimage.png') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_3_gambar);
                    }
                    $footer->icon_marketplace = HelpersUser::uploadImage($request, 'icon_marketplace', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('sosial_1_gambar')) {
                    if($footer->sosial_1_gambar != 'footer-youtube.svg') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_1_gambar);
                    }
                    $footer->sosial_1_gambar = HelpersUser::uploadImage($request, 'sosial_1_gambar', 'back_assets/dist/img/cms/footer/');
                }
                if($request->hasfile('sosial_2_gambar')) {
                    if($footer->sosial_2_gambar != 'footer-facebook.svg') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_2_gambar);
                    }
                    $footer->sosial_2_gambar = HelpersUser::uploadImage($request, 'sosial_2_gambar', 'back_assets/dist/img/cms/footer/');
                }
                if($request->hasfile('sosial_3_gambar')) {
                    if($footer->sosial_3_gambar != 'footer-instagram.svg') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_3_gambar);
                    }
                    $footer->sosial_3_gambar = HelpersUser::uploadImage($request, 'sosial_3_gambar', 'back_assets/dist/img/cms/footer/');
                }
                if($request->hasfile('sosial_4_gambar')) {
                    if($footer->sosial_4_gambar != 'footer-instagram.svg') {
                        File::delete('back_assets/dist/img/cms/footer/'. $footer->sosial_4_gambar);
                    }
                    $footer->sosial_4_gambar = HelpersUser::uploadImage($request, 'sosial_4_gambar', 'back_assets/dist/img/cms/footer/');
                }

                $footer->save();
            } else {
                $footer                     = new Footer();
                $footer->judul_alamat           = $request->judul_alamat;
                $footer->judul_telepon          = $request->judul_telepon;
                $footer->judul_email            = $request->judul_email;
                $footer->judul_marketplace      = $request->judul_marketplace;
                $footer->jam_buka               = $request->jam_buka;
                $footer->telepon_1              = $request->telepon_1;
                $footer->telepon_2              = $request->telepon_2;
                $footer->email_1                = $request->email_1;
                $footer->email_2                = $request->email_2;
                $footer->alamat                 = $request->alamat;
                $footer->sosial_1_link          = $request->sosial_1_link;
                $footer->sosial_2_link          = $request->sosial_2_link;
                $footer->sosial_3_link          = $request->sosial_3_link;
                $footer->sosial_4_link          = $request->sosial_3_link;
                $footer->marketplace_1_nama     = $request->marketplace_1_nama;
                $footer->marketplace_2_nama     = $request->marketplace_2_nama;
                $footer->marketplace_3_nama     = $request->marketplace_3_nama;
                $footer->marketplace_1_link     = $request->marketplace_1_link;
                $footer->marketplace_2_link     = $request->marketplace_2_link;
                $footer->marketplace_3_link     = $request->marketplace_3_link;

                if($request->hasfile('icon_alamat')) {
                    $footer->icon_alamat = HelpersUser::uploadImage($request, 'icon_alamat', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('icon_email')) {
                    $footer->icon_email = HelpersUser::uploadImage($request, 'icon_email', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('icon_telepon')) {
                    $footer->icon_telepon = HelpersUser::uploadImage($request, 'icon_telepon', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('icon_marketplace')) {
                    $footer->icon_marketplace = HelpersUser::uploadImage($request, 'icon_marketplace', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('sosial_1_gambar')) {
                    $footer->sosial_1_gambar = HelpersUser::uploadImage($request, 'sosial_1_gambar', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('sosial_2_gambar')) {
                    $footer->sosial_2_gambar = HelpersUser::uploadImage($request, 'sosial_2_gambar', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('sosial_3_gambar')) {
                    $footer->sosial_3_gambar = HelpersUser::uploadImage($request, 'sosial_3_gambar', 'back_assets/dist/img/cms/footer/');
                }

                if($request->hasfile('sosial_4_gambar')) {
                    $footer->sosial_3_gambar = HelpersUser::uploadImage($request, 'sosial_4_gambar', 'back_assets/dist/img/cms/footer/');
                }

                $footer->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten Footer Berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
