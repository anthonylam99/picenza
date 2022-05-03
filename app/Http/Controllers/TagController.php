<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function listTag(Request $request)
    {
        $tag = Tag::paginate(10);

        if ($request->has('s')) {
            $query = $request->get('s');
            $tag = Tag::where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $tag = Tag::paginate(10);
        }

        return view('admin.tag.list', compact('tag'));
    }

    public function addTag(Request $request)
    {
        return view('admin.tag.add');
    }

    public function addTagPost(Request $request)
    {
        $name = $request->get('name');

        if ($request->has('id')) {
            $id = $request->get('id');
            $tag = Tag::where('id', $id)->update([
                'name' => $request->get('name')
            ]);

            return redirect()->route('admin.tag.edit', ['id' => $id]);
        } else {
            $tag = Tag::create([
                'name' => $name
            ]);
            return redirect()->route('admin.tag.edit', ['id' => $tag->id]);
        }
    }

    public function editTag(Request $request, $id = null)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tag.edit', compact('tag'));
    }

    public function delTag(Request $request, $id = null)
    {
        $tagFind = Tag::findOrFail($id);
        $tagFind->delete();

        $tag = Tag::all();

        return redirect()->route('admin.tag.list');
    }

    /**
     * Update status tag
     *
     * @param Request $request
     * @return void
     */
    public function updateStatus(Request $request){
        $update = Tag::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
}
