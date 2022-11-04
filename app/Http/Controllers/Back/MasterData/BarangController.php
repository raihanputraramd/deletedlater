<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Exports\MasterData\BarangExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Barang\Barang;
use App\Models\MasterData\Barang\BarangDiskon;
use App\Models\MasterData\Barang\BarangHarga;
use App\Models\MasterData\Barang\BarangStok;
use App\Models\MasterData\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BarangController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            return view('back.master-data.barang.index');
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Barang')) {
            return view('back.master-data.barang.create');
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Barang')) {
            DB::beginTransaction();
            try {
                $barang                 = new Barang();
                $barang->kode           = $request->kode;
                $barang->nama           = $request->nama;
                $barang->harga_beli     = $request->harga_beli;
                // $barang->diskon_beli    = $request->diskon_beli;
                $barang->berat          = $request->berat;
                $barang->omset          = $request->omset;
                $barang->size           = $request->size;
                $barang->deskripsi      = $request->deskripsi;
                $barang->supplier_id    = $request->supplier;

                if($request->hasFile('gambar')) {
                    $barang->gambar = HelpersUser::uploadImage($request, 'gambar', 'back_assets/dist/img/master-data/barang/');
                }

                $barang->save();

                $barangStok                     = new BarangStok();
                $barangStok->barang_id          = $barang->id;
                $barangStok->stok               = $request->stok;
                $barangStok->satuan_1           = $request->satuan_1;
                $barangStok->satuan_2           = $request->satuan_2;
                $barangStok->isi_satuan_2       = $request->isi_satuan_2;
                $barangStok->satuan_3           = $request->satuan_3;
                $barangStok->isi_satuan_3       = $request->isi_satuan_3;
                $barangStok->save();

                $barangHarga                    = new BarangHarga();
                $barangHarga->barang_id         = $barang->id;
                $barangHarga->harga_jual        = $request->harga_jual;
                $barangHarga->harga_jual_1      = $request->harga_jual_1;
                $barangHarga->harga_jual_2      = $request->harga_jual_2;
                $barangHarga->harga_jual_3      = $request->harga_jual_3;
                $barangHarga->save();

                $barangDiskon                       = new BarangDiskon();
                $barangDiskon->barang_id            = $barang->id;
                $barangDiskon->diskon_jual          = $request->diskon_jual;
                $barangDiskon->diskon_amount_1      = $request->diskon_amount_1;
                $barangDiskon->diskon_amount_2      = $request->diskon_amount_2;
                $barangDiskon->diskon_amount_3      = $request->diskon_amount_3;
                $barangDiskon->diskon_amount_4      = $request->diskon_amount_4;

                $barangDiskon->diskon_qty_1         = $request->diskon_qty_1;
                $barangDiskon->diskon_qty_2         = $request->diskon_qty_2;
                $barangDiskon->diskon_qty_3         = $request->diskon_qty_3;
                $barangDiskon->diskon_qty_4         = $request->diskon_qty_4;

                $barangDiskon->diskon_qty_persen_1  = $request->diskon_qty_persen_1;
                $barangDiskon->diskon_qty_persen_2  = $request->diskon_qty_persen_2;
                $barangDiskon->diskon_qty_persen_3  = $request->diskon_qty_persen_3;
                $barangDiskon->diskon_qty_persen_4  = $request->diskon_qty_persen_4;
                $barangDiskon->save();

                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil ditambah');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function edit($id)
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            $barang = Barang::findOrFail($id);

            return view('back.master-data.barang.edit', compact('barang'));
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            DB::beginTransaction();
            try {
                $barang                 = Barang::findOrFail($id);
                $barang->kode           = $request->kode;
                $barang->nama           = $request->nama;
                $barang->harga_beli     = $request->harga_beli;
                // $barang->diskon_beli    = $request->diskon_beli;
                $barang->berat          = $request->berat;
                $barang->omset          = $request->omset;
                $barang->size           = $request->size;
                $barang->deskripsi      = $request->deskripsi;
                $barang->supplier_id    = $request->supplier;

                if($request->hasFile('gambar')) {
                    if ($barang->gambar !== "noimage.png") {
                        File::delete('back_assets/dist/img/master-data/barang/'. $barang->gambar);
                    }
                    $barang->gambar = HelpersUser::uploadImage($request, 'gambar', 'back_assets/dist/img/master-data/barang/');
                }

                $barang->save();

                $barangStok                     = BarangStok::where('barang_id', $barang->id)->firstOrFail();
                $barangStok->barang_id          = $barang->id;
                $barangStok->stok               = $request->stok;
                $barangStok->satuan_1           = $request->satuan_1;
                $barangStok->satuan_2           = $request->satuan_2;
                $barangStok->isi_satuan_2       = $request->isi_satuan_2;
                $barangStok->satuan_3           = $request->satuan_3;
                $barangStok->isi_satuan_3       = $request->isi_satuan_3;
                $barangStok->save();

                $barangHarga                    = BarangHarga::where('barang_id', $barang->id)->firstOrFail();
                $barangHarga->barang_id         = $barang->id;
                $barangHarga->harga_jual        = $request->harga_jual;
                $barangHarga->harga_jual_1      = $request->harga_jual_1;
                $barangHarga->harga_jual_2      = $request->harga_jual_2;
                $barangHarga->harga_jual_3      = $request->harga_jual_3;
                $barangHarga->save();

                $barangDiskon                       = BarangDiskon::where('barang_id', $barang->id)->firstOrFail();
                $barangDiskon->barang_id            = $barang->id;
                $barangDiskon->diskon_jual          = $request->diskon_jual;
                $barangDiskon->diskon_amount_1      = $request->diskon_amount_1;
                $barangDiskon->diskon_amount_2      = $request->diskon_amount_2;
                $barangDiskon->diskon_amount_3      = $request->diskon_amount_3;
                $barangDiskon->diskon_amount_4      = $request->diskon_amount_4;

                $barangDiskon->diskon_qty_1         = $request->diskon_qty_1;
                $barangDiskon->diskon_qty_2         = $request->diskon_qty_2;
                $barangDiskon->diskon_qty_3         = $request->diskon_qty_3;
                $barangDiskon->diskon_qty_4         = $request->diskon_qty_4;

                $barangDiskon->diskon_qty_persen_1  = $request->diskon_qty_persen_1;
                $barangDiskon->diskon_qty_persen_2  = $request->diskon_qty_persen_2;
                $barangDiskon->diskon_qty_persen_3  = $request->diskon_qty_persen_3;
                $barangDiskon->diskon_qty_persen_4  = $request->diskon_qty_persen_4;
                $barangDiskon->save();

                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil diedit');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function destroy($id)
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            DB::beginTransaction();
            try {
                $barang = Barang::findOrFail($id);
                if ($barang->gambar !== "noimage.png") {
                    File::delete('back_assets/dist/img/master-data/barang/'. $barang->gambar);
                }
                $barang->delete();

                DB::commit();
                return response()->json([
                    'message' => 'Data berhasil dihapus'
                ], $id != null ? 200 : 201);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function data(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            $columns = array(
                0 => 'barang.id',
                1 => 'barang.kode',
                2 => 'barang.nama',
                3 => 'barang_stok.stok',
                4 => 'barang_stok.satuan_1',
                5 => 'barang_stok.satuan_2',
                6 => 'barang_stok.isi_satuan_2',
                7 => 'barang_stok.satuan_3',
                8 => 'barang_stok.isi_satuan_3',
                9 => 'supplier.nama',
                10 => 'barang.harga_beli',
                11 => 'barang.diskon_beli',
                12 => 'barang_harga.harga_jual',
                13 => 'barang_harga.harga_jual_1',
                14 => 'barang_harga.harga_jual_2',
                15 => 'barang_harga.harga_jual_3',
                16 => 'barang_diskon.diskon_jual',
                17 => 'barang_diskon.diskon_qty_1',
                18 => 'barang_diskon.diskon_amount_1',
                19 => 'barang_diskon.diskon_qty_2',
                20 => 'barang_diskon.diskon_amount_2',
                12 => 'barang_diskon.diskon_qty_3',
                22 => 'barang_diskon.diskon_amount_3',
                23 => 'barang_diskon.diskon_qty_4',
                24 => 'barang_diskon.diskon_amount_4',
                25 => 'barang.berat',
                26 => 'barang.omset',
                27 => 'barang.size',
                28 => 'barang.deskripsi',
            );

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');

            $rows = $this->query();

            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('barang.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('supplier.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('barang.kode', 'like', '%'.$input_search.'%');
                });
            }

            $totalData = $rows->count();
            $rows = $rows->offset($start)->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data here
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']                   = $no;
                $nestedData['kode']                 = $item->kode;
                $nestedData['nama']                 = $item->nama;
                $nestedData['stok']                 = $item->stok;
                $nestedData['satuan_1']             = $item->satuan_1;
                $nestedData['satuan_2']             = $item->satuan_2;
                $nestedData['isi_satuan_2']         = $item->isi_satuan_2;
                $nestedData['satuan_3']             = $item->satuan_3;
                $nestedData['isi_satuan_3']         = $item->isi_satuan_3;
                $nestedData['supplier']             = $item->supplier;
                $nestedData['harga_beli']           = $item->harga_beli;
                $nestedData['harga_jual']           = $item->harga_jual;
                $nestedData['harga_jual_1']         = $item->harga_jual_1;
                $nestedData['harga_jual_2']         = $item->harga_jual_2;
                $nestedData['harga_jual_3']         = $item->harga_jual_3;
                $nestedData['diskon_jual']          = $item->diskon_jual;
                $nestedData['diskon_qty_1']         = $item->diskon_qty_1;
                $nestedData['diskon_amount_1']      = $item->diskon_amount_1;
                $nestedData['diskon_qty_2']         = $item->diskon_qty_2;
                $nestedData['diskon_amount_2']      = $item->diskon_amount_2;
                $nestedData['diskon_qty_3']         = $item->diskon_qty_3;
                $nestedData['diskon_amount_3']      = $item->diskon_amount_3;
                $nestedData['diskon_qty_4']         = $item->diskon_qty_4;
                $nestedData['diskon_amount_4']      = $item->diskon_amount_4;
                $nestedData['berat']                = $item->berat;
                $nestedData['omset']                = $item->omset;
                $nestedData['size']                 = $item->size;
                $nestedData['deskripsi']            = $item->deskripsi;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.master-data.barang.edit', $item->id).'" class="btn btn-outline-warning" target="_blank"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.master-data.barang.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    private function query()
    {
        $query = Barang::select(
            'barang.*',
            'barang_stok.stok',
            'barang_stok.satuan_1',
            'barang_stok.satuan_2',
            'barang_stok.isi_satuan_2',
            'barang_stok.satuan_3',
            'barang_stok.isi_satuan_3',
            'barang_harga.harga_jual',
            'barang_harga.harga_jual_1',
            'barang_harga.harga_jual_2',
            'barang_harga.harga_jual_3',
            'barang_diskon.diskon_jual',
            'barang_diskon.diskon_qty_1',
            'barang_diskon.diskon_amount_1',
            'barang_diskon.diskon_qty_2',
            'barang_diskon.diskon_amount_2',
            'barang_diskon.diskon_qty_3',
            'barang_diskon.diskon_amount_3',
            'barang_diskon.diskon_qty_4',
            'barang_diskon.diskon_amount_4',
            'supplier.nama as supplier'
        )->join('barang_stok', 'barang_stok.barang_id', '=', 'barang.id')
        ->join('barang_harga', 'barang_harga.barang_id', '=', 'barang.id')
        ->join('barang_diskon', 'barang_diskon.barang_id', '=', 'barang.id')
        ->leftJoin('supplier', 'supplier.id', '=', 'barang.supplier_id');

        return $query;
    }

    public function getSupplier(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            $input = $request->all();

            if (!empty($input['query'])) {

                $data = Supplier::select(["id", "nama"])
                    ->where("nama", "LIKE", "%{$input['query']}%")
                    ->get();
            } else {

                $data = Supplier::select(["id", "nama"])->get();
            }

            $suppliers = [];

            if (count($data) > 0) {

                foreach ($data as $supplier) {
                    $suppliers[] = array(
                        "id" => $supplier->id,
                        "text" => $supplier->nama,
                    );
                }
            }
            return response()->json($suppliers);
        }

        return response()->json([
            'message' => 'Maaf, anda tidak bisa mengakses'
        ], 403);
    }

    public function exportExcel()
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            $barang = $this->query()->get();

            return Excel::download(new BarangExport($barang),  'list-data-barang-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function printBarcode()
    {
        if (HelpersUser::checkPermission('Edit Barang')) {
            $barang = Barang::select('id', 'kode', 'nama')->get();

            $pdf = PDF::loadview('back.master-data.barang.print-barcode', compact('barang'))->setPaper('A4', 'portrait');

            return $pdf->stream();
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
