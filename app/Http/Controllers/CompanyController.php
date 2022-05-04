<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductType;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function listCompany(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $company = ProductCompany::where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $company = ProductCompany::paginate(10);
        }

        return view('admin.company.list', compact('company'));
    }

    public function addCompany(Request $request)
    {
        return view('admin.company.add');
    }

    public function addCompanyPost(Request $request)
    {
        $companyName = $request->get('company');

        if($request->has('id')){
            $id = $request->get('id');
            $company = ProductCompany::findOrFail($id);

            ProductCompany::where('id', $company->id)->update([
                'name' => $companyName
            ]);
//            ProductLine::where('id', $productType->product_line_id)->update([
//                'name' => $product_line,
//                'company_id' => $productType->company_id
//            ]);
//            ProductType::where('id', $id)->update(['name' =>  $product_type]);

        }else{
            $company = ProductCompany::updateOrCreate(
                ['name' => $companyName],
                ['name' => $companyName]
            );

//
//            $productLine = ProductLine::updateOrCreate(
//                [
//                    'name' => $product_line,
//                    'company_id' => $company->id
//                ],
//                [
//                    'name' => $product_line,
//                    'company_id' => $company->id
//                ]
//            );
//
//            $productType = ProductType::updateOrCreate(
//                [
//                    'name' => $product_type,
//                    'product_line_id' => $productLine->id,
//                    'company_id' => $company->id
//                ],
//                [
//                    'name' => $product_type,
//                    'product_line_id' => $productLine->id,
//                    'company_id' => $company->id
//                ]
//            );
        }

        return redirect()->route('admin.company.edit', ['id' => $company->id]);
    }

    public function editCompany(Request $request, $id = null)
    {
        $data = ProductCompany::findOrFail($id);
        $data = collect($data)->toArray();

        return view('admin.company.edit', compact('data'));
    }

    public function delCompany(Request $request, $id = null)
    {
        $data = ProductCompany::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.company.list');
    }
}
