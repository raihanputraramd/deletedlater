<?php

namespace App\Models\MasterData\Barang;

use App\Models\MasterData\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function barangStok()
    {
        return $this->hasOne(BarangStok::class, 'barang_id');
    }

    public function barangHarga()
    {
        return $this->hasOne(BarangHarga::class, 'barang_id');
    }

    public function barangDiskon()
    {
        return $this->hasOne(BarangDiskon::class, 'barang_id');
    }

    public function gambar()
    { 
        $gambar = $this->gambar;
        $link = $gambar !== "noimage.png" 
            ? asset('back_assets/dist/img/master-data/barang/'. $gambar) 
            : asset('back_assets/img/public/'. $gambar);

        return $link;
    }

    public function harga($level, $hargaEdit = null)
    {
        $hargaPelanggan = $this->cekHarga($level);
        if($hargaEdit != null) {
            $hargaPelanggan = $hargaEdit;
        }

        return $hargaPelanggan;
    }

    public function diskon($level, $qty, $hargaEdit = null)
    {
        $hargaPelanggan = $this->cekHarga($level);
        if($hargaEdit != null) {
            $hargaPelanggan = $hargaEdit;
        }
        $diskonPelanggan = $this->diskonPelanggan($level);
        if ($hargaPelanggan < 1) {
            $diskonPelanggan = 0;
        }
        $harga = $hargaPelanggan - $diskonPelanggan;
        $diskonQty = $this->diskonQty($level, $qty, $harga);
        // $hargaDiskon = $this->diskonJual($diskonQty);
        $hargaFinal = $hargaPelanggan - $diskonQty;

        return $hargaFinal;
    }

    private function cekHarga($level)
    {
        if($level == "Grosir 1") {
            return $this->barangHarga->harga_jual_1;
        } else if($level == "Grosir 2") {
            return $this->barangHarga->harga_jual_2;
        } else if($level == "Grosir 3") {
            return $this->barangHarga->harga_jual_3;
        } else {
            return $this->barangHarga->harga_jual;
        }
    }

    private function diskonJual($jumlah)
    {
        if($this->barangDiskon->diskon_jual == 0) {
            $harga = $jumlah;
        } else {
            $harga = $jumlah - ($jumlah * ($this->barangDiskon->diskon_jual / 100));
        }
        
        return $harga;
    }

    private function diskonPelanggan($level)
    {
        if($level == "Grosir 1") {
            return $this->barangDiskon->diskon_amount_2;
        } else if($level == "Grosir 2") {
            return $this->barangDiskon->diskon_amount_3;
        } else if($level == "Grosir 3") {
            return $this->barangDiskon->diskon_amount_4;
        } else {
            return $this->barangDiskon->diskon_amount_1;
        }
    }

    private function diskonQty($level, $qty, $jumlah)
    {
        if($level == "Grosir 1") {
            if($qty >= $this->barangDiskon->diskon_qty_2) {
                $harga = $jumlah - ($jumlah * ($this->barangDiskon->diskon_qty_persen_2 / 100));
            } else {
                $harga = $jumlah;
            }
        } else if($level == "Grosir 2") {
            if($qty >= $this->barangDiskon->diskon_qty_3) {
                $harga = $jumlah - ($jumlah * ($this->barangDiskon->diskon_qty_persen_3 / 100));
            } else {
                $harga = $jumlah;
            }
        } else if($level == "Grosir 3") {
            if($qty >= $this->barangDiskon->diskon_qty_4) {
                $harga = $jumlah - ($jumlah * ($this->barangDiskon->diskon_qty_persen_4 / 100));
            } else {
                $harga = $jumlah;
            }
        } else {
            if($qty >= $this->barangDiskon->diskon_qty_1) {
                $harga = $jumlah - ($jumlah * ($this->barangDiskon->diskon_qty_persen_1 / 100));
            } else {
                $harga = $jumlah;
            }
        }

        return $harga;
    }

    public function hargaBeli()
    {
        $harga = $this->harga_beli;

        return $harga;
    }

    public function diskonBeli()
    {
        $harga = $this->harga_beli - $this->diskonPembelian($this->harga_beli);

        return $harga;
    }

    private function diskonPembelian($jumlah)
    {
        if($this->diskon_beli == 0) {
            $harga = $jumlah;
        } else {
            $harga = $jumlah - ($jumlah * ($this->diskon_beli / 100));
        }
        
        return $harga;
    }
}
