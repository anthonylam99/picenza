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
    public function showPost(Request $request, $slug = ''){
        $post = Post::where('slug', $slug)->firstOrFail();

        $relatePost = Post::where('id', '!=', $post->id)->where(function ($q) use ($post){
            $q->where('category', 'LIKE', '%'.$post->category.'%');
            $q->orWhere('tag', 'like', '%'.$post->tag.'%');
            return $q;
        })->get();
        return view('admin.post.show', compact('post', 'relatePost'));
    }
    public function listPost(Request $request)
    {
        $post = Post::paginate(10);
        $tag = Tag::all();
        $category = PostCategory::all();

        if($request->has('s')){
            $s = $request->get('s');
            $post = Post::where('title', 'like', '%'.$s.'%')
                ->orWhere('category', 'like', '%'.$s.'%')
                ->orWhere('tag', 'like', '%'.$s.'%')
                ->paginate(10);
        }

        return view('admin.post.list', compact('post', 'tag', 'category'));
    }

    public function addPost(Request $request)
    {

        if($request->method() === 'POST'){
            $options = new Options;

            $slug = $options->create_slug($request->get('title'));

            $url = collect($request->server)['HTTP_ORIGIN'];
            $arr = [];

            $tag = '';
            if($request->has('tag')){
                $tags = $request->get('tag');
                $i = 0;
                foreach ($tags as $value){
                    $i++;
                    if($i < count($tags)){
                        $tag .= $value.',';
                    }else{
                        $tag .= $value;
                    }

                }
            }

            $category = '';
            if($request->has('category')){
                $categorys = $request->get('category');
                $i = 0;
                foreach ($categorys as $value){
                    $i++;
                    if($i < count($categorys)){
                        $category .= $value.',';
                    }else{
                        $category .= $value;
                    }

                }
            }

            $arr['title'] = $request->get('title');
            $arr['content'] = $request->get('content');
            $arr['slug'] = $slug;
            $arr['url'] = $url.'/bai-viet/'.$slug;
            $arr['tag'] = $tag;
            $arr['category'] = $category;
            $arr['seo_url'] = $request->get('seo-url');
            $arr['avatar'] = $request->get('img_avatar_path');
            $arr['seo_title'] = $request->get('seo_title');
            $arr['seo_description'] = $request->get('seo_description');
            $arr['seo_keyword'] = $request->get('seo_keyword');
            $arr['seo_robots'] = $request->get('seo_robots');
            $arr['status'] = $request->get('status') === 'on' ? 1 : 0;

            if($request->has('post_id')){
                $res = Post::where('id', $request->get('post_id'))->update($arr);
                $id = $request->get('post_id');
            }else{
                $res = Post::create($arr);
                $id = $res->id;
            }

            if($res){
                return redirect()->route('admin.post.edit', ['id' => $id]);
            }
        }else{
            $tag = Tag::all();
            $category = PostCategory::all();

            return view('admin.post.add', compact('tag', 'category'));
        }

    }

    public function editPost(Request $request, $id = null)
    {
        $post = Post::findOrFail($id);
        $listTag = Tag::all();
        $listCategory = PostCategory::all();

        $tag = [];
        if($post){
            $tag = explode(',', $post->tag);
        }
        $category = [];
        if($post){
            $category = explode(',', $post->category);
        }
        return view('admin.post.edit', compact('post', 'tag', 'listTag', 'category', 'listCategory'));
    }

    public function delPost(Request $request)
    {
        return view('admin.post.list');
    }

    public function listTag(Request $request){
        $tag = Tag::all();

        return view('admin.post.tag', compact('tag'));
    }
}