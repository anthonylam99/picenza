<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLine;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $slug = ''){

//        $url = $request->url();
//        $parameter = collect($request->request)->toArray();
//
//        $param = '';
//
//        if(empty($parameter)){
//            $url .= "?";
//        }else{
//            foreach($parameter as $key => $value){
//                if(is_array($value)){
//                    $duplicate = array_unique( array_diff_assoc( $value, array_unique( $value ) ) );
//
//                    foreach($value as $i){
//                        if(!in_array($i, $duplicate)){
//                            $param .= $key."[]=".$i.'&';
//                        }
//                    }
//                }
//            }
//            $url .= "?".$param;
//        }

        $url = $request->fullUrl();
        $category = ProductLine::where('slug', $slug)->firstOrFail();
        $product = Product::with([
            'productImage'
        ])->where('product_line', $category->id)->get();

        $productPrice = ProductPrice::all();

        $categoryName = $category->name;

        return view('category.index', compact('category', 'categoryName', 'product', 'productPrice', 'url'));
    }
}
