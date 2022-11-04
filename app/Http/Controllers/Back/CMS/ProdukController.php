<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as UserHelp;
use App\Http\Controllers\Controller;
use App\Models\CMS\ProdukJudul;
use App\Models\CMS\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProdukController extends Controller
{
    public function index()
    {
        $produkJudul = ProdukJudul::first();

        return view('back.cms.produk.index', compact('produkJudul'));
    }

    public function storeJudulProduk(Request $request)
    {
        DB::beginTransaction();
        try {
            $produkJudul = ProdukJudul::first();

            if ($produkJudul != null) {
                $produkJudul->judul             = $request->judul;
                $produkJudul->save();
            } else {
                $produkJudul                    = new ProdukJudul();
                $produkJudul->judul             = $request->judul;
                $produkJudul->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Konten berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $count = Produk::count();
        if($count >= 5) {
            return redirect()->back()->with('error', 'Mohon maaf data yang sudah dimasukan sudah melebihi limit');
        }
        return view('back.cms.produk.create');
    }

    public function store(Request $request)
    {
        $count = Produk::count();
        if($count >= 5) {
            return redirect()->back()->with('error', 'Mohon maaf data yang sudah dimasukan sudah melebihi limit');
        }

        DB::beginTransaction();
        try {
            $produk             = new Produk();
            $produk->nama       = $request->nama;
            $produk->harga      = $request->harga;
            $produk->deskripsi  = $request->deskripsi;

            if($request->hasFile('gambar')) {
                $produk->gambar = UserHelp::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/produk/');
            }

            $produk->save();

            DB::commit();
            return redirect()->route('back.cms.produk.index')->with('success', 'Produk berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('back.cms.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $produk             = Produk::findOrFail($id);
            $produk->nama       = $request->nama;
            $produk->harga      = $request->harga;
            $produk->deskripsi  = $request->deskripsi;

            if($request->hasFile('gambar')) {
                $produk->gambar = UserHelp::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/produk/');
            }

            $produk->save();

            DB::commit();
            return redirect()->route('back.cms.produk.index')->with('success', 'Produk berhasil diedit');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $produk = Produk::findOrFail($id);
            if($produk->gambar !== "noimage.png") {
                File::delete('back_assets/dist/img/cms/produk/'. $produk->gambar);
            }
            $produk->delete();

            DB::commit();
            return response()->json([
                'message' => 'Produk berhasil dihapus'
			], $id != null ? 200 : 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'nama',
            2 => 'harga',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $input_search = $request->input('search.value');

        $rows = Produk::select('*');

        //Search Section
        if (!empty($input_search)) {
            $rows->where(function($query) use ($input_search) {
                return $query->where('nama', 'like', '%'.$input_search.'%');
            });
        }

        $totalData = $rows->count();
        $rows = $rows->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        //Customize your data here
        $data = array();
        $no = 0;
        foreach ($rows as $item) {
            $no++;
            $nestedData['no']           = $no;
            $nestedData['nama']         = $item->nama;
            $nestedData['harga']        = $item->harga();
            $nestedData['gambar']       = '<img src="'.$item->gambar().'" width="100px">';
            $nestedData['actions'] = '
            <div class="btn-group">
                <a href="'.route('back.cms.produk.edit', $item->id).'" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                <a href="'.route('back.cms.produk.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
            </div>';

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $data
        );

        return response()->json($json_data);
    }
}
