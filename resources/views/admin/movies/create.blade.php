@extends('layouts.admin')

@section('content')
    <div>
        <h1 class="text-2xl font-bold">Створення фільму</h1>

        <form id="movieForm" action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="status" class="block font-medium">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-md">
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="title_uk" class="block font-medium">Title (Ukrainian)</label>
                <input type="text" name="title_uk" id="title_uk" value="{{ old('title_uk') }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="title_en" class="block font-medium">Title (English)</label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="description_uk" class="block font-medium">Description (Ukrainian)</label>
                <textarea name="description_uk" id="description_uk" rows="4"
                          class="w-full border-gray-300 rounded-md">{{ old('description_uk') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="description_en" class="block font-medium">Description (English)</label>
                <textarea name="description_en" id="description_en" rows="4"
                          class="w-full border-gray-300 rounded-md">{{ old('description_en') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="poster" class="block font-medium">Poster</label>
                <input type="file" name="poster" id="poster" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="screenshots" class="block font-medium">Screenshots</label>
                <input type="file" name="screenshots[]" id="screenshots" multiple
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="youtube_trailer_id" class="block font-medium">YouTube Trailer ID</label>
                <input type="text" name="youtube_trailer_id" id="youtube_trailer_id"
                       value="{{ old('youtube_trailer_id') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="release_year" class="block font-medium">Release Year</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year') }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="start_date" class="block font-medium">Start Date</label>
                <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block font-medium">End Date</label>
                <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                       class="w-full border-gray-300 rounded-md">
            </div>
        </form>
        <label for="cast">Каст</label>
        <form id="castForm" action="{{ route('admin.casts.store') }}" method="POST"  enctype="multipart/form-data">
            <div>
                <div id="castMembersContainer">
                    <div class="castMember">
                        <label for="cast_role_1">Тип</label>
                        <select name="cast_role[]" id="cast_role_1">
                            <option value="director">Режисер</option>
                            <option value="writer">Сценарист</option>
                            <option value="actor">Актор</option>
                            <option value="composer">Композитор</option>
                        </select>
                        <label for="cast_name_1">Ім'я (укр)</label>
                        <input type="text" name="cast_name_uk[]" id="cast_name_1">
                        <label for="cast_name_en_1">Ім'я (англ)</label>
                        <input type="text" name="cast_name_en[]" id="cast_name_en_1">
                        <label for="cast_photo_1">Фото</label>
                        <input type="file" name="cast_photo[]" id="cast_photo_1">
                        <button type="button" class="removeCastMember">Видалити</button>
                    </div>
                </div>
            </div>
        </form>
        <button type="button" id="addCastMember">Додати учасника</button>
        <div class="mt-4">
            <button onclick="saveData()" class="bg-blue-500 text-white px-4 py-2 rounded">Зберегти</button>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let castMemberCount = 1;
        const container = document.getElementById('castForm');
        const addButton = document.getElementById('addCastMember');

        addButton.addEventListener('click', function () {
            castMemberCount++;
            const newCastMember = container.firstElementChild.cloneNode(true);
            newCastMember.querySelectorAll('[id]').forEach(element => {
                element.id = element.id.slice(0, -1) + castMemberCount;
            });
            container.appendChild(newCastMember);
        });
        container.addEventListener('click', function (event) {
            if (event.target.classList.contains('removeCastMember')) {
                event.target.parentElement.remove();
            }
        });
    });

    function saveData() {
        const movieFormData = new FormData(document.forms['movieForm']);
        movieFormData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("admin.movies.store") }}', {
            method: 'POST',
            body: movieFormData,
        })
            .then(response => response.json())
            .then(data => {
                const movieId = data.id;
                const castFormData = new FormData(document.forms['castForm']);
                castFormData.append('_token', '{{ csrf_token() }}');
                castFormData.append('movie_id', movieId);

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
