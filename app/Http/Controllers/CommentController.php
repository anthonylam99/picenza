<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comments;
use App\Models\Product;
use Carbon\Carbon;

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
}
