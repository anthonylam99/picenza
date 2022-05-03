<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\MenuLocation;
use App\Models\Contact;
use App\Models\Orders;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductCompany;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductLine;
use App\Models\ProductPrice;
use App\Models\ProductReliability;
use App\Models\ProductShape;
use App\Models\ProductTechnology;
use App\Models\ProductType;
use Harimayco\Menu\Models\MenuItems;
use Harimayco\Menu\Models\Menus;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function galery(Request $request)
    {
        return view('admin.galery');
    }

    public function getProductLine(Request $request, $id = null)
    {
        $data = ProductLine::where('company_id', $id)->get();
        return response()->json($data);
    }

    public function getProductType(Request $request, $id = null, $id2 = null)
    {
        $data = ProductType::where([
            'company_id' => $id,
            'product_line_id' => $id2
        ])->get();
        return response()->json($data);
    }

    public function getProductFeature(Request $request, $id = null)
    {
        $feature = ProductLine::with(['feature', 'feature.sub'])->where('id', $id)->first();
        return response()->json($feature);
    }


    public function productList(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $product = Product::with([
                'productType',
                'companyName'
            ])
                ->whereHas(
                    'productType', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('companyName', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('price', $query)
                ->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $product = Product::with(['productType', 'companyName'])->paginate(10);
//            return response()->json($product);
        }

        return view('admin.product.list', compact('product'));
    }

    public function productType(Request $request)
    {
        $productType = ProductType::paginate(10);

        return view('admin.product.type', compact(['productType']));
    }

    public function addProductType(Request $request)
    {

    }

    public function addProduct(Request $request)
    {
        $productType = ProductType::all();
        $company = ProductCompany::all();
        $productShape = ProductShape::all();
        $productTechnology = ProductTechnology::all();
        $productLine = ProductLine::where('status', 1)->get();
        $productReliability = ProductReliability::all();
        $feature = ProductFeature::whereHas('sub')->get();

        return view('admin.product.add', compact(
            'productType',
            'company',
            'productShape',
            'productTechnology',
            'productLine',
            'productReliability',
            'feature'
        ));
    }

    public function addProductPost(Request $request)
    {
//        if(empty($request->feature)){
//            return redirect()->back()->with('error', 'Sản phẩm chưa có tính năng');
//        }
        $data = collect($request)->toArray();

        $productTechnology = ProductTechnology::all();

        $options = new Options;
        $slug = $options->create_slug($request->get('product_name'));
        $price = str_replace(",", '', $request->get('price'));

        $priceData = ProductPrice::all();
        $priceType = [];

        foreach ($priceData as $value) {
            if ($price >= $value['min_price'] && $price <= $value['max_price'] ) {
                array_push($priceType, $value['id']);
            }
        }

        $priceType = end($priceType);


        $feature = '';

        $i = 0;
        $featureData = $request->get('feature');
        if (!empty($featureData)) {
            foreach ($featureData as $value) {
                $i++;
                if ($i < count($featureData)) {
                    $feature .= $value . ',';
                } else {
                    $feature .= $value;
                }
            }
        }

        $dataInsert = [
            'name' => $request->get('product_name'),
            'slug' => $slug,
            'price' => $price,
            'sale_price' => str_replace(",", '', $request->get('sale_price')),
            'sale_percent' => str_replace(",", '', $request->get('sale_percent')),
            'company' => $request->get('company'),
            'product_type' => $request->get('product_type'),
            'product_line' => $request->get('product_line'),
            'price_type' => $priceType,
            'shape_type' => $request->get('shape_type'),
            'technology_type' => $request->get('technology_type'),
            'reliability_type' => $request->get('reliability_type'),
            'description' => $request->get('description', ''),
            'feature' => $feature,
            'avatar_path' => $request->get('img_avatar_path'),
            'is_bestseller' => $request->get('is_bestseller') ?? 0,
            'seo_title' => $request->get('seo_title'),
            'seo_description' => $request->get('seo_description'),
            'seo_keyword' => $request->get('seo_keyword'),
            'seo_robots' => $request->get('seo_robots')
        ];


        if (!isset($data['id'])) {
            $product = Product::create($dataInsert);
        } else {
            $update = Product::where('id', $data['id'])->update($dataInsert);
            $product = Product::find($data['id']);

        }

        $arrImageColor = [];
        $productId = $product->id;
        foreach ($data as $key => $value) {
            if (strpos($key, 'image') !== false) {

                $index = explode('image', $key);
                $index = $index[1];
                $arr = [];
                $arr['image_path'] = $request->get('image' . $index);
                $arr['product_id'] = $product->id;
                $arr['price'] = $request->get('price'.$index);

                $arrColor = [];
                $color = $request->get('color' . $index);
                $hex = $request->get('hex' . $index);
                $insert = ProductColor::updateOrCreate(
                    ['color' => $color],
                    [
                        'color' => $color,
                        'hex' => $hex,
                    ]
                );
                $arr['color'] = $insert->id;
                array_push($arrImageColor, $arr);
            }

            if (strpos($key, 'del-image') !== false) {
                $arr = [
                    'color' => $value,
                    'product_id' => $productId
                ];
                ProductImage::where($arr)->delete();
            }

            if(!empty($arr['image_path'])){
                if (!empty($arrImageColor)) {
                    foreach ($arrImageColor as $value) {
                        ProductImage::updateOrCreate(
                            [
                                'product_id' => $value['product_id'],
                                'color' => $value['color'],
                            ],
                            [
                                'product_id' => $value['product_id'],
                                'color' => $value['color'],
                                'image_path' => $value['image_path'],
                                'price' => $value['price']
                            ]
                        );
                    }
                }
            }
        }


        return redirect()->route('admin.product.edit', ['id' => $productId])->with('success', 'Cập nhật thành công');
    }


    public function editProduct(Request $request, $id)
    {
        $product = Product::with([
            'company',
            'productType',
            'productLine',
            'priceType',
            'shapeType',
            'technologyType',
            'reliabilityType',
            'productImage.color',
        ])->findOrFail($id);

        $featureList = explode(',', $product->feature);

        $productType = ProductType::all();
        $company = ProductCompany::all();
        $productShape = ProductShape::all();
        $productTechnology = ProductTechnology::all();
        $productLine = ProductLine::where('status', 1)->get();
        $productReliability = ProductReliability::all();
        $featureData = ProductLine::with(['feature', 'feature.sub'])->where('id', $product->product_line)->first();
        $feature = $featureData->feature;

        $product = collect($product)->toArray();

        return view('admin.product.edit', compact(
            'product',
            'productType',
            'company',
            'productShape',
            'productTechnology',
            'productLine',
            'productReliability',
            'feature',
            'featureList'
        ));
    }

    public function delProduct(Request $request, $id = null)
    {
        $product = Product::findOrFail($id);
        $product->delete();


        return back()->with(['success_flash' => 'Xoá thành công']);
    }

    public function menu(Request $request)
    {
        if ($request->method() == 'POST') {
            $idmenu = $request->get('idmenu');
            if(!empty($request->get('label'))){
                $url = $request->get('url');
                $label = $request->get('label');
                $this->addMenu($idmenu, $label, $url);
            }
            if($request->has('label_product')){
                $labelProduct = $request->get('label_product');
                foreach ($labelProduct as $value) {
                    $data = ProductLine::find($value);
                    if (!empty($data)) {
                        $arr = [
                            'labelmenu' => $data->name,
                            'linkmenu' => $data->url,
                            'idmenu' => $idmenu
                        ];

                        $this->addMenu($arr['idmenu'], $arr['labelmenu'], $arr['linkmenu']);
                    }
                }
            }
            if($request->has('posts')){
                $posts = $request->get('posts');
                foreach ($posts as $value) {
                    $data = Post::find($value);
                    if (!empty($data)) {
                        $arr = [
                            'labelmenu' => $data->title,
                            'linkmenu' => $data->url,
                            'idmenu' => $idmenu
                        ];

                        $this->addMenu($arr['idmenu'], $arr['labelmenu'], $arr['linkmenu']);
                    }
                }
            }
            if($request->has('pages')){
                $pages = $request->get('pages');
                foreach ($pages as $value) {
                    $data = Post::find($value);
                    if (!empty($data)) {
                        $arr = [
                            'labelmenu' => $data->title,
                            'linkmenu' => $data->url,
                            'idmenu' => $idmenu
                        ];

                        $this->addMenu($arr['idmenu'], $arr['labelmenu'], $arr['linkmenu']);
                    }
                }
            }
            if($request->has('location')){
                $location = $request->get('location');
                $arr = [
                    'menu_id' => $idmenu,
                    'location' => $location
                ];
                $find = MenuLocation::where('menu_id', $idmenu)->get();

                if(!empty(collect($find)->toArray())){
                    MenuLocation::where('location', $location)->update([
                        'menu_id' => $idmenu
                    ]);
                }else{
                    MenuLocation::create($arr);
                }
            }
        }
        return view('admin.menu');
    }

    public function addMenu($idmenu, $label, $link)
    {

        $menuitem = new MenuItems();
        $menuitem->label = $label;
        $menuitem->link = $link;
        if (config('menu.use_roles')) {
            $menuitem->role_id = request()->input("rolemenu") ? request()->input("rolemenu") : 0;
        }
        $menuitem->menu = $idmenu;
        $menuitem->sort = MenuItems::getNextSortRoot($idmenu);
        $menuitem->save();

    }

    public function menuList(Request $request)
    {

        $menu = DB::table('admin_menus')->paginate(10);

        return view('admin.menu.list', compact('menu'));
    }

    /**
     * Update status product
     *
     * @param Request $request
     * @return void
     */
    public function updateStatusProd(Request $request)
    {
        $update = Product::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }

    /**
     * Get list order
     *
     * @return void
     */
    public function orderList (Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $aryOrder = Orders::with('user')
            ->where('address', 'like', '%' . $query . '%')
            ->orWhere('note', 'like', '%' . $query . '%')
            ->whereHas(
                'user', function ($q) use ($query) {
                $q->where('email', 'like', '%' . $query . '%');
            })
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $aryOrder = Orders::with('user')->paginate(10);
        }

        return view('admin.order.list', compact('aryOrder'));
    }

    /**
     * Get detail order
     *
     * @param [type] $id
     * @return void
     */
    public function orderDetail($id)
    {
        $aryProd = [];
        $order = Orders::find($id);
        foreach ($order->item as $key => $prod) {
            $aryProd[] = get_product_by_prod_id_and_color($prod['product_id'], $prod['color_id']);
            $aryProd[$key]['qty'] = $prod['qty'];
        }

        return view('admin.order.detail', compact('aryProd', 'order'));
    }

    /**
     * Update order status
     *
     * @param Request $request
     * @return void
     */
    public function updateOrder(Request $request)
    {
        $request->type == 1 ? $message = 'Xác nhận đơn hàng thành công' : $message = 'Hủy đơn hàng thành công';
        $order = Orders::find($request->id);
        $order->update([
            'payment_status' => $request->type,
        ]);

        return response()->json(['message' => $message]);
    }

    /**
     * Get list contact admin
     *
     * @return void
     */
    public function contactList(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $aryContact = Contact::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
            ->orWhere('feedback', 'like', '%' . $query . '%')
            ->orWhere('career', 'like', '%' . $query . '%')
            ->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $aryContact = Contact::paginate(10);
        }

        return view('admin.contact.list', compact('aryContact'));
    }

    /**
     * Get detail contact
     *
     * @param [type] $id
     * @return void
     */
    public function getDetailContact($id)
    {
        $contact = Contact::find($id);

        return view('admin.contact.detail', compact('contact'));
    }

    /**
     * Update show home product
     *
     * @param Request $request
     * @return void
     */
    public function updateStatusHome(Request $request){
        $update = Product::where('id', $request->get('id'))->update([
            'show_home' => $request->show_home
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
}
