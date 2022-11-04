<?php

namespace App\Http\Controllers\Back\Transaksi;

use App\Exports\Transaksi\BankTransferExport;
use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\BankTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BankTransferController extends Controller
{
    public function index()
    {
        if (HelpersUser::checkPermission('Edit Bank Transfer')) {
            return view('back.transaksi.bank-transfer.index');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function create()
    {
        if (HelpersUser::checkPermission('Tambah Bank Transfer')) {
            return view('back.transaksi.bank-transfer.create');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function store(Request $request)
    {
        if (HelpersUser::checkPermission('Tambah Bank Transfer')) {
            DB::beginTransaction();
            try {
                $bankTransfer                  = new BankTransfer();
                $bankTransfer->transaksi       = $request->transaksi;
                if($request->transaksi == "Masuk") {
                    $bankTransfer->jumlah_masuk = $request->jumlah;
                }
                if($request->transaksi == "Keluar") {
                    $bankTransfer->jumlah_keluar = $request->jumlah;
                }
                $bankTransfer->keterangan      = $request->keterangan;
                $bankTransfer->user_id         = auth()->user()->id;
                $bankTransfer->save();

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
        if (HelpersUser::checkPermission('Edit Bank Transfer')) {
            $bankTransfer = BankTransfer::findOrFail($id);

            return view('back.transaksi.bank-transfer.edit', compact('bankTransfer'));
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }

    public function update(Request $request, $id)
    {
        if (HelpersUser::checkPermission('Edit Bank Transfer')) {
            DB::beginTransaction();
            try {
                $bankTransfer                  = BankTransfer::findOrFail($id);
                $bankTransfer->transaksi       = $request->transaksi;
                if($request->transaksi == "Masuk") {
                    $bankTransfer->jumlah_masuk  = $request->jumlah;
                    $bankTransfer->jumlah_keluar = null;
                }
                if($request->transaksi == "Keluar") {
                    $bankTransfer->jumlah_keluar = $request->jumlah;
                    $bankTransfer->jumlah_masuk  = null;
                }
                $bankTransfer->keterangan      = $request->keterangan;
                $bankTransfer->save();

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
        if (HelpersUser::checkPermission('Edit Bank Transfer')) {
            DB::beginTransaction();
            try {
                $bankTransfer = BankTransfer::findOrFail($id);
                $bankTransfer->delete();

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
        if (HelpersUser::checkPermission('Edit Bank Transfer')) {
            $columns = array(
                0 => 'bank_transfer.id',
                1 => 'bank_transfer.transaksi',
                2 => 'bank_transfer.jumlah_masuk',
                3 => 'bank_transfer.jumlah_keluar',
                4 => 'bank_transfer.keterangan',
                5 => 'bank_transfer.created_at',
                6 => 'users.nama',
            );

            $limit = $request->input('length');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $input_search = $request->input('search.value');

            $rows = BankTransfer::select(
                'bank_transfer.id',
                'bank_transfer.transaksi',
                'bank_transfer.jumlah_masuk',
                'bank_transfer.jumlah_keluar',
                'bank_transfer.keterangan',
                'bank_transfer.created_at',
                'users.nama as user',
            )->leftJoin('users', 'users.id', '=', 'bank_transfer.user_id');

            //Search Section
            if (!empty($input_search)) {
                $rows->where(function($query) use ($input_search) {
                    return $query
                        ->where('bank_transfer.transaksi', 'like', '%'.$input_search.'%')
                        ->orWhere('users.nama', 'like', '%'.$input_search.'%')
                        ->orWhere('bank_transfer.keterangan', 'like', '%'.$input_search.'%');
                });
            }

            $totalData = $rows->count();
            $rows = $rows->limit($limit)->orderBy($order, $dir)->get();

            //Customize your data herem
            $data = array();
            $no = 0;
            foreach ($rows as $item) {
                $no++;
                $nestedData['no']         = $no;
                $nestedData['transaksi']  = $item->transaksi;
                $nestedData['tanggal']    = Carbon::parse($item->created_at)->isoformat('d MMMM Y');
                $nestedData['amount']     = $item->amount();
                $nestedData['keterangan'] = $item->keterangan;
                $nestedData['user']       = $item->user;
                $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'.route('back.transaksi.bank-transfer.edit', $item->id).'" class="btn btn-outline-warning btn-page" data-title="Edit Bank Transfer"><i class="fa fa-edit"></i></a>
                    <a href="'.route('back.transaksi.bank-transfer.destroy', $item->id).'" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
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

    public function pdf(Request $request)
    {
        $bankTransfer = BankTransfer::select(
            'bank_transfer.id',
            'bank_transfer.transaksi',
            'bank_transfer.jumlah_masuk',
            'bank_transfer.jumlah_keluar',
            'bank_transfer.keterangan',
            'bank_transfer.created_at',
            'users.nama as user',
        )->leftJoin('users', 'users.id', '=', 'bank_transfer.user_id')->get();

        $pdf = PDF::loadview('back.transaksi.bank-transfer.pdf', compact('bankTransfer'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function exportExcel(Request $request)
    {
        if (HelpersUser::checkPermission('Edit Bank Transfer')) {
            $bankTransfer = BankTransfer::select(
                'bank_transfer.id',
                'bank_transfer.transaksi',
                'bank_transfer.jumlah_masuk',
                'bank_transfer.jumlah_keluar',
                'bank_transfer.keterangan',
                'bank_transfer.created_at',
                'users.nama as user',
            )->leftJoin('users', 'users.id', '=', 'bank_transfer.user_id')->get();

            return Excel::download(new BankTransferExport($bankTransfer),  'data-bank-transfer-'. Carbon::now()->format('d-m-Y') .'.xlsx');
        }
        return redirect()->route('back.home.index')->with('permission', 'Permission');
    }
}
