<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function listTag(Request $request)
    {
        $tag = Tag::all();

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
}
