<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductLineController extends Controller
{
    public function updateStatus(Request $request){
        $update = ProductLine::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
    public function updateStatusHome(Request $request){
        $update = ProductLine::where('id', $request->get('id'))->update([
            'show_home' => $request->show_home
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
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
        $options = new Options;
        $lineName = $request->get('lineName');

        $avatar = $request->get('img_avatar_path');
        $status = $request->get('status') === 'on' ? 1 : 0;
        $description = $request->get('description');


        if(!$request->has('id')){
            $slug = $options->create_slug($lineName);
            $seo_url = $slug;
            $insert = ProductLine::create([
                'name' => $lineName,
                'avatar' => $avatar,
                'status' => $status,
                'slug' => $slug,
                'seo_url' => $seo_url,
                'url' => collect($request->server)['HTTP_ORIGIN'].'/'.$slug,
                'description' => $description
            ]);
            if($insert){
                return redirect()->route('admin.line.edit', ['id' => $insert->id]);
            }
        }else{
            $slug = $options->create_slug($lineName);
            $seo_url = $request->get('seo-url');
            $update = ProductLine::where('id', $request->get('id'))->update([
                'name' => $lineName,
                'avatar' => $avatar,
                'status' => $status,
                'slug' => $slug,
                'seo_url' => $seo_url,
                'url' => collect($request->server)['HTTP_ORIGIN'].'/'.$slug,
                'description' => $description
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
