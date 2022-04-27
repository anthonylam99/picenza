<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Request $request, $slug = ''){
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.post.show', compact('post'));
    }
    public function listPost(Request $request)
    {
        $post = Post::all();

        return view('admin.post.list', compact('post'));
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

            $arr['title'] = $request->get('title');
            $arr['content'] = $request->get('content');
            $arr['slug'] = $slug;
            $arr['url'] = $url.'/bai-viet/'.$slug;
            $arr['tag'] = $tag;

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
            return view('admin.post.add');
        }

    }

    public function editPost(Request $request, $id = null)
    {
        $post = Post::findOrFail($id);

        $tag = [];
        if($post){
            $tag = explode(',', $post->tag);
        }
        return view('admin.post.edit', compact('post', 'tag'));
    }

    public function delPost(Request $request)
    {
        return view('admin.post.list');
    }
}
