<?php

namespace App\Http\Controllers\Back\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('back.menu.client.index');
    }
}
