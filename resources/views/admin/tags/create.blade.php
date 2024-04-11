@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.tags.store') }}" method="POST">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2 class="text-xl font-bold mt-4">{{ __('messages.tags') }}</h2>
        <div class="mb-4 tag-input">
            <div id="tagsContainer">
                <div class="mb-4 tag-input">
                    <label for="tag_name_1" class="block font-medium">{{ __('messages.name_tag_uk') }}</label>
                    <input type="text" name="tag_name_uk[]" id="tag_name_1" class="w-full border-gray-300 rounded-md">

                    <label for="tag_name_en_1" class="block font-medium">{{ __('messages.name_tag') }}</label>
                    <input type="text" name="tag_name_en[]" id="tag_name_en_1" class="w-full border-gray-300 rounded-md">

                    <label for="tag_slug_1" class="block font-medium">{{ __('messages.slug') }}</label>
                    <input type="text" name="tag_slug[]" id="tag_slug_1" class="w-full border-gray-300 rounded-md" readonly>

                </div>
            </div>
        </div>
    <button type="button" id="addTag" class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('messages.delete_tag_b') }}</button>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">{{ __('messages.create_tag_b') }}</button>
</form>
<div class="mb-4 tag-input">
            @if ($tags->isNotEmpty())
                <ul>
                    @foreach ($tags as $tag)
                        <li>{{ $tag->name_uk }} - {{ $tag->name_en }} - {{ $tag->slug }}</li>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">{{ __('messages.delete_tag_b') }}</button>
                        </form>
                    @endforeach
                </ul>
            @endif
        </div>
@endsection
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
    document.querySelectorAll('[id^="tag_name_"]').forEach(input => {
        input.addEventListener('input', function () {
            const id = this.id.split('_')[2];
            const nameUk = document.getElementById(`tag_name_uk_${id}`).value;
            const nameEn = document.getElementById(`tag_name_en_${id}`).value;
            const slugInput = document.getElementById(`tag_slug_${id}`);
            const slug = nameUk || nameEn;
            slugInput.value = slug.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        });
    });
</script>
