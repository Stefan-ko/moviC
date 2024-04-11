@extends('layouts.admin')

@section('content')
    <div>
        <h1 class="text-2xl font-bold">{{ __('messages.edit_film_page') }}</h1>

        <button onclick="window.location='{{ route('admin.tags.create') }}'"
                class="my-2 py-1 px-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">{{ __('messages.add_tag_b') }}</button>

        <form id="movieForm" action="{{ route('admin.movies.update', $movie->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="status" class="block font-medium">{{ __('messages.status') }}</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-md">
                    <option value="1" {{ $movie->status ? 'selected' : '' }}>{{ __('messages.show') }}</option>
                    <option value="0" {{ !$movie->status ? 'selected' : '' }}>{{ __('messages.hide') }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="title_uk" class="block font-medium">{{ __('messages.title_uk') }}</label>
                <input type="text" name="title_uk" id="title_uk" value="{{ old('title_uk') ?? $movie->title_uk }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="title_en" class="block font-medium">{{ __('messages.title') }}</label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en') ?? $movie->title_en }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="description_uk" class="block font-medium">{{ __('messages.description_uk') }}</label>
                <textarea name="description_uk" id="description_uk" rows="4"
                          class="w-full border-gray-300 rounded-md">{{ old('description_uk') ?? $movie->description_uk }}</textarea>
            </div>

            <div class="mb-4">
                <label for="description_en" class="block font-medium">{{ __('messages.description') }}</label>
                <textarea name="description_en" id="description_en" rows="4"
                          class="w-full border-gray-300 rounded-md">{{ old('description_en') ?? $movie->description_en }}</textarea>
            </div>

            <div class="mb-4">
                <label for="poster" class="block font-medium">{{ __('messages.poster') }}</label>
                <input type="file" name="poster" id="poster" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="screenshots" class="block font-medium">{{ __('messages.screenshots') }}</label>
                <input type="file" name="screenshots[]" id="screenshots" multiple
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="youtube_trailer_id" class="block font-medium">{{ __('messages.youtube_url') }}</label>
                <input type="text" name="youtube_trailer_id" id="youtube_trailer_id"
                       value="{{ old('youtube_trailer_id') ?? $movie->youtube_trailer_id }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="release_year" class="block font-medium">{{ __('messages.release_year') }}</label>
                <input type="number" name="release_year" id="release_year"
                       value="{{ old('release_year') ?? $movie->release_year }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="start_date" class="block font-medium">{{ __('messages.start_date') }}</label>
                <input type="datetime-local" name="start_date" id="start_date"
                       value="{{ old('start_date') ?? $movie->start_date }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block font-medium">{{ __('messages.end_date') }}</label>
                <input type="datetime-local" name="end_date" id="end_date"
                       value="{{ old('end_date') ?? $movie->end_date }}" class="w-full border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="tags" class="block font-medium">{{ __('messages.tags') }}</label>
                <select name="tags[]" id="tags" class="w-full border-gray-300 rounded-md custom-select" multiple size="5">
                @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $movie->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $tag->slug }}
                        </option>
                    @endforeach
                </select>
            </div>


        </form>
        <form id="castForm" action="{{ route('admin.casts.store') }}" method="POST" enctype="multipart/form-data">
            <h2 class="text-xl font-bold mt-4">{{ __('messages.casts') }}</h2>
                    <div id="castMembersContainer">
                        <div class="castMember">
                            <label for="cast_role_1">{{ __('messages.role') }}</label>
                            <select name="cast_role[]" id="cast_role_1">
                                <option value="director">{{ __('messages.director') }}</option>
                                <option value="writer">{{ __('messages.writer') }}</option>
                                <option value="actor">{{ __('messages.actor') }}</option>
                                <option value="composer">{{ __('messages.composer') }}</option>
                            </select>
                            <label for="cast_name_1">{{ __('messages.name_uk') }}</label>
                            <input type="text" name="cast_name_uk[]" id="cast_name_1">
                            <label for="cast_name_en_1">{{ __('messages.name_cast') }}</label>
                            <input type="text" name="cast_name_en[]" id="cast_name_en_1">
                            <label for="cast_photo_1">{{ __('messages.photo') }}</label>
                            <input type="file" name="cast_photo[]" id="cast_photo_1">
                            <button type="button" class="removeCastMember">{{ __('messages.delete_cast_b') }}</button>
                        </div>
                    </div>
        </form>
        <form id="castFormUpdate" action="{{ route('admin.casts.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($casts->isNotEmpty())
            @foreach ($casts as $cast)
                <div class="mb-4">
                    <label for="cast_role_{{ $cast->id }}" class="block font-medium">{{ __('messages.role') }}</label>
                    <select name="cast_role[]" id="cast_role_{{ $cast->id }}">
                        <option value="director" {{ $cast->role == 'director' ? 'selected' : '' }}>{{ __('messages.director') }}</option>
                        <option value="writer" {{ $cast->role == 'writer' ? 'selected' : '' }}>{{ __('messages.writer') }}</option>
                        <option value="actor" {{ $cast->role == 'actor' ? 'selected' : '' }}>{{ __('messages.actor') }}</option>
                        <option value="composer" {{ $cast->role == 'composer' ? 'selected' : '' }}>{{ __('messages.composer') }}</option>
                    </select>
                    <label for="cast_name_{{ $cast->id }}" class="block font-medium">{{ __('messages.name_uk') }}</label>
                    <input type="text" name="cast_name_uk[]" id="cast_name_{{ $cast->id }}"
                           value="{{ $cast->name_uk }}">
                    <label for="cast_name_en_{{ $cast->id }}" class="block font-medium">{{ __('messages.name_cast') }}</label>
                    <input type="text" name="cast_name_en[]" id="cast_name_en_{{ $cast->id }}"
                           value="{{ $cast->name_en }}">
                    <label for="cast_photo_{{ $cast->id }}" class="block font-medium">{{ __('messages.photo') }}</label>
                    <input type="file" name="cast_photo[]" id="cast_photo_{{ $cast->id }}">
                    <input type="hidden" name="cast_id[]" value="{{ $cast->id }}">
                    <button type="button" class="removeCastMember" data-cast-id="{{ $cast->id }}">{{ __('messages.delete_cast_b') }}</button>
                </div>
            @endforeach
                <button type="submit">{{ __('messages.update_cast_b') }}</button>
            @endif
            </form>
            <button type="button" id="addCastMember">{{ __('messages.create_cast_b') }}</button>

        <div class="mt-4">
            <button onclick="saveData()" class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('messages.edit_film_b') }}</button>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let castMemberCount = 1;
        const container = document.getElementById('castMembersContainer');
        const addButton = document.getElementById('addCastMember');

        addButton.addEventListener('click', function () {
            castMemberCount++;
            const newCastMember = container.firstElementChild.cloneNode(true);
            newCastMember.querySelectorAll('[id]').forEach(element => {
                element.id = element.id.slice(0, -1) + castMemberCount;
                element.value = '';
            });
            container.appendChild(newCastMember);
        });
        container.addEventListener('click', function (event) {
            if (event.target.classList.contains('removeCastMember')) {
                const castId = event.target.dataset.castId;
                fetch(`{{ url('admin/casts') }}/${castId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            event.target.parentElement.remove();
                        } else {
                            console.error('Failed to delete cast member');
                        }
                    })
                    .catch(error => console.error(error));
            }
        });
    });

    function saveData() {
        const movieFormData = new FormData(document.forms['movieForm']);
        movieFormData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("admin.movies.update", $movie->id) }}', {
            method: 'POST',
            body: movieFormData,
        })
            .then(response => response.json())
            .then(data => {
                const movieId = data.id;
                const tagIds = Array.from(document.getElementById('tags').selectedOptions)
                    .map(option => option.value);
                const castFormData = new FormData(document.forms['castForm']);
                castFormData.append('_token', '{{ csrf_token() }}');
                castFormData.append('movie_id', movieId);
                castFormData.append('tags_id', tagIds);

                fetch('{{ route("admin.casts.store") }}', {
                    method: 'POST',
                    body: castFormData,
                })
                    .then(response => response.json())
                    .then(data => console.log(data))
                    .catch(error => console.error(error));
            })
            .catch(error => console.error(error));
    }
</script>
<style>
    .custom-select {
        width: 100%;
    }

</style>

