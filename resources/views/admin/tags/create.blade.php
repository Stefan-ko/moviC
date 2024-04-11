<form action="{{ route('admin.tags.store') }}" method="POST">
    @csrf

    <h2 class="text-xl font-bold mt-4">Додати теги</h2>
        <div class="mb-4 tag-input">
            <div id="tagsContainer">
                <div class="mb-4 tag-input">
                    <label for="tag_name_1" class="block font-medium">Назва (укр)</label>
                    <input type="text" name="tag_name_uk[]" id="tag_name_1" class="w-full border-gray-300 rounded-md">

                    <label for="tag_name_en_1" class="block font-medium">Назва (англ)</label>
                    <input type="text" name="tag_name_en[]" id="tag_name_en_1" class="w-full border-gray-300 rounded-md">

                    <label for="tag_slug_1" class="block font-medium">Слаг</label>
                    <input type="text" name="tag_slug[]" id="tag_slug_1" class="w-full border-gray-300 rounded-md">

                </div>
            </div>
        </div>
    <button type="button" id="addTag" class="bg-blue-500 text-white px-4 py-2 rounded">Додати тег</button>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Зберегти</button>
</form>
<div class="mb-4 tag-input">
            @if ($tags->isNotEmpty())
                <ul>
                    @foreach ($tags as $tag)
                        <li>{{ $tag->name_uk }} - {{ $tag->name_en }} - {{ $tag->slug }}</li>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Видалити</button>
                        </form>
                    @endforeach
                </ul>
            @else
                <p>Тегів поки немає</p>
            @endif
        </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let tagCount = 1;
        const container = document.getElementById('tagsContainer');
        const addButton = document.getElementById('addTag');

        addButton.addEventListener('click', function () {
            tagCount++;
            const newTag = container.firstElementChild.cloneNode(true);
            newTag.querySelectorAll('[id]').forEach(element => {
                element.id = element.id.slice(0, -1) + tagCount;
                element.value = '';
            });
            container.appendChild(newTag);
        });
    });
</script>
