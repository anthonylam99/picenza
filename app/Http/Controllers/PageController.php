<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\Post;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function list(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $page = Page::where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $page = Page::paginate(10);
        }
        return view('admin.page.list', compact('page'));
    }

    public function add(Request $request)
    {
        return view('admin.page.add');
    }

    public function addPage(Request $request)
    {
        $options = new Options;
        $arr = [];
        $url = collect($request->server)['HTTP_ORIGIN'];
        $slug = $options->create_slug($request->get('name'));

        $arr['name'] = $request->get('name');
        $arr['content'] = $request->get('content');
        $arr['slug'] = $slug;
        $arr['url'] = $url . '/trang/' . $slug;

        if ($request->has('page_id')) {
            $res = Page::where('id', $request->get('page_id'))->update($arr);
            $id = $request->get('page_id');
        } else {
            $res = Page::create($arr);
            $id = $res->id;
        }

        $arrPost = [];
        if($request->has('postDes')){
            $postDes = Post::whereIn('id', $request->get('postDes'))->get();



            if(!empty($postDes)){
                foreach ($postDes as $value){
                    $arr = [];
                    $arr['page_id'] = $request->get('page_id');
                    $arr['tag'] = 'des';
                    $arr['title'] = $value->title;
                    $arr['content'] = substr($value->content, 0, 300);
                    $arr['url'] = $value->url;
                    $arr['image_path'] = $value->avatar;


                    array_push($arrPost, $arr);
                }
            }
        }
        if(!empty($arrPost)){
            foreach ($arrPost as $value) {
                PageImage::create($value);
            }
        }

        $this->insertImage($request, 'imagebanner', 'banner');

        if (!empty($res)) {
            return redirect()->route('admin.page.edit', ['id' => $id]);
        }
    }

    public function insertImage($request, $name, $tag)
    {
        $dataPos = $request->all();

        $arrImg = [];
        foreach ($dataPos as $key => $value) {
            if (strpos($key, $name) !== false) {
                $index = explode($name, $key);
                $index = $index[1];
                $arr = [];
                $arr['image_path'] = $request->get('image' . $tag . $index, '');
                $arr['page_id'] = $request->get('page_id');
                $arr['tag'] = $tag;
                $arr['title'] = $request->get('title' . $tag . $index, '');
                $arr['content'] = $request->get('content' . $tag . $index, '');
                $arr['url'] = $request->get('url' . $tag . $index, '');

                array_push($arrImg, $arr);
            }
            if (strpos($key, 'del-image' . $tag) !== false) {
                $arr = [
                    'id' => $value,
                    'page_id' => $request->get('page_id')
                ];
                PageImage::where($arr)->delete();
            }
        }

        if (!empty($arrImg)) {
            foreach ($arrImg as $value) {
                PageImage::updateOrCreate(
                    [
                        'page_id' => $value->page_id,
                        'image_path' => $value->image_path
                    ],
                    $value
                );
            }
        }
    }

    public function editPage(Request $request, $id = null)
    {
        $page = Page::findOrFail($id);
        $post = Post::all();
        $image = PageImage::where('page_id', $id)->get();
        $arrImg = [];
        if (!empty($image)) {
            foreach ($image as $key => $value) {
                $arrImg[$value->tag][] = $value;
            }
        }

        return view('admin.page.edit', compact('page', 'arrImg', 'post'));
    }

    public function showPage(Request $request, $slug = null)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('admin.page.show', compact('page'));
    }
}
