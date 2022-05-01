<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detailProduct(Request $request, $id){
        $stars = [
            "fullStar" => 0,
            "halfStar" => 0,
            "noneStar" => 0
        ];

        $averageStar = calculateAverageReview($id, 'rating');
        $averageQuality = calculateAverageReview($id, 'count_quality');
        $averageWorth = calculateAverageReview($id, 'count_worth');

        $detailProduct = Product::with(['productImage.color'])->find($id);

        $aryComments = $detailProduct->comment()->orderBy('id', 'DESC')->paginate(3);

        $aryCountStar = Comments::select([\DB::raw('COUNT(*) as count_star'), 'rating'])
                                ->where('product_id', $id)
                                ->groupBy('rating')
                                ->get()
                                ->toArray();

        $starReviewPoint = $detailProduct->rating;

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

        $aryRelatedProd = get_related_product($id);

        // Recent view
        $productListNew[$detailProduct->id] = [
            'id'            => $detailProduct->id,
            'name'          => $detailProduct->name,
            'price'         => $detailProduct->price,
            'sale_price'    => $detailProduct->sale_price,
            'sale_percent'  => $detailProduct->sale_percent,
            'productMedias' => !empty($detailProduct->productImage[0]) ? asset($detailProduct->productImage[0]->image_path, '') : asset('images/product/product_demo_2.png'),
        ];

        $productList = [];
        $cookieProduct = 'recentlyProduct';
        if (isset($_COOKIE[$cookieProduct])) {
            $productList = json_decode($_COOKIE[$cookieProduct]);
            foreach ($productList as $pro) {
                $productListNew[$pro->id] = [
                    'id'            => $pro->id,
                    'name'          => $pro->name,
                    'price'         => $pro->price,
                    'sale_price'    => $pro->sale_price,
                    'sale_percent'  => $pro->sale_percent,
                    'productMedias' => !empty($pro->productImage[0]) ? asset($pro->productImage[0]->image_path, '') : asset('images/product/product_demo_2.png'),
                ];
            }
        
            setcookie($cookieProduct, json_encode($productListNew), time() + (86400 * 90), '/');
        } else {
            setcookie($cookieProduct, json_encode($productListNew), time() + (86400 * 90), '/');
        }

       
        return view('product.detail', compact(
            'stars',
            'starReviewPoint',
            'detailProduct',
            'aryRelatedProd',
            'productList',
            'aryCountStar',
            'aryComments',
            'averageWorth',
            'averageQuality',
            'averageStar'
        ));
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
