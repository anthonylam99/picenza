<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Entity\Options;
use App\Models\Districts;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\ProductLine;
use App\Models\Project;
use App\Models\Provinces;
use App\Models\Warranty;
use http\Client\Response;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $category = ProductLine::where('status', 1)->get();
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
        $subSection = Page::where('slug', 'trang-chu')->first();
        $subSection = $subSection->toArray();
        $subPage = json_decode($subSection['sub_section'], true);

        $project = Project::where('tagged', 1)->get();

        return view('home.index', compact('category', 'arrPostPage', 'banner', 'brand', 'subPage', 'project'));
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

    public function warrantyStation(Request $request){
        $warranties = DB::table('warranty');
        $city = Provinces::all();
        $district = [];

        if($request->has('city')){
            $district = Districts::where('province_id', $request->get('city'))->get();
            $warranties = $warranties->where('city', $request->get('city'));
        }

        if($request->has('district')){
            $warranties = $warranties->where('district', $request->get('district'));
        }

        $warranties = $warranties->get();
        return view('home.warranty.station', compact('warranties', 'city', 'district'));
    }
}
