<?php

namespace App\Http\Controllers\Back\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetunjukController extends Controller
{
    public function index()
    {
        return view('back.menu.petunjuk.index');
    }
}
