<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.tags.create',compact('tags'));
    }

    public function store(Request $request)
    {
        foreach ($request->get('tag_name_uk') as $key => $tag_name_uk) {
            $tag = new Tag();
            $tag->name_uk = $tag_name_uk;
            $tag->name_en = $request->get('tag_name_uk')[$key];
            $tag->slug = $request->get('tag_name_uk')[$key];
            $tag->save();
        }

        return redirect()->back()->with('success', 'Tags added successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.create');
    }
}
