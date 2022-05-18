<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\Post;
use App\Models\PostCategory;
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



        $arr['name'] = !empty($request->get('name')) ? $request->get('name')  : $request->get('name_page');
        $arr['content'] = $request->get('content','');
        $arr['seo_title'] = $request->get('seo_title', '');
        $arr['seo_description'] = $request->get('seo_description', '');
        $arr['seo_keyword'] = $request->get('seo_keyword', '');
        $arr['seo_robots'] = $request->get('seo_robots', '');

        if ($request->has('page_id')) {
            $slug = !empty($request->get('slug')) ? $request->get('slug') : $options->create_slug($arr['name']);
            $page = Page::where('slug', $slug)->where('id', '!=' ,$request->get('page_id'))->get();

            if(!empty(collect($page)->toArray()) && count(collect($page)->toArray()) >= 1){
                $randomNumber = rand(0, 9999);
                $slug .= '-'.$randomNumber;
                $arr['slug'] = $slug;
                $arr['slug'] = $slug;
            }
            $arr['slug'] = $slug;
            $arr['seo_url'] = $slug;
            $arr['url'] = $url . '/trang/' . $slug;

            $sub_section = [
                'intro' => [
                    'title' => $request->get('title-intro', ''),
                    'post' => $request->get('post-intro', 0),
                    'content' => $request->get('content-intro', ''),
                    'des' => [
                        [
                            'number' => $request->get('des-number1', 0),
                            'text' => $request->get('des-text1', 0)
                        ],
                        [
                            'number' => $request->get('des-number2', 0),
                            'text' => $request->get('des-text2', '')
                        ],
                        [
                            'number' => $request->get('des-number3', 0),
                            'text' => $request->get('des-text3', '')
                        ]
                    ]
                ],
                'diff' => [
                    'title' => $request->get('title-diff'),
                    'des'   => [
                        [
                            'image' => $request->get('imagediff1', ''),
                            'title' => $request->get('des-diff-title1', ''),
                            'content' => $request->get('des-diff-content1', '')
                        ],
                        [
                            'image' => $request->get('imagediff2', ''),
                            'title' => $request->get('des-diff-title2', ''),
                            'content' => $request->get('des-diff-content2', '')
                        ],
                        [
                            'image' => $request->get('imagediff3', ''),
                            'title' => $request->get('des-diff-title3', ''),
                            'content' => $request->get('des-diff-content3', '')
                        ]
                    ]
                ]
            ];
            $arr['sub_section'] = json_encode($sub_section);

            $res = Page::where('id', $request->get('page_id'))->update($arr);
            $id = $request->get('page_id');




        } else {
            $slug = $options->create_slug($request->get('name'));
            $page = Page::where('slug', $slug)->get();
            if(!empty(collect($page)->toArray()) && count(collect($page)->toArray()) >= 1){
                $randomNumber = rand(0, 9999);
                $slug .= '-'.$randomNumber;
                $arr['slug'] = $slug;
                $arr['slug'] = $slug;
            }
            $arr['slug'] = $slug;
            $arr['seo_url'] = $slug;
            $arr['url'] = $url . '/trang/' . $slug;

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
            $postDes = PostCategory::whereIn('id', $request->get($field))->get();

            if (!empty($postDes)) {
                $i = 0;
                $postIdStr = [];
                $posts = Post::all();
                foreach ($posts as $post){
                    foreach ($postDes as $value) {
                        if(in_array($value->name, $post->category)){
                            $arr = [];
                            $arr['page_id'] = $request->get('page_id');
                            $arr['tag'] = $tag;
                            $arr['title'] = $post->title;
                            $arr['content'] = substr($post->content, 0, 300);
                            $arr['url'] = config('app.url') . '/bai-viet/' . $post->seo_url;
                            $arr['image_path'] = $post->avatar;
                            $arr['post_id'] = $post->id;

                            $arrPost[$post->id] = $arr;
                            array_push($postIdStr, $post->id);
                        }
                    }
                }

                $postTag = PostTag::where('page_tag', $tag)->update([
                    'posts' => implode(',', array_unique($postIdStr)),
                    'category_post' => implode(',', array_unique($request->get($field)))
                ]);
            }
        }else{
            PostTag::where('page_tag', $tag)->update([
                'posts' => '',
                'category_post' => ''
            ]);
        }

        if (!empty($arrPost)) {
            PageImage::where('tag', $tag)->delete();
            foreach ($arrPost as $value) {
                PageImage::create($value);
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
//        return response()->json($dataPost);
        $arrPostPage = [];
        foreach ($dataPost as $value) {
            $arrPostPage[$value->page_tag] = explode(',', $value->category_post);
        }

        $posts = Post::all();
        $page = Page::findOrFail($id);
        $aryCategory = PostCategory::where('status', 1)->get();
        $image = PageImage::where('page_id', $id)->get();
        $arrImg = [];
        if (!empty($image)) {
            foreach ($image as $key => $value) {
                $arrImg[$value->tag][] = $value;
            }
        }

        return view('admin.page.edit', compact('page', 'arrImg', 'aryCategory', 'arrPostPage', 'posts'));
    }

    public function showPage(Request $request, $slug = null)
    {
        $page = Page::where('seo_url', $slug)->firstOrFail();

        return view('admin.page.show', compact('page'));
    }

    public function delPage(Request $request, $id = null){
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.page.list');
    }
}
