<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\PostCategory;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function listPostCategory(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $tag = ProjectCategory::where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $tag = ProjectCategory::paginate(10);
        }

        return view('admin.project.category.list', compact('tag'));
    }

    public function addPostCategory(Request $request)
    {
        return view('admin.project.category.add');
    }

    public function addPostCategoryPost(Request $request)
    {
        $name = $request->get('name');


        if ($request->has('id')) {
            $id = $request->get('id');
            $slug = $request->get('seo_url');
            $post = ProjectCategory::where('slug', $slug)->get();

            if (!empty(collect($post)->toArray()) && count(collect($post)->toArray()) >= 1) {
                $randomNumber = rand(0, 9999);
                $slug .= '-' . $randomNumber;
            }

            $tag = ProjectCategory::where('id', $id)->update([
                'name' => $request->get('name'),
                'slug' => $slug,
                'seo_url' => $slug,
                'seo_title' => $request->get('seo_title'),
                'seo_description' => $request->get('seo_description'),
                'seo_keyword' => $request->get('seo_keyword'),
                'seo_robots' => $request->get('seo_robots'),
            ]);

            return redirect()->route('admin.project.category.edit', ['id' => $id]);
        } else {
            $options = new Options;
            $slug = $options->create_slug($name);


            $post = ProjectCategory::where('slug', $slug)->get();

            if (!empty(collect($post)->toArray()) && count(collect($post)->toArray()) >= 1) {
                $randomNumber = rand(0, 9999);
                $slug .= '-' . $randomNumber;
            }

            $tag = ProjectCategory::create([
                'name' => $request->get('name'),
                'slug' => $slug,
                'seo_url' => $slug,
                'seo_title' => $request->get('seo_title'),
                'seo_description' => $request->get('seo_description'),
                'seo_keyword' => $request->get('seo_keyword'),
                'seo_robots' => $request->get('seo_robots'),
            ]);
            return redirect()->route('admin.project.category.edit', ['id' => $tag->id]);
        }
    }

    public function editPostCategory(Request $request, $id = null)
    {
        $tag = ProjectCategory::findOrFail($id);

        return view('admin.project.category.edit', compact('tag'));
    }

    public function delPostCategory(Request $request, $id = null)
    {
        $tagFind = ProjectCategory::findOrFail($id);
        $tagFind->delete();

        return redirect()->route('admin.project.category.list');
    }

    /**
     * Update status cate
     *
     * @param Request $request
     * @return void
     */
    public function updateStatus(Request $request){
        $update = ProjectCategory::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
}
