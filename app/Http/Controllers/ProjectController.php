<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\PageImage;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showPost(Request $request, $slug = '')
    {
        $post = Project::where('slug', $slug)->firstOrFail();

        $relatePost = Project::where('id', '!=', $post->id)
            ->where('status', 1)
            ->where(function ($q) use ($post) {
                $q->whereIn('category', $post->category);
                $q->orWhere('tag', 'like', '%' . $post->tag . '%');
                return $q;
            })->inRandomOrder()->limit(5)->get();
        return view('admin.project.show', compact('post', 'relatePost'));
    }
    public function news(Request $request, $slug = null)
    {
        $newPost = Project::orderBy('id', 'desc')->limit(5)->get();


        $posts = Project::all();

        $categoryData = [];

        if (!empty($slug)) {
            $category = ProjectCategory::where('seo_url', $slug)->first();

            if (!empty(collect($category)->toArray())) {
                $category = collect($category)->toArray();

                $categoryData = $category;
                $arrPosts = Project::all();
                $posts = [];
                foreach ($arrPosts as $post) {
                    if (!empty($post->category)) {
                        if (in_array($category['name'], $post->category)) {
                            array_push($posts, $post);
                        }
                    }
                }
            }
        }


        return view('news.index', compact('newPost', 'posts', 'categoryData'));
    }

    public function listPost(Request $request)
    {
        $post = Project::paginate(10);
        $tag = ProjectTag::all();
        $category = ProjectCategory::where('status', 1)->get();

        if ($request->has('s')) {
            $s = $request->get('s');
            $post = Project::where('title', 'like', '%' . $s . '%')
                ->whereIn('category', $s, 'or')
                ->orWhere('tag', 'like', '%' . $s . '%')
                ->paginate(10);
        }
        return view('admin.project.list', compact('post', 'tag', 'category'));
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
            $arr['tagged'] = $request->get('tagged') === 'on' ? 1 : 0;

            if ($request->has('post_id')) {
                $slug = $request->get('seo-url');
                $post = Project::where('slug', $slug)->where('id', '!=', $request->get('post_id'))->get();

                if (!empty(collect($post)->toArray()) && count(collect($post)->toArray()) >= 1) {
                    $randomNumber = rand(0, 9999);
                    $slug .= '-' . $randomNumber;
                }
                $arr['slug'] = $slug;
                $arr['seo_url'] = $slug;
                $arr['url'] = $url . '/bai-viet/' . $slug;

                $res = Project::where('id', $request->get('post_id'))->update($arr);

                $id = $request->get('post_id');
            } else {
                $slug = $options->create_slug($request->get('title'));
                $post = Project::where('slug', $slug)->get();
                if (!empty(collect($post)->toArray()) && count(collect($post)->toArray()) >= 1) {
                    $randomNumber = rand(0, 9999);
                    $slug .= '-' . $randomNumber;
                }
                $arr['slug'] = $slug;
                $arr['seo_url'] = $slug;
                $arr['url'] = $url . '/trang/' . $slug;

                $res = Project::create($arr);
                $id = $res->id;
            }

            if ($res) {
                return redirect()->route('admin.project.edit', ['id' => $id]);
            }
        } else {
            $tag = ProjectTag::where('status', 1)->get();
            $category = ProjectCategory::where('status', 1)->get();

            return view('admin.project.add', compact('tag', 'category'));
        }

    }

    public function editPost(Request $request, $id = null)
    {
        $post = Project::findOrFail($id);

        $listTag = ProjectTag::where('status', 1)->get();
        $listCategory = ProjectCategory::where('status', 1)->get();

        $tag = [];
        if ($post) {
            $tag = explode(',', $post->tag);
        }
        // $category = [];
        // if($post){
        //     $category = explode(',', $post->category);
        // }
        return view('admin.project.edit', compact('post', 'tag', 'listTag', 'listCategory'));
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
        $update = Project::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if ($update) {
            return response()->json(['message' => 'Success']);
        }
    }
}
