<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';

    public function gambar($gambar)
    {
        $link = $gambar !== "noimage.png"
            ? asset('back_assets/dist/img/cms/footer/'. $gambar)
            : asset('back_assets/dist/img/public/'. $gambar);

        return $link;
    }

    public function iconAlamat()
    {
        $link = $this->icon_alamat !== "noimage.png"
            ? asset('back_assets/dist/img/cms/footer/'. $this->icon_alamat)
            : asset('front_assets/images/home/footer-ic-1.png');

        return $link;
    }

    public function iconTelepon()
    {
        $link = $this->icon_telepon !== "noimage.png"
            ? asset('back_assets/dist/img/cms/footer/'. $this->icon_telepon)
            : asset('front_assets/images/home/footer-ic-2.png');

        return $link;
    }

    public function iconEmail()
    {
        $link = $this->icon_email !== "noimage.png"
            ? asset('back_assets/dist/img/cms/footer/'. $this->icon_email)
            : asset('front_assets/images/home/footer-ic-3.png');

        return $link;
    }

    public function iconMarketplace()
    {
        $link = $this->icon_marketplace !== "noimage.png"
            ? asset('back_assets/dist/img/cms/footer/'. $this->icon_marketplace)
            : asset('front_assets/images/home/footer-ic-4.png');

        return $link;
    }
}
