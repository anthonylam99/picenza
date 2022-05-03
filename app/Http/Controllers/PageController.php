<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\Post;
use App\Models\PostTag;
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

        $this->upImagePage($request, 'postDes', 'section3');
        $this->upImagePage($request, 'section4', 'section4');

        $this->insertImage($request, 'imagebanner', 'banner');
        $this->insertImage($request, 'imagebrand', 'brand');

        if (!empty($res)) {
            return redirect()->route('admin.page.edit', ['id' => $id]);
        }
    }

    public function upImagePage($request, $field, $tag)
    {
        $arrPost = [];
        if ($request->has($field)) {
            $postDes = Post::whereIn('id', $request->get($field))->get();

            if (!empty($postDes)) {
                $i = 0;
                $postIdStr = '';
                foreach ($postDes as $value) {
                    $i++;

                    if ($i < count($postDes)) {
                        $postIdStr .= $value->id . ',';
                    } else {
                        $postIdStr .= $value->id;
                    }
                    $arr = [];
                    $arr['page_id'] = $request->get('page_id');
                    $arr['tag'] = $tag;
                    $arr['title'] = $value->title;
                    $arr['content'] = substr($value->content, 0, 300);
                    $arr['url'] = config('app.url').'/bai-viet/'.$value->seo_url;
                    $arr['image_path'] = $value->avatar;
                    $arr['post_id'] = $value->id;


                    array_push($arrPost, $arr);
                }

                $postTag = PostTag::where('page_tag', $tag)->update([
                    'posts' => $postIdStr
                ]);
            }
        }else{
            PostTag::where('page_tag', $tag)->update([
                'posts' => ''
            ]);
        }
        if (!empty($arrPost)) {
            foreach ($arrPost as $value) {
                $find = PageImage::where([
                    'post_id' => $value['post_id'],
                    'tag' => $value['tag']
                ])->get();
                if (empty(collect($find)->toArray())) {
                    PageImage::create($value);
                }
            }
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
                if (!empty($value['image_path'])) {
                    PageImage::updateOrCreate(
                        [
                            'page_id' => $value['page_id'],
                            'image_path' => $value['image_path'],
                        ],
                        $value
                    );

                }
            }
        }
    }

    public function editPage(Request $request, $id = null)
    {
        $dataPost = PostTag::all();
        $arrPostPage = [];
        foreach ($dataPost as $value) {
            $arrPostPage[$value->page_tag] = explode(',', $value->posts);
        }

        $page = Page::findOrFail($id);
        $post = Post::all();
        $image = PageImage::where('page_id', $id)->get();
        $arrImg = [];
        if (!empty($image)) {
            foreach ($image as $key => $value) {
                $arrImg[$value->tag][] = $value;
            }
        }

        return view('admin.page.edit', compact('page', 'arrImg', 'post', 'arrPostPage'));
    }

    public function showPage(Request $request, $slug = null)
    {
        $page = Page::where('seo_url', $slug)->firstOrFail();

        return view('admin.page.show', compact('page'));
    }
}
