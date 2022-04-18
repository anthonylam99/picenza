<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categoryName = 'Chậu rửa';

        return view('category.index', compact('categoryName'));
    }
}
