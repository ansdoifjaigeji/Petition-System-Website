@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Articles</h1>
        <a href="{{ route('posts.create') }}"
           class="bg-primary-orange text-white px-4 py-2 rounded-lg font-semibold">
            + New Article
        </a>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4">Created</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-t">
                        <td class="p-4 font-medium">{{ $post->title }}</td>
                        <td class="p-4 text-center text-sm text-gray-500">
                            {{ $post->created_at->format('d M Y') }}
                        </td>
                        <td class="p-4 text-center space-x-3">
                            <a href="{{ route('posts.edit', $post) }}"
                               class="text-blue-600 font-semibold">
                                Edit
                            </a>

                            <form action="{{ route('posts.destroy', $post) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 font-semibold"
                                        onclick="return confirm('Delete this article?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-500">
                            No articles yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
