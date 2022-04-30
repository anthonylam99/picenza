<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
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

        $feature = ProductFeature::with('productType')
            ->whereHas('productType', function ($q) use ($id) {
                return $q->where('id', $id);
            })
            ->whereHas('productType.productLine')
            ->whereHas('productType.company')
            ->get();
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
        $productLine = ProductLine::all();
        $productReliability = ProductReliability::all();

        return view('admin.product.add', compact(
            'productType',
            'company',
            'productShape',
            'productTechnology',
            'productLine',
            'productReliability'
        ));
    }

    public function addProductPost(Request $request)
    {
//        dd($request->all());
//        if(empty($request->feature)){
//            return redirect()->back()->with('error', 'Sản phẩm chưa có tính năng');
//        }
        $data = collect($request)->toArray();

        $productTechnology = ProductTechnology::all();

        $options = new Options;
        $slug = $options->create_slug($request->get('product_name'));
        $price = str_replace(",", '', $request->get('price'));

        $priceData = ProductPrice::all();
        $priceType = '';

        foreach ($priceData as $value) {
            if ($price >= $value['min_price'] && $price <= $value['max_price']) {
                $priceType = $value['id'];
            }
        }

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
            'avatar_path' => $request->get('img_avatar_path')
        ];


        if (!isset($data['id'])) {
            $product = Product::updateOrCreate(
                ['name' => $request->get('product_name')],
                $dataInsert
            );
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

                $arrColor = [];
                $color = $request->get('color' . $index);
                $hex = $request->get('hex' . $index);
                $insert = ProductColor::updateOrCreate(
                    ['color' => $color],
                    [
                        'color' => $color,
                        'hex' => $hex
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

        }

        if (!empty($arrImageColor)) {
            foreach ($arrImageColor as $value) {
                ProductImage::updateOrCreate(
                    [
                        'product_id' => $value['product_id'],
                        'color' => $value['color']
                    ],
                    [
                        'product_id' => $value['product_id'],
                        'color' => $value['color'],
                        'image_path' => $value['image_path']
                    ]
                );
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
        $productLine = ProductLine::all();
        $productReliability = ProductReliability::all();
        $feature = ProductFeature::select('product_feature.name')->join('product_type', 'product_type', '=', 'product_type.id')
            ->join('product_line', 'product_line_id', '=', 'product_line.id')
            ->join('product_company', 'product_type.company_id', '=', 'product_company.id')
            ->get();
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

        $menu = DB::table('admin_menus')->get();

        return view('admin.menu.list', compact('menu'));
    }
}
