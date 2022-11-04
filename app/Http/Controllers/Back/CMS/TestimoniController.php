<?php

namespace App\Http\Controllers\Back\CMS;

use App\Helpers\User as UserHelp;
use App\Http\Controllers\Controller;
use App\Models\CMS\TestimoniJudul;
use App\Models\CMS\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TestimoniController extends Controller
{
    public function index()
    {
        $testimoniJudul = TestimoniJudul::first();

        return view('back.cms.testimoni.index', compact('testimoniJudul'));
    }

    public function storeJudulTestimoni(Request $request)
    {
        DB::beginTransaction();
        try {
            $testimoniJudul = TestimoniJudul::first();

            if ($testimoniJudul != null) {
                $testimoniJudul->judul             = $request->judul;
                $testimoniJudul->save();
            } else {
                $testimoniJudul                    = new TestimoniJudul();
                $testimoniJudul->judul             = $request->judul;
                $testimoniJudul->save();
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
        $count = Testimoni::count();
        if($count >= 5) {
            return redirect()->back()->with('error', 'Mohon maaf data yang sudah dimasukan sudah melebihi limit');
        }
        return view('back.cms.testimoni.create');
    }

    public function store(Request $request)
    {
        $count = Testimoni::count();
        if($count >= 5) {
            return redirect()->back()->with('error', 'Mohon maaf data yang sudah dimasukan sudah melebihi limit');
        }

        DB::beginTransaction();
        try {
            $testimoni                     = new Testimoni();
            $testimoni->nama               = $request->nama;
            $testimoni->pekerjaan          = $request->pekerjaan;
            $testimoni->deskripsi          = $request->deskripsi;

            if($request->hasFile('gambar')) {
                $testimoni->gambar = UserHelp::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/testimoni/');
            }

            $testimoni->save();

            DB::commit();
            return redirect()->route('back.cms.testimoni.index')->with('success', 'Testimoni berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        return view('back.cms.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $testimoni                     = Testimoni::findOrFail($id);
            $testimoni->nama               = $request->nama;
            $testimoni->pekerjaan          = $request->pekerjaan;
            $testimoni->deskripsi          = $request->deskripsi;

            if($request->hasFile('gambar')) {
                $testimoni->gambar = UserHelp::uploadImage($request, 'gambar', 'back_assets/dist/img/cms/testimoni/');
            }

            $testimoni->save();

            DB::commit();
            return redirect()->route('back.cms.testimoni.index')->with('success', 'Testimoni berhasil diedit');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $testimoni = Testimoni::findOrFail($id);
            if($testimoni->gambar !== "noimage.png") {
                File::delete('back_assets/dist/img/cms/testimoni/'. $testimoni->gambar);
            }
            $testimoni->delete();

            DB::commit();
            return response()->json([
                'message' => 'Testimoni berhasil dihapus'
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
            2 => 'pekerjaan',
            3 => 'deskripsi',
            4 => 'gambar',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $input_search = $request->input('search.value');

        $rows = Testimoni::select('*');

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
            $nestedData['pekerjaan']    = $item->pekerjaan;
            $nestedData['deskripsi']    = Str::limit($item->deskripsi, 50, '...');
            $nestedData['gambar']       = '<img src="'.$item->gambar().'" width="100px">';
            $nestedData['actions'] = '
            <div class="btn-group">
                <a href="'.route('back.cms.testimoni.edit', $item->id).'" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                <a href="'.route('back.cms.testimoni.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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
