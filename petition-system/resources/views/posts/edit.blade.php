@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
<section class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Article</h1>

        <form action="{{ route('posts.update', $post) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $post->title) }}"
                       class="w-full border rounded-lg px-4 py-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Content</label>
                <textarea name="content"
                          rows="6"
                          class="w-full border rounded-lg px-4 py-2"
                          required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Image</label>
                <input type="file"
                       name="image"
                       class="w-full border rounded-lg px-4 py-2">

                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                         class="mt-3 h-32 rounded-lg">
                @endif
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('posts.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded-lg">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-primary-orange text-white rounded-lg">
                    Update Article
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
