<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index() 
    {
        return view('admin.rank.index');
    }
}
