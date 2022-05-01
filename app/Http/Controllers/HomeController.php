<?php

namespace App\Http\Controllers;

use App\Models\ProductLine;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        $category = ProductLine::all();
        return view('home.index', compact('category'));
    }
}
