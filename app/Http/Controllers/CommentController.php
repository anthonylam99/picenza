<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comments;
use App\Models\Product;
use Carbon\Carbon;
use Session;

class CommentController extends Controller
{
    /**
     * Store review images
     *
     * @param Request $request
     * @return void
     */
    public function postRatingImage(Request $request)
    {
        $image = $request->file('formData');
        $newImage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/images/testimonial'), $newImage);
        return response()->json(['url' => $request->getSchemeAndHttpHost() . '/storage/images/testimonial/' . $newImage]);
    }

    /**
     * Store a newly review
     *
     * @param CommentStoreRequest $request
     * @return void
     */
    public function submitRatingComment(CommentStoreRequest $request)
    {
        $data = $request->validated();
        $user = action_create_user($data);
        Comments::create([
            'user_id'       => $user->id,
            'product_id'    => $data['product_id'],
            'title'         => $data['title'],
            'body'          => $data['body'],
            'rating'        => $data['rating'],
            'count_worth'   => $data['count_worth'],
            'count_quality' => $data['count_quality'],
            'publish_at'    => Carbon::now(),
            'file'          => $data['file'],
        ]);

        $averageStar = calculateAverageReview($data['product_id'], 'rating');

        $product = Product::find($data['product_id']);

        $product->update([
            'rating' => $averageStar,
        ]);


        return response()->json(['success' => 1], 200);
    }

    /**
     * Ajax find comment by name
     *
     * @param Request $request
     * @return json
     */
    public function findComment(Request $request)
    {
        $aryComment = Comments::with('user')->where('title', 'like', '%'.$request->search_review.'%')->first();

        return response()->json(['data' => $aryComment], 200);
    }

    /**
     * Ajax update like and dislike comment
     *
     * Operator 1 = plus, 0 = subtract
     * @param Request $request
     * @return json
     */
    public function updateLikeAndDisLikeCommment(Request $request)
    {
        $comment =  Comments::find($request->id);
        $action = $request->action;
        if ($request->count == 0) {
            Session::put('operator', 1); 
            $count = $comment->$action + 1;

            $comment->update([
                $action => $count
            ]);

            return response()->json(['count' => $count], 200);
        }

        if (Session::has('operator')) {
            if ( Session::get('operator') == 1 ) { // last session is plus and now we must subtract the like
                Session::put('operator', 0); 
                $count = $comment->$action - 1;

                $comment->update([
                    $action => $count
                ]);

                return response()->json(['count' => $count], 200);
            }
            else {
                Session::put('operator', 1); 
                $count = $comment->$action + 1;

                $comment->update([
                    $action => $count
                ]);

                return response()->json(['count' => $count], 200);
            }
        }
}
}
