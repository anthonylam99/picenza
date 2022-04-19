<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detailProduct(Request $request){
        $colors = [
            [
                "id" => 1,
                "color" => 'Trắng',
                "hex" => '#E5E5E5'
            ],
            [
                "id" => 2,
                "color" => 'Vàng',
                "hex" => '#E7E5D8'
            ],
            [
                "id" => 3,
                "color" => 'Xanh',
                "hex" => '#E1E2DA'
            ],
            [
                "id" => 4,
                "color" => 'Xanh dương',
                "hex" => '#C2C5C2'
            ],
            [
                "id" => 5,
                "color" => 'Đen',
                "hex" => '#5C5C59'
            ]
        ];

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

        return view('product.detail', compact('colors', 'stars', 'starReviewPoint'));
    }

    public function productContent(Request $request){
        return view('product.index');
    }
}
