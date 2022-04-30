<?php

namespace App\Http\Controllers;

use App\Models\ProductFeature;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductFeatureController extends Controller
{
    public function listProductFeature(Request $request)
    {
        $feature = ProductFeature::with('productType')->whereHas('productType.productLine')->whereHas('productType.company')->get();

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
        $productType = $request->get('product_type');
        if($request->has('id')){
            $id = $request->get('id');
            $update = ProductFeature::where('id', $id)->update([
                'name' => $name,
                'product_type' => $productType
            ]);
            if($update){
                return redirect()->route('admin.product.feature.edit', ['id' => $id]);
            }
        }else{
            $create = ProductFeature::create([
                'name' => $name,
                'product_type' => $productType
            ]);

            if($create){
                return redirect()->route('admin.product.feature.edit', ['id' => $create->id]);
            }
        }
    }

    public function editProductFeature(Request $request, $id = null)
    {
        $feature = ProductFeature::findOrFail($id);
        $productType = ProductType::all();

        return view('admin.product.feature.edit', compact('feature', 'productType'));
    }

    public function delProductFeature(Request $request, $id = null)
    {
        $feature = ProductFeature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.product.feature.list');
    }
}
