<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductLine;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Cart;
use Session;

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

    public function productContent(Request $request, $slug = null){
        $category = ProductLine::where('seo_url', $slug)->firstOrFail();
        $feature = ProductFeature::where('product_line', $category->id)->get('id');

        $ids = [];
        foreach($feature as $value){
            array_push($ids, $value->id);
        }
        $favourite = SubCategory::where('favourite', 1)->whereIn('id_category_parent', $ids)->where('status' , 1)->get();
        $subNormalCate = SubCategory::where('favourite', '!=', 1)->whereIn('id_category_parent', $ids)->where('status' , 1)->get();

        $aryBestSeller = Product::with('productImage.color')->where('is_bestseller', 1)->where('product_line', $category->id)->get();

        return view('product.index', compact('category', 'favourite', 'subNormalCate', 'aryBestSeller'));
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

        return response()->json([
            'url' => $imageUrl->image_path,
            'price' => $imageUrl->price ?? 0
        ]);
    }

    /**
     * Get view cart
     *
     * @return void
     */
    public function cart()
    {
        return view('product.cart');
    }

    /**
     * Add item to cart
     *
     * @param Request $request
     * @return void
     */
    public function addToCart(Request $request)
    {
        $options = [
            'options' => [

                'image' => $request->image,
                'color' => $request->color,
            ]
        ];
        Cart::add(array_merge($request->all(), $options));

        return redirect()->route('product.cart');
    }

    /**
     * Update qty card
     *
     * @param Request $request
     * @return void
     */
    public function updateQtyCart(Request $request)
    {
        Cart::update($request->rowId, $request->qty);

        return response()->json(['message' => 'success']);
    }

    /**
     * Remove item from cart
     *
     * @param Request $request
     * @return void
     */
    public function removeItemCart(Request $request)
    {
        Cart::remove($request->rowId);
        return response()->json(['message' => 'success']);
    }

    /**
     * Get district by province
     *
     */

    public function district(Request $request)
    {
        $provinceId = $request->get("province_id");
        return view('partials.district', compact('provinceId'));
    }

    /**
     * Get district by province
     *
     */

    public function ward(Request $request)
    {
        $districtId = $request->get("district_id");
        return view('partials.ward', compact('districtId'));
    }

    /**
     * Save order info
     *
     * @param Request $request
     * @return void
     */
    public function saveOrder(Request $request)
    {
        $user = action_create_user([
            'full_name' => $request->user_name,
            'email'     => $request->email,
            'phone'     => $request->phone
        ]);

       $aryProd = [];

       foreach ($request->product_id as $key => $value) {
            $aryProd[] = [
                'product_id'    => $value,
                'color_id'      => $request->color_id[$key],
                'qty'           => $request->qty[$key],
            ];
       }


        $order = Orders::create([
            'user_id'       => $user->id,
            'province_id'   => $request->province_id,
            'district_id'   => $request->district_id,
            'address'       => $request->address ,
            'item'          => $aryProd,
            'note'          => $request->note ,
            'total_price'   => $request->total_price ,

        ]);

        Cart::destroy();

        Session::flash('order-success', 'Đặt hàng thành công'); 

        return redirect()->route('index');
    }
}
