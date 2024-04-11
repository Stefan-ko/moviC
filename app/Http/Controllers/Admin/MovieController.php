<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\ImageService;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {
        $movies = Movie::paginate(10);

        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $movie = new Movie($request->except('poster', 'screenshots'));
        if ($request->hasFile('poster')) {
            $url = $this->imageService->storeAndCropImage($request->file('poster'), 'public/posters', 300, 300);
            $movie->poster = $url;
        }
        if ($request->hasFile('screenshots')) {
                $screenshotUrl = $this->imageService->storeAndCropMultipleImages($request->file('screenshots'), 'public/screenshots', 800, 600);
            $movie->screenshots = $screenshotUrl;
        }
        $movie->save();

        return response($movie);
    }

    public function edit(Movie $movie)
    {
        $casts = $movie->casts;
        $tags = $movie->tags;
        return view('admin.movies.edit', compact('movie', 'casts', 'tags'));
    }

    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->all());
        $movie->tags()->sync($request->get('tags'));
        return response($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index');
    }
}
