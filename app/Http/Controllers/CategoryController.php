<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductPrice;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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
        $feature = $request->get('feature');
        $price = $request->get('price');
        $companySearch = $request->get('company');
        $orderBy = $request->get('orderBy');

        $productQ = Product::where('product_line', $category->id)->where('status', 1)->where('show_home', 1);
        $product = [];

        if(!empty($price)){
            $productQ = $productQ->whereIn('price_type', $price);
        }

        if(!empty($companySearch)){
            $productQ = $productQ->whereIn('company', $companySearch);
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
        $productPrice = ProductPrice::all();
        $categoryName = $category->name;

        $featureList = ProductLine::with(['feature', 'feature.sub'])->where('id', $categoryId)->firstOrFail();
        $featureData = $featureList->feature;

        return view('category.index', compact('category', 'categoryName', 'product', 'productPrice', 'url', 'company', 'featureData'));
    }
}
