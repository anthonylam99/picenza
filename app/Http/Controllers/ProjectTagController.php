<?php

namespace App\Http\Controllers;

use App\Models\ProjectTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectTagController extends Controller
{
    public function listTag(Request $request)
    {
        $tag = ProjectTag::paginate(10);

        if ($request->has('s')) {
            $query = $request->get('s');
            $tag = ProjectTag::where('name', 'like', '%' . $query . '%')->paginate(10);
        } else if (!empty($request->get('s')) || !$request->has('s')) {
            $tag = ProjectTag::paginate(10);
        }

        return view('admin.project.tag.list', compact('tag'));
    }

    public function addTag(Request $request)
    {
        return view('admin.project.tag.add');
    }

    public function addTagPost(Request $request)
    {
        $name = $request->get('name');

        if ($request->has('id')) {
            $id = $request->get('id');
            $tag = ProjectTag::where('id', $id)->update([
                'name' => $request->get('name')
            ]);

            return redirect()->route('admin.project.tag.edit', ['id' => $id]);
        } else {
            $tag = ProjectTag::create([
                'name' => $name
            ]);
            return redirect()->route('admin.project.tag.edit', ['id' => $tag->id]);
        }
    }

    public function editTag(Request $request, $id = null)
    {
        $tag = ProjectTag::findOrFail($id);

        return view('admin.project.tag.edit', compact('tag'));
    }

    public function delTag(Request $request, $id = null)
    {
        $tagFind = ProjectTag::findOrFail($id);
        $tagFind->delete();

        $tag = ProjectTag::all();

        return redirect()->route('admin.project.tag.list');
    }

    /**
     * Update status tag
     *
     * @param Request $request
     * @return void
     */
    public function updateStatus(Request $request){
        $update = ProjectTag::where('id', $request->get('id'))->update([
            'status' => $request->status
        ]);
        if($update){
            return response()->json(['message' => 'Success']);
        }
    }
}
