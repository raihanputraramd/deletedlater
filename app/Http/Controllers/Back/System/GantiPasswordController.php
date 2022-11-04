<?php

namespace App\Http\Controllers\Back\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function create()
    {
        return view('back.system.ganti-password.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail(auth()->user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Password berhasil diganti');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function checkPassword(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        if ($request->input('password_lama') !== '') {
            if (Hash::check($request->input('password_lama'), $user->password)) {
                die('true');
            }
        }

        die('false');
        // Hash::check($request->input('password_lama'), $user->password);

        // if ($request->input('password') !== '') {
        //     if ($request->input('password')) {
        //         $rule = array('email' => 'required|unique:anggota,email');
        //         $validator = Validator::make($request->all(), $rule);
        //     }
        //     if (!$validator->fails()) {
        //         die('true');
        //     }
        // }
        // die('false');
    }
}
