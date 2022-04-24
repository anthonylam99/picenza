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

        $productType = ProductType::with(['company', 'productLine'])->paginate(10);

        return view('admin.company.list', compact('productType'));
    }

    public function addCompany(Request $request)
    {
        return view('admin.company.add');
    }

    public function addCompanyPost(Request $request)
    {
        $companyName = $request->get('company');
        $product_line = $request->get('product_line');
        $product_type = $request->get('product_type');

        if($request->has('id')){
            $id = $request->get('id');
            $productType = ProductType::findOrFail($id);

            ProductCompany::where('id', $productType->company_id)->update([
                'name' => $companyName
            ]);
            ProductLine::where('id', $productType->product_line_id)->update([
                'name' => $product_line,
                'company_id' => $productType->company_id
            ]);
            ProductType::where('id', $id)->update(['name' =>  $product_type]);

        }else{
            $company = ProductCompany::updateOrCreate(
                ['name' => $companyName],
                ['name' => $companyName]
            );

            $productLine = ProductLine::updateOrCreate(
                [
                    'name' => $product_line,
                    'company_id' => $company->id
                ],
                [
                    'name' => $product_line,
                    'company_id' => $company->id
                ]
            );

            $productType = ProductType::updateOrCreate(
                [
                    'name' => $product_type,
                    'product_line_id' => $productLine->id,
                    'company_id' => $company->id
                ],
                [
                    'name' => $product_type,
                    'product_line_id' => $productLine->id,
                    'company_id' => $company->id
                ]
            );
        }

        return redirect()->route('admin.company.edit', ['id' => $productType->id]);
    }

    public function editCompany(Request $request, $id = null)
    {
        $data = ProductType::with([
            'company',
            'productLine'
        ])->findOrFail($id);
        $data = collect($data)->toArray();

        return view('admin.company.edit', compact('data'));
    }

    public function delCompany(Request $request)
    {

    }
}
