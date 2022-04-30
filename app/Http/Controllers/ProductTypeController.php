<?php

namespace App\Http\Controllers;

use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function listType(Request $request)
    {
        $type = ProductType::whereHas('company')->whereHas('productLine')->get();
        $company = ProductCompany::all();
        return view('admin.type.list', compact('type', 'company'));
    }

    public function addType(Request $request)
    {
        $company = ProductCompany::all();
        $productLine = ProductLine::all();
        return view('admin.type.add', compact('company', 'productLine'));
    }

    public function addTypePost(Request $request)
    {
        $companyId = $request->get('company_id');
        $productLineId = $request->get('product_line_id');
        $typeName = $request->get('productTypeName');

        if(!$request->has('id')){
            $insert = ProductType::create([
                'name' => $typeName,
                'product_line_id' => $productLineId,
                'company_id' => $companyId
            ]);
            if($insert){
                return redirect()->route('admin.type.edit', ['id' => $insert->id]);
            }
        }else{
            $update = ProductType::where('id', $request->get('id'))->update([
                'name' => $typeName,
                'product_line_id' => $productLineId,
                'company_id' => $companyId
            ]);
            if($update){
                return redirect()->route('admin.type.edit', ['id' => $request->get('id')]);
            }
        }
    }

    public function editType(Request $request, $id = null)
    {
        $type = ProductType::findOrFail($id);
        $company = ProductCompany::all();
        $productLine = ProductLine::all();

        return view('admin.type.edit', compact('type', 'company', 'productLine'));
    }

    public function delType(Request $request, $id = null)
    {
        $search = ProductType::findOrFail($id);
        $search->delete();
        $type = ProductType::all();

        return view('admin.type.list', compact('type'));
    }
}
