<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detailProduct(Request $request, $id){

        $starReviewPoint = 3.5;
        $stars = [
            "fullStar" => 0,
            "halfStar" => 0,
            "noneStar" => 0
        ];

        $starCaculate = 5 - $starReviewPoint;
        if(is_int($starCaculate)){
            $stars['fullStar'] = $starReviewPoint;
            $stars['halfStar'] = 0;
            $stars['noneStar'] = $starCaculate;
        }else{
            $stars['fullStar'] = (int)abs($starReviewPoint);
            $stars['noneStar'] = (int)abs($starCaculate);
            $stars['halfStar'] = 5 - $stars['fullStar'] - $stars['noneStar'];
        }

        $detailProduct = Product::with(['productImage.color', 'comment'])->find($id);

        $aryRelatedProd = get_related_product($id);

        return view('product.detail', compact('stars', 'starReviewPoint', 'detailProduct', 'aryRelatedProd'));
    }

    public function productContent(Request $request){
        return view('product.index');
    }

    /**
     * Ajax get image from color and product Id
     *
     * @param [type] $color_id
     * @param [type] $product_id
     * @return json
     */
    public function getImageByColorAndProductId(Request $request)
    {
        $imageUrl = ProductImage::where('color', $request->color_id)->where('product_id', $request->product_id)->first();

        return response()->json(['url' => $request->getSchemeAndHttpHost() . '/' .$imageUrl->image_path]);
    }
}
