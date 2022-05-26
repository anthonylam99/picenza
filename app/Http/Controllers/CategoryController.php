<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductCompany;
use App\Models\ProductImage;
use App\Models\ProductLine;
use App\Models\ProductPrice;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function sortAssociativeArrayByKey($array, $key, $direction){

        switch ($direction){
            case "ASC":
                usort($array, function ($first, $second) use ($key) {
                    return $first[$key] <=> $second[$key];
                });
                break;
            case "DESC":
                usort($array, function ($first, $second) use ($key) {
                    return $second[$key] <=> $first[$key];
                });
                break;
            default:
                break;
        }

        return $array;
    }
    public function index(Request $request, $slug = '')
    {
        $url = $request->fullUrl();
        $company = ProductCompany::all();
        $category = ProductLine::where('seo_url', $slug)->firstOrFail();


        $categoryId = $category->id;
        $parentId = $category->parent;
        $feature = $request->get('feature');
        $price = $request->get('price');
        $companySearch = $request->get('company');
        $orderBy = $request->get('orderBy');
        $prdColor = $request->get('color');

        if($categoryId == $parentId){
            $line = ProductLine::where('parent', $parentId)->pluck('id');
            $productQ = DB::table('product');
            $productQ = $productQ->where(function ($q) use ($line) {
                foreach($line as $value){
                    $q->orWhere('product_line', 'LIKE', '%'.$value.'%');
                }
            });

            $productQ = $productQ->where('status', 1)->where('show_home',1);
        }else{
            $productQ = Product::where('product_line', 'LIKE', '%'.$category->id.'%')->where('status', 1)->where('show_home', 1);
        }
        $product = [];

        if(!empty($price)){
            $productQ = $productQ->whereIn('price_type', $price);
        }

        if(!empty($companySearch)){
            $productQ = $productQ->whereIn('company', $companySearch);
        }

        if(!empty($prdColor)){
            $productQ = $productQ->whereHas('productImage', function($q) use ($prdColor){
                return $q->whereIn('color', $prdColor);
            });
        }


        if (!empty($feature)) {
            foreach ($feature as $value) {
                $item = $productQ->whereRaw("CONCAT(',', feature, ',') LIKE '%," . $value . ",%' ")->get();
                foreach ($item as $value) {
                    array_push($product, $value);
                }
            }
            $product = array_unique($product);
            if(!empty($orderBy)){
                if($orderBy == 2){
                    $product = $this->sortAssociativeArrayByKey($product, 'id', 'DESC');
                }
                if($orderBy == 3){
                    $product = $this->sortAssociativeArrayByKey($product, 'price', 'ASC');
                }
                if($orderBy == 4){
                    $product = $this->sortAssociativeArrayByKey($product, 'price', 'DESC');
                }
            }
        }else{
            if(!empty($orderBy)){
                if($orderBy == 2){
                    $productQ = $productQ->orderBy('id', 'desc');
                }
                if($orderBy == 3){
                    $productQ = $productQ->orderBy('price', 'asc');
                }
                if($orderBy == 4){
                    $productQ = $productQ->orderBy('price', 'desc');
                }
            }
            $product = $productQ->get();
        }

        $idProduct = collect($product)->map(function($item){
            return $item->id;
        })->toArray();

        $color = [];
        $arrColor = ProductColor::pluck('color', 'id');
        $productColor = ProductImage::whereIn('product_id', $idProduct)->get();
        if(!empty($productColor)){
            foreach($productColor as $value){
               $color[$value->color] = $value->color;
            }
        }
        $color = array_unique($color);
        $color = collect($color)->map(function ($item) use ($arrColor) {
            return isset($arrColor[$item]) ? $arrColor[$item] : '';
        });

        $color = collect($color)->filter(function($item){
            return !empty($item);
        });


        $productPrice = ProductPrice::all();
        $categoryName = $category->name;

        $featureList = ProductLine::with(['feature', 'feature.sub'])->where('id', $categoryId)->firstOrFail();
        $featureData = $featureList->feature;

        return view('category.index', compact('category', 'categoryName', 'product', 'productPrice', 'url', 'company', 'featureData', 'color'));
    }
}
