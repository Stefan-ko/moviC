@extends('layouts.client')

@section('content')
    <div class="container">
        <h1>{{ $movie->{'title_' . App::getLocale()} }}</h1>
        <p>{{ $movie->{'description_' . App::getLocale()} }}</p>
        <p>Release Year: {{ $movie->release_year }}</p>
        <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="Poster">
        <h2>Screenshots:</h2>
        <div class="row">
            @foreach ($movie->screenshots as $screenshot)
                <div class="col-md-4 mb-4">
                    <img src="{{ asset($screenshot) }}" class="img-fluid" alt="Screenshot">
                </div>
            @endforeach
        </div>
        <h2>Cast:</h2>
        <ul>
            @foreach ($movie->casts as $actor)
                <li>{{ $actor->role }}</li>
                <li>{{ $actor->{'name' . App::getLocale()} }}</li>
                <img src="{{ asset($movie->photo) }}" class="card-img-top" alt="Cast Photo">
            @endforeach
        </ul>

        @if ($movie->youtube_trailer_id)
            @if (!$movie->start_date || !$movie->end_date || (now() >= $movie->start_date && now() <= $movie->end_date))
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $movie->youtube_trailer_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endif
        @endif
    </div>
@endsection
