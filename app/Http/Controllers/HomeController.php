<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\ProductLine;
use http\Client\Response;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $category = ProductLine::all();
        $postTag = PostTag::whereNotNull('posts')->get();
        $arrPostPage = [];
        $aryPostId = [];
        foreach ($postTag as $tag) {
            $categoryId = explode(',', $tag->posts);
            $aryPost = Post::where('status', 1)->get();
            foreach ($aryPost as $key => $post) {
                if (count(array_intersect($categoryId, $post->category)) >= 0) {
                    $aryPostId[] = $post->id;
                }
            }
            $postPage = PageImage::whereIn('post_id', $aryPostId)->where('tag', $tag->page_tag)->get();
            $arrPostPage[$tag->page_tag] = $postPage;
        }

        $banner = PageImage::where('tag', 'banner')->get();
        $brand = PageImage::where('tag', 'brand')->get();

        return view('home.index', compact('category', 'arrPostPage', 'banner', 'brand'));
    }

    function strip_tags_content($string)
    {
        // ----- remove HTML TAGs -----
        $string = preg_replace('/<[^>]*>/', ' ', $string);
        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        return $string;

    }

    public function news(Request $request, $slug = null)
    {
        $newPost = Post::orderBy('id', 'desc')->limit(5)->get();


        $posts = DB::table('post')->get();

        $categoryData = [];

        if (!empty($slug)) {
            $category = PostCategory::where('seo_url', $slug)->first();

            if (!empty(collect($category)->toArray())) {
                $category = collect($category)->toArray();

                $categoryData = $category;
                $arrPosts = Post::all();
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
}
