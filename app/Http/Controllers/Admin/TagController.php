<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return response($tags);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.tags.create',compact('tags'));
    }

    public function store(TagStoreRequest $request)
    {
        $currentLocale = app()->getLocale();
        foreach ($request->get('tag_name_' . $currentLocale) as $key => $tag_name) {
            $tagSlug = $request->get('tag_slug')[$key] ?? Str::slug($tag_name, '-');

            $tag = new Tag();
            $tag->slug = $tagSlug;
            $tag->name_uk = $request->get('tag_name_uk')[$key];
            $tag->name_en = $request->get('tag_name_en')[$key];
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
