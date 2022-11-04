<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as UserHelp;
use App\Http\Controllers\Controller;
use App\Models\CMS\GaleriJudul;
use App\Models\CMS\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeriJudul = GaleriJudul::first();

        return view('back.cms.galeri.index', compact('galeriJudul'));
    }

    public function storeJudulGaleri(Request $request)
    {
        DB::beginTransaction();
        try {
            $galeriJudul = GaleriJudul::first();

            if ($galeriJudul != null) {
                $galeriJudul->judul             = $request->judul;
                $galeriJudul->deskripsi         = $request->deskripsi;
                $galeriJudul->save();
            } else {
                $galeriJudul                    = new GaleriJudul();
                $galeriJudul->judul             = $request->judul;
                $galeriJudul->deskripsi         = $request->deskripsi;
                $galeriJudul->save();
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
        $count = Galeri::count();
        if($count >= 30) {
            return redirect()->back()->with('error', 'Mohon maaf data yang sudah dimasukan sudah melebihi limit');
        }
        return view('back.cms.galeri.create');
    }

    public function store(Request $request)
    {
        $count = Galeri::count();
        if($count >= 30) {
            return redirect()->back()->with('error', 'Mohon maaf data yang sudah dimasukan sudah melebihi limit');
        }

        DB::beginTransaction();
        try {
            $galeri                     = new Galeri();
            $galeri->nama               = $request->nama;

            if($request->hasFile('gambar')) {
                $galeri->gambar = UserHelp::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/galeri/');
            }

            $galeri->save();

            DB::commit();
            return redirect()->route('back.cms.galeri.index')->with('success', 'Galeri berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);

        return view('back.cms.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $galeri                     = Galeri::findOrFail($id);
            $galeri->nama               = $request->nama;

            if($request->hasFile('gambar')) {
                $galeri->gambar = UserHelp::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/galeri/');
            }

            $galeri->save();

            DB::commit();
            return redirect()->route('back.cms.galeri.index')->with('success', 'Galeri berhasil diedit');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $galeri = Galeri::findOrFail($id);
            if($galeri->gambar !== "noimage.png") {
                File::delete('back_assets/dist/img/cms/galeri/'. $galeri->gambar);
            }
            $galeri->delete();

            DB::commit();
            return response()->json([
                'message' => 'Galeri berhasil dihapus'
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
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $input_search = $request->input('search.value');

        $rows = Galeri::select('*');

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
            $nestedData['gambar']       = '<img src="'.$item->gambar().'" width="100px">';
            $nestedData['actions'] = '
            <div class="btn-group">
                <a href="'.route('back.cms.galeri.edit', $item->id).'" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                <a href="'.route('back.cms.galeri.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
