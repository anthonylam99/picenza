<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\ProductFeature;
use App\Models\ProductLine;
use App\Models\ProductType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function Aws\map;

class ProductFeatureController extends Controller
{
    public function makeFavourite(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');

        $update = SubCategory::where('id', $id)->update([
            'favourite' => $status
        ]);

        if($update){
            return response()->json(['message' => 'ok']);
        }

    }
    public function addSubCategory(Request $request){
        $options = new Options;
        $slug = $options->create_slug($request->get('name'));

        $productFeature = ProductFeature::findOrFail($request->get('parent'));
        $parent = ProductLine::where('id',$productFeature->product_line)->firstOrFail();
        $create = SubCategory::create([
            'name' => $request->get('name'),
            'id_category_parent' => $request->get('parent'),
            'slug' => $slug
        ]);

        if($create){
            SubCategory::where('id', $create->id)->update([
                'url' => collect($request->server)['HTTP_ORIGIN'].'/danh-muc/'.$parent->seo_url.'?feature[]='.$create->id
            ]);
        }

        if($create){
            $data = SubCategory::orderBy('id', 'desc')->first();

            return response()->json(['message' => 'ok', 'data' => $data]);
        }
    }
    public function listProductFeature(Request $request)
    {
        $feature = ProductFeature::all();

        return view('admin.product.feature.list', compact('feature'));
    }

    public function addProductFeature(Request $request)
    {
        $productType = ProductType::whereHas('company')->whereHas('productLine')->get();

        return view('admin.product.feature.add', compact('productType'));
    }

    public function addPostProductFeature(Request $request)
    {
        $name = $request->get('name');
        $productLine = $request->get('category_id');
//        $favourite = $request->get('favourite') === 'on' ? 1 : 0;
        $avatar = $request->get('img_avatar_path');
        $description = $request->get('description');
        if($request->has('id')){
            $id = $request->get('id');
            $update = ProductFeature::where('id', $id)->update([
                'name' => $name,
                'product_line' => $productLine,
                'avatar' => $avatar,
//                'favourite' => $favourite,
                'description' => $description
            ]);
            if($update){
                return redirect()->route('admin.product.feature.edit', ['id' => $id]);
            }
        }else{
            $create = ProductFeature::create([
                'name' => $name,
                'product_line' => $productLine,
                'avatar' => $avatar,
//                'favourite' => $favourite,
                'description' => $description
            ]);

            if($create){
                return redirect()->route('admin.product.feature.edit', ['id' => $create->id]);
            }
        }
    }

    public function editProductFeature(Request $request, $id = null)
    {
        $feature = ProductFeature::findOrFail($id);
        $category = ProductLine::all();

        $subCate = SubCategory::orderBy('id', 'desc')->where('id_category_parent', $id)->get();

        return view('admin.product.feature.edit', compact('feature', 'category', 'subCate'));
    }

    public function delProductFeature(Request $request, $id = null)
    {
        $feature = ProductFeature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.product.feature.list');
    }

    public function editSubCategory(Request $request, $id = null){
        $sub = SubCategory::findOrFail($id);

        if($request->method() === 'POST'){
            $name = $request->get('name');
            $avatar = $request->get('img_avatar_path');
            $description = $request->get('description');
            $favourite = $request->get('favourite') === 'on' ? 1 : 0;
            $status = $request->get('status') === 'on' ? 1 : 0;
            $parent = SubCategory::with(['feature', 'feature.line'])->where('id', $id)->firstOrFail();
            $slugSEO = $parent->feature->line->seo_url;

            $update = SubCategory::where('id', $id)->update([
                'name' => $name,
                'avatar' => $avatar,
                'description' => $description,
                'favourite' => $favourite,
                'status' => $status,
                'url' => collect($request->server)['HTTP_ORIGIN'].'/danh-muc/'.$slugSEO.'?feature[]='.$id
            ]);

            if($update){
                return redirect()->route('admin.sub.category.edit', ['id' => $id]);
            }
        }
        return view('admin.product.feature.sub.edit', compact('sub'));
    }
}
