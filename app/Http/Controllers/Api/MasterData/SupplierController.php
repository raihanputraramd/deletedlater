<?php

namespace App\Http\Controllers\Api\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function getSupplier()
    {
        $supplier = Supplier::select('id', 'nama', 'email', 'kode', 'diskon')->get();

        return response()->json($supplier);
    }
}
