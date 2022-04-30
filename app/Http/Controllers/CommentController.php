<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comments;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
        // dd($data);
        $user = action_create_user($data);
        Comments::create([
            'user_id'       => $user->id,
            'product_id'    => $data['product_id'],
            'title'         => $data['title'],
            'body'          => $data['body'],
            // 'rating'        => $data['rating'],
            // 'count_quality' => $data['count_quality'],
            // 'count_worth'   => $data['count_worth'],
            // 'count_like'    => $data['count_like'],
            // 'count_dislike' => $data['count_dislike'],
            'publish_at'    => Carbon::now(),
            'file'          => $data['file'],

        ]);


        return response()->json(['success' => 1], 200);
    }
}
