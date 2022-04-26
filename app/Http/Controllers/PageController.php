<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function list(Request $request){
        return view('admin.page.list');
    }

    public function add(Request $request){
        return view('admin.page.add');
    }
}
