<?php

namespace App\Http\Controllers;

use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductLineController extends Controller
{
    public function listLine(Request $request)
    {
        $line = ProductLine::with(['company'])->get();
        return view('admin.line.list', compact('line'));
    }

    public function addLine(Request $request)
    {
        $company = ProductCompany::all();
        return view('admin.line.add', compact('company'));
    }

    public function addLinePost(Request $request)
    {
        $companyId = $request->get('company_id');
        $lineName = $request->get('lineName');

        if(!$request->has('id')){
            $insert = ProductLine::create([
                'name' => $lineName,
                'company_id' => $companyId
            ]);
            if($insert){
                return redirect()->route('admin.line.edit', ['id' => $insert->id]);
            }
        }else{
            $update = ProductLine::where('id', $request->get('id'))->update([
                'name' => $lineName,
                'company_id' => $companyId
            ]);
            if($update){
                return redirect()->route('admin.line.edit', ['id' => $request->get('id')]);
            }
        }
    }

    public function editLine(Request $request, $id = null)
    {
        $line = ProductLine::findOrFail($id);
        $company = ProductCompany::all();

        return view('admin.line.edit', compact('line', 'company'));
    }

    public function delLine(Request $request, $id = null)
    {
        $search = ProductLine::findOrFail($id);
        $search->delete();
        $line = ProductLine::all();

        return view('admin.line.list', compact('line'));
    }
}
