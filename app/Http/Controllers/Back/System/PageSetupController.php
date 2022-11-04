<?php

namespace App\Http\Controllers\Back\System;

use App\Helpers\User as HelpersUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageSetupController extends Controller
{
    public function create()
    {
        return view('back.system.page-setup.create');
    }
}
