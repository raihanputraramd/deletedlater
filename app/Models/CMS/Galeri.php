<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    public function gambar()
    {
        $link = $this->gambar !== "noimage.png"
            ? asset('back_assets/dist/img/cms/galeri/'. $this->gambar)
            : asset('back_assets/dist/img/public/'. $this->gambar);

        return $link;
    }
}
