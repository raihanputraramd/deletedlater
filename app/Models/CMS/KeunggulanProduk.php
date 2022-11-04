<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeunggulanProduk extends Model
{
    use HasFactory;

    protected $table = 'keunggulan_produk';

    public function gambar()
    {
        $link = $this->gambar !== "noimage.png"
            ? asset('back_assets/dist/img/cms/keunggulan-produk/'. $this->gambar)
            : asset('front_assets/images/home/keper-img.png');

        return $link;
    }
}
