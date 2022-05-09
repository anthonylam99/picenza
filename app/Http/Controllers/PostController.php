<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Request $request, $slug = '')
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $relatePost = Post::where('id', '!=', $post->id)->where(function ($q) use ($post) {
            $q->whereIn('category', $post->category);
            $q->orWhere('tag', 'like', '%' . $post->tag . '%');
            return $q;
        })->inRandomOrder()->limit(5)->get();
        return view('admin.post.show', compact('post', 'relatePost'));
    }

    public function listPost(Request $request)
    {
        $post = Post::paginate(10);
        $tag = Tag::all();
        $category = PostCategory::where('status', 1)->get();

        if ($request->has('s')) {
            $s = $request->get('s');
            $post = Post::where('title', 'like', '%' . $s . '%')
                ->whereIn('category', $s, 'or')
                ->orWhere('tag', 'like', '%' . $s . '%')
                ->paginate(10);
        }

        return view('admin.post.list', compact('post', 'tag', 'category'));
    }

    public function addPost(Request $request)
    {

        if ($request->method() === 'POST') {
            $options = new Options;

            $url = collect($request->server)['HTTP_ORIGIN'];
            $arr = [];

            $tag = '';
            if ($request->has('tag')) {
                $tags = $request->get('tag');
                $i = 0;
                foreach ($tags as $value) {
                    $i++;
                    if ($i < count($tags)) {
                        $tag .= $value . ',';
                    } else {
                        $tag .= $value;
                    }

                }
            }

            $arr['title'] = $request->get('title');
            $arr['content'] = $request->get('content');

            $arr['tag'] = $tag;
            $arr['category'] = $request->get('category');
            $arr['seo_url'] = $request->get('seo-url');
            $arr['avatar'] = $request->get('img_avatar_path');
            $arr['seo_title'] = $request->get('seo_title');
            $arr['seo_description'] = $request->get('seo_description');
            $arr['seo_keyword'] = $request->get('seo_keyword');
            $arr['seo_robots'] = $request->get('seo_robots');
            $arr['status'] = $request->get('status') === 'on' ? 1 : 0;

            if ($request->has('post_id')) {
                $slug = $request->get('seo-url');
                $post = Post::where('slug', $slug)->where('id', '!=', $request->get('post_id'))->get();

                if (!empty(collect($post)->toArray()) && count(collect($post)->toArray()) >= 1) {
                    $randomNumber = rand(0, 9999);
                    $slug .= '-' . $randomNumber;
                }
                $arr['slug'] = $slug;
                $arr['seo_url'] = $slug;
                $arr['url'] = $url . '/bai-viet/' . $slug;

                $res = Post::where('id', $request->get('post_id'))->update($arr);
                $id = $request->get('post_id');
            } else {
                $slug = $options->create_slug($request->get('title'));
                $post = Post::where('slug', $slug)->get();
                if(!empty(collect($post)->toArray()) && count(collect($post)->toArray()) >= 1){
                    $randomNumber = rand(0, 9999);
                    $slug .= '-'.$randomNumber;
                }
                $arr['slug'] = $slug;
                $arr['seo_url'] = $slug;
                $arr['url'] = $url . '/trang/' . $slug;

                $res = Post::create($arr);
                $id = $res->id;
            }

            if ($res) {
                return redirect()->route('admin.post.edit', ['id' => $id]);
            }
        } else {
            $tag = Tag::where('status', 1)->get();
            $category = PostCategory::where('status', 1)->get();

            return view('admin.post.add', compact('tag', 'category'));
        }

    }

    public function editPost(Request $request, $id = null)
    {
        $post = Post::findOrFail($id);

        $listTag = Tag::where('status', 1)->get();
        $listCategory = PostCategory::where('status', 1)->get();

        $tag = [];
        if ($post) {
            $tag = explode(',', $post->tag);
        }
        // $category = [];
        // if($post){
        //     $category = explode(',', $post->category);
        // }
        return view('admin.post.edit', compact('post', 'tag', 'listTag', 'listCategory'));
    }

    public function delPost(Request $request, $id = null)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.post.list');
    }

    public function listTag(Request $request)
    {
        $tag = Tag::all();

        return view('admin.post.tag', compact('tag'));
    }

    /**
     * Update status post
     *
     * @param Request $request
     * @return void
     */
    public function updateStatus(Request $request)
    {
        $update = Post::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if ($update) {
            return response()->json(['message' => 'Success']);
        }
    }
}
