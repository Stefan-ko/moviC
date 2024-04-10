@extends('layouts.admin')

@section('content')
    <div class="my-4">
        <h1 class="text-2xl font-bold">Фільми</h1>

        <button onclick="window.location='{{ route('admin.movies.create') }}'" class="my-2 py-1 px-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Створити новий фільм</button>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Назва (укр)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Опис (укр)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($movies as $movie)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $movie->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $movie->title_uk }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $movie->description_uk }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <button onclick="window.location='{{ route('admin.movies.edit', $movie->id) }}'" class="bg-blue-500 text-white py-1 px-2 rounded-md hover:bg-blue-600">Редагувати</button>
                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Видалити</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $movies->links() }}
    </div>
@endsection
