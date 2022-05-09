<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Orders;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Cart;
use Session;

class ProductController extends Controller
{
    public function searchProductApi(Request $request){
        $product = Product::where('name', 'LIKE', '%'.$request->get('query').'%')->get();

        return response()->json($product);
    }

    public function detailProduct(Request $request, $slug = null){
        $stars = [
            "fullStar" => 0,
            "halfStar" => 0,
            "noneStar" => 0
        ];
        $product = Product::where('slug', $slug)->firstOrFail();
        $id = $product->id;
        $category = ProductLine::findOrFail($product->product_line);

        $averageStar = calculateAverageReview($id, 'rating');
        $averageQuality = calculateAverageReview($id, 'count_quality');
        $averageWorth = calculateAverageReview($id, 'count_worth');

        $detailProduct = Product::with(['productImage.color'])->findOrFail($id);

        $aryComments = $detailProduct->comment()->where('status', 1)->orderBy('id', 'DESC')->paginate(3);

        $countCommentNotRating = $detailProduct->comment()->where('status', 1)->whereNull('rating')->orderBy('id', 'DESC')->count();

        $aryCountStar = Comments::select([\DB::raw('COUNT(*) as count_star'), 'rating'])
                                ->where('product_id', $id)
                                ->where('status', 1)
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
            'averageStar',
            'countCommentNotRating',
            'category'
        ));
    }

    public function productContent(Request $request, $slug = null){
        $category = ProductLine::where('seo_url', $slug)->firstOrFail();
        $feature = ProductFeature::where('product_line', $category->id)->get('id');
        $product = Product::where('product_line', $category->id)->inRandomOrder()->limit(5)->get();

        $ids = [];
        foreach($feature as $value){
            array_push($ids, $value->id);
        }
        $favourite = SubCategory::where('favourite', 1)->whereIn('id_category_parent', $ids)->where('status' , 1)->get();
        $subNormalCate = SubCategory::whereIn('id_category_parent', $ids)->where('status' , 1)->get();

        $aryBestSeller = Product::with('productImage.color')->where('is_bestseller', 1)->where('product_line', $category->id)->get();

        return view('product.index', compact('category', 'favourite', 'subNormalCate', 'aryBestSeller', 'product'));
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

       $products = Product::whereIn('id', $request->product_id)->get()->keyBy('id');

       foreach ($request->product_id as $key => $value) {
            $productImage = ProductImage::where('product_id', $value)->where('color', $request->color_id[$key])->first();
            $price = $productImage ? $productImage->price : $products[$value]->price;

            $aryProd[] = [
                'product_id'    => $value,
                'product_name'  => $products[$value]->name ?? "",
                'product_price' => $price,
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

    /**
     * Action search product
     *
     * @param Request $request
     * @return void
     */
    public function searchProduct(Request $request)
    {
        $keyWord =  $request->search;
        $aryProduct = Product::where('name', 'like', '%'.$keyWord.'%')->where('status', 1)->where('show_home', 1)->get();

        $productPrice = ProductPrice::all();
        $featureData = ProductFeature::with('sub')->get();
        $company = ProductCompany::all();

        return view('product.search-result', compact('aryProduct', 'keyWord', 'featureData', 'productPrice', 'company'));
    }

    public function compareProduct(Request $request){
        $product = $request->get('product', []);
        $feature = [];
        if(!empty($product)){
            $product = Product::whereIn('id', $product)->where('status', 1)->get();

            foreach($product as $item){
                $dataFeature = explode(',', $item->feature);
                $itemData = SubCategory::whereIn('id',$dataFeature)->get();

                $feature[$item->id] = $itemData;
            }
        }
        return view('product.compare', compact('product', 'feature'));
    }
}
