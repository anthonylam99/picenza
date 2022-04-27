<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function list(Request $request){
        return view('admin.page.list');
    }

    public function add(Request $request){
        return view('admin.page.add');
    }

    public function addPage(Request $request){
        $options = new Options;

        $url = collect($request->server)['HTTP_ORIGIN'];

        $slug = $options->create_slug($request->get('pageName'));
        $arr = [
            'name' => $request->get('pageName'),
            'slug' => $slug,
            'content' => $request->get('content'),
            'url' => $url.'/trang/'.$slug
        ];

        if(!$request->has('page_id')){
            $res = Page::create($arr);
        }else{
            $update = Page::where('id', $request->get('page_id'))->update($arr);
            $res = Page::find($request->get('page_id'));
        }

        return redirect()->route('admin.page.edit' , ['id' => $res->id]);
    }

    public function editPage(Request $request, $id = null){
        $page = Page::findOrFail($id);

        return view('admin.page.edit' , compact('page'));
    }

    public function showPage(Request $request, $slug = null){
        $data = Page::where('slug', $slug)->get();

        if(!empty($data)){
            $content = $data->content;

            return view('page.show', ['content' => $content]);
        }
    }
}
