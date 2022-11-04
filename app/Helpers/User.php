<?php

namespace App\Helpers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class User {
	public static function uploadImage(Request $request, $typeRequest, $storeTo)
    {
        $fileNameWithExt = $request->file($typeRequest)->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $fileExtension = $request->file($typeRequest)->getClientOriginalExtension();
        $fileNameToStore = preg_replace('/\s+/', '-', $fileName) . '-' . time() . '.' . $fileExtension;
        $path = $request->file($typeRequest)->move($storeTo, $fileNameToStore);
        if($fileNameToStore != null) {
            return $fileNameToStore;
        } else {
            return "noimage.png";
        }
    }

    public static function checkPermission($modul)
    {
        $check = ModelsUser::findOrFail(auth()->user()->id)->whereHas('grup', function ($query) use ($modul) {
            $query->whereHas('modul', function ($query) use ($modul) {
                return $query->where('nama', $modul);
            });
        })->exists();

        if ($check) {
            return true;
        }

        return false;
    }
}