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
        $movieData = $request->except('poster', 'screenshots');
        $movie = new Movie($movieData);


        $this->handlePoster($request, $movie);
        $this->handleScreenshots($request, $movie);

        $movie->save();

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $movieData = $request->except('poster', 'screenshots');
        $movie->update($movieData);

        $this->handlePoster($request, $movie);
        $this->handleScreenshots($request, $movie);

        $movie->tags()->sync($request->get('tags'));
        return response($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index');
    }
    protected function handlePoster(Request $request, Movie $movie)
    {
        if ($request->hasFile('poster')) {
            $url = $this->imageService->storeAndCropImage($request->file('poster'), 'public/posters', 300, 300);
            $movie->poster = $url;
        }
    }

    protected function handleScreenshots(Request $request, Movie $movie)
    {
        if ($request->hasFile('screenshots')) {
            $screenshotUrl = $this->imageService->storeAndCropMultipleImages($request->file('screenshots'), 'public/screenshots', 800, 600);
            $movie->screenshots = $screenshotUrl;
        }
    }
}
