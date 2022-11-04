<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    public function gambar()
    {
        $link = $this->gambar !== "noimage.png"
            ? asset('back_assets/dist/img/cms/produk/'. $this->gambar)
            : asset('back_assets/dist/img/public/'. $this->gambar);

        return $link;
    }

    public function harga()
    {
        $harga = number_format($this->harga,0,',','.');

        return $harga;
    }
}
