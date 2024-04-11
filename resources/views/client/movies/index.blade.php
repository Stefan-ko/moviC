@extends('layouts.client')

@section('content')
    <div class="container">
        <h1 class="my-4">All Movies</h1>

        <div class="row">
            @forelse ($movies as $movie)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="Movie Poster">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->{'title_' . app()->getLocale()} }}</h5>
                            <p class="card-text">{{ $movie->{'description_' . app()->getLocale()} }}</p>
                            <button onclick="window.location='{{ route('client.movies.show',$movie->id)}}'"
                                    class="my-2 py-1 px-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                View Details</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p>No movies found.</p>
                </div>
            @endforelse
        </div>

        {{ $movies->links() }}
    </div>
@endsection
