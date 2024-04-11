<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Service\ImageService;
use Illuminate\Http\Request;
use App\Models\Movie;

class ClientMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);

        return view('client.movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        if (!$movie->status) {
            abort(404);
        }

        return view('client.movies.show', compact('movie'));
    }
}
