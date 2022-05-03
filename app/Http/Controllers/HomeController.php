<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageImage;
use App\Models\Post;
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
    function strip_tags_content($string) {
        // ----- remove HTML TAGs -----
        $string = preg_replace ('/<[^>]*>/', ' ', $string);
        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        return $string;

    }

    public function news(Request $request){
        $newPost = Post::orderBy('id', 'desc')->limit(5)->get();
        $posts = Post::paginate(5);
        $posts = $posts->map(function ($item){
            if(strlen($item->content) > 400){
                $item->content = substr(html_entity_decode($item->content), 0, 400);
                $item->content = $this->strip_tags_content($item->content);
            }

            return $item;
        });


        return view('news.index', compact('newPost', 'posts'));
    }
}
