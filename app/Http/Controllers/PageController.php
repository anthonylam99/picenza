<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function list(Request $request){
        $page = Page::all();
        return view('admin.page.list', compact('page'));
    }

    public function add(Request $request){
        return view('admin.page.add');
    }

    public function addPage(Request $request){
        $options = new Options;
        $arr = [];
        $url = collect($request->server)['HTTP_ORIGIN'];
        $slug = $options->create_slug($request->get('name'));

        $arr['name'] = $request->get('name');
        $arr['content'] = $request->get('content');
        $arr['slug'] = $slug;
        $arr['url'] = $url.'/trang/'.$slug;

        if($request->has('page_id')){
            $res = Page::where('id', $request->get('page_id'))->update($arr);
            $id = $request->get('page_id');
        }else{
            $res = Page::create($arr);
            $id = $res->id;
        }


        $this->insertImage($request, 'imagebanner', 'banner');
        $this->insertImage($request, 'imagedes', 'des');
        $this->insertImage($request, 'imagediscovery', 'discovery');
        $this->insertImage($request, 'imagebrand', 'brand');

        if(!empty($res)){
            return redirect()->route('admin.page.edit', ['id' => $id]);
        }
    }

    public function insertImage($request , $name, $tag){
        $dataPos = $request->all();

        $arrImg = [];
        foreach($dataPos as $key => $value){
            if (strpos($key, $name) !== false) {
                $index = explode($name, $key);
                $index = $index[1];
                if ($request->hasFile($key)) {
                    $arr = [];
                    $image = $request->file($key);
                    $fileName = Str::random(40);
                    $imagePath = $image->move($name, $fileName . '.' . $image->getClientOriginalExtension());
                    $arr['image_path'] = $imagePath;
                    $arr['page_id'] = $request->get('page_id');
                    $arr['tag'] = $tag;
                    $arr['title'] = $request->get('title'.$tag.$index, '');
                    $arr['content'] = $request->get('content'.$tag.$index, '');
                    $arr['url'] = $request->get('url'.$tag.$index, '');

                    array_push($arrImg, $arr);
                }

            }
            if (strpos($key, 'del-image'.$tag) !== false) {
                $arr = [
                    'id' => $value,
                    'page_id' => $request->get('page_id')
                ];
                PageImage::where($arr)->delete();
            }
        }

        if(!empty($arrImg)){
            foreach ($arrImg as $value){
                PageImage::create($value);
            }
        }
    }

    public function editPage(Request $request, $id = null){
        $page = Page::findOrFail($id);
        $image = PageImage::where('page_id', $id)->get();
        $arrImg = [];
        if(!empty($image)){
            foreach($image as $key => $value){
                $arrImg[$value->tag][] = $value;
            }
        }

        return view('admin.page.edit', compact('page', 'arrImg'));
    }

    public function showPage(Request $request, $slug = null){
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('admin.page.show', compact('page'));
    }
}
