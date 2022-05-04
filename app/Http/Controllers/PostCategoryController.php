<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\PostCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function listPostCategory(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $tag = PostCategory::where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $tag = PostCategory::paginate(10);
        }

        return view('admin.post.category.list', compact('tag'));
    }

    public function addPostCategory(Request $request)
    {
        return view('admin.post.category.add');
    }

    public function addPostCategoryPost(Request $request)
    {
        $name = $request->get('name');
        $options = new Options;
        $slug = $options->create_slug($name);

        if ($request->has('id')) {
            $id = $request->get('id');

            $tag = PostCategory::where('id', $id)->update([
                'name' => $request->get('name'),
                'slug' => $slug,
                'seo_url' => $request->get('seo_url'),
                'seo_title' => $request->get('seo_title'),
                'seo_description' => $request->get('seo_description'),
                'seo_keyword' => $request->get('seo_keyword'),
                'seo_robots' => $request->get('seo_robots'),
            ]);

            return redirect()->route('admin.post.category.edit', ['id' => $id]);
        } else {
            $tag = PostCategory::create([
                'name' => $request->get('name'),
                'slug' => $slug,
                'seo_url' => $request->get('seo_url'),
                'seo_title' => $request->get('seo_title'),
                'seo_description' => $request->get('seo_description'),
                'seo_keyword' => $request->get('seo_keyword'),
                'seo_robots' => $request->get('seo_robots'),
            ]);
            return redirect()->route('admin.post.category.edit', ['id' => $tag->id]);
        }
    }

    public function editPostCategory(Request $request, $id = null)
    {
        $tag = PostCategory::findOrFail($id);

        return view('admin.post.category.edit', compact('tag'));
    }

    public function delPostCategory(Request $request, $id = null)
    {
        $tagFind = PostCategory::findOrFail($id);
        $tagFind->delete();

        return redirect()->route('admin.post.category.list');
    }

    /**
     * Update status cate
     *
     * @param Request $request
     * @return void
     */
    public function updateStatus(Request $request){
        $update = PostCategory::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
}
