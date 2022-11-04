<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CMS\AlasanMembeli;
use App\Models\CMS\Footer;
use App\Models\CMS\Galeri;
use App\Models\CMS\GaleriJudul;
use App\Models\CMS\Header;
use App\Models\CMS\Keunggulan;
use App\Models\CMS\KeunggulanProduk;
use App\Models\CMS\Produk;
use App\Models\CMS\ProdukJudul;
use App\Models\CMS\TentangKami;
use App\Models\CMS\Testimoni;
use App\Models\CMS\TestimoniJudul;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $header = Header::first();
        $keunggulan = Keunggulan::first();
        $keunggulanProduk = KeunggulanProduk::first();
        $galeriJudul = GaleriJudul::first();
        $galeri = Galeri::all();
        $tentangKami = TentangKami::first();
        $alasanMembeli = AlasanMembeli::first();
        $testimoniJudul = TestimoniJudul::first();
        $testimoni = Testimoni::all();
        $produkJudul = ProdukJudul::first();
        $produk = Produk::all();
        $footer = Footer::first();

        return view('front.home.index', compact(
            'header',
            'keunggulan',
            'keunggulanProduk',
            'galeriJudul',
            'galeri',
            'tentangKami',
            'alasanMembeli',
            'testimoniJudul',
            'testimoni',
            'produkJudul',
            'produk',
            'footer'
        ));
    }
}
