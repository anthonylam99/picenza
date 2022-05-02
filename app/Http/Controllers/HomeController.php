<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageImage;
use App\Models\PostTag;
use App\Models\ProductLine;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        $category = ProductLine::all();
        $postTag = PostTag::whereNotNull('posts')->get();
        $arrPostPage = [];
        foreach ($postTag as $tag){
            $posts = explode(',', $tag->posts);
            $postPage = PageImage::whereIn('post_id', $posts)->where('tag', $tag->page_tag)->get();
            $arrPostPage[$tag->page_tag] = $postPage;
        }

        $banner = PageImage::where('tag', 'banner')->get();
        $brand = PageImage::where('tag', 'brand')->get();

        return view('home.index', compact('category', 'arrPostPage', 'banner', 'brand'));
    }
}
