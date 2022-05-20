<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Post;
use App\Models\ProductCompany;
use App\Models\ProductLine;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductLineController extends Controller
{
    public function updateStatus(Request $request){
        $update = ProductLine::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }

    public function showHome(Request $request){
        $update = ProductLine::where('id', $request->get('id'))->update([
            'show_home' => $request->show_home
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }

    public function listLine(Request $request)
    {
        if ($request->has('s')) {
            $query = $request->get('s');
            $line = ProductLine::with(['company'])->where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $line = ProductLine::with(['company'])->paginate(15);
        }
        return view('admin.line.list', compact('line'));
    }

    public function addLine(Request $request)
    {
        $company = ProductCompany::all();
        $post = Post::all();
        return view('admin.line.add', compact('company', 'post'));
    }

    public function addLinePost(Request $request)
    {
        $options = new Options;
        $lineName = $request->get('lineName');

        $avatar = $request->get('img_avatar_path');
        $status = $request->get('status') === 'on' ? 1 : 0;
        $description = $request->get('description');

        $posts = '';
        if($request->has('posts')){
            $posts = implode(',', $request->get('posts'));
        }

        if(!$request->has('id')){
            $slug = $options->create_slug($lineName);
            $product = ProductLine::where('slug', $slug)->get();

            if (!empty(collect($product)->toArray()) && count(collect($product)->toArray()) >= 1) {
                $randomNumber = rand(0, 9999);
                $slug .= '-' . $randomNumber;
            }
            $insert = ProductLine::create([
                'name' => $lineName,
                'avatar' => $avatar,
                'status' => $status,
                'slug' => $slug,
                'seo_url' => $slug,
                'url' => collect($request->server)['HTTP_ORIGIN'].'/san-pham/'.$slug,
                'description' => $description,
                'posts' => $posts
            ]);
            if($insert){
                return redirect()->route('admin.line.edit', ['id' => $insert->id]);
            }
        }else{
            $slug = $request->get('seo-url');

            $product = ProductLine::where('slug', $slug)->get();

            if (!empty(collect($product)->toArray()) && count(collect($product)->toArray()) >= 1) {
                $randomNumber = rand(0, 9999);
                $slug .= '-' . $randomNumber;
            }

            $seo_url = $slug;
            $update = ProductLine::where('id', $request->get('id'))->update([
                'name' => $lineName,
                'avatar' => $avatar,
                'status' => $status,
                'slug' => $slug,
                'seo_url' => $seo_url,
                'url' => collect($request->server)['HTTP_ORIGIN'].'/san-pham/'.$slug,
                'description' => $description,
                'posts' => $posts
            ]);
            if($update){
                return redirect()->route('admin.line.edit', ['id' => $request->get('id')]);
            }
        }
    }

    public function editLine(Request $request, $id = null)
    {
        $line = ProductLine::findOrFail($id);
        $company = ProductCompany::all();
        $post = Post::all();
        $arrPostPage = explode(',',$line->posts);


        return view('admin.line.edit', compact('line', 'company', 'post', 'arrPostPage'));
    }

    public function delLine(Request $request, $id = null)
    {
        $search = ProductLine::findOrFail($id);
        $search->delete();

        return redirect()->route('admin.line.list');
    }
}
