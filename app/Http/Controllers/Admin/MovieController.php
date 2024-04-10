<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
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
        $movie = new Movie($request->all());
        $movie->save();

        return redirect()->route('admin.movies.index');
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->all());
        return redirect()->route('admin.movies.index');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index');
    }
}
