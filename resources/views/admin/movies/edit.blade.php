@extends('layouts.admin')

@section('content')
    <div>
        <h1 class="text-2xl font-bold">Редагування фільму</h1>

        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="status" class="block font-medium">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-md">
                    <option value="1" {{ $movie->status ? 'selected' : '' }}>Show</option>
                    <option value="0" {{ !$movie->status ? 'selected' : '' }}>Hide</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="title_uk" class="block font-medium">Title (Ukrainian)</label>
                <input type="text" name="title_uk" id="title_uk" value="{{ old('title_uk') ?? $movie->title_uk }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="title_en" class="block font-medium">Title (English)</label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en') ?? $movie->title_en }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="description_uk" class="block font-medium">Description (Ukrainian)</label>
                <textarea name="description_uk" id="description_uk" rows="4" class="w-full border-gray-300 rounded-md">{{ old('description_uk') ?? $movie->description_uk }}</textarea>
            </div>

            <div class="mb-4">
                <label for="description_en" class="block font-medium">Description (English)</label>
                <textarea name="description_en" id="description_en" rows="4" class="w-full border-gray-300 rounded-md">{{ old('description_en') ?? $movie->description_en }}</textarea>
            </div>

            <div class="mb-4">
                <label for="poster" class="block font-medium">Poster</label>
                <input type="file" name="poster" id="poster" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="screenshots" class="block font-medium">Screenshots</label>
                <input type="file" name="screenshots[]" id="screenshots" multiple class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="youtube_trailer_id" class="block font-medium">YouTube Trailer ID</label>
                <input type="text" name="youtube_trailer_id" id="youtube_trailer_id" value="{{ old('youtube_trailer_id') ?? $movie->youtube_trailer_id }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="release_year" class="block font-medium">Release Year</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year') ?? $movie->release_year }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="start_date" class="block font-medium">Start Date</label>
                <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') ?? $movie->start_date }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block font-medium">End Date</label>
                <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') ?? $movie->end_date }}" class="w-full border-gray-300 rounded-md">
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Зберегти</button>
            </div>

        </form>
    </div>
@endsection
