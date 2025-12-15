@extends('layouts.app')

@section('title', 'Add Article')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold mb-6">Add Article</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input 
                type="text" 
                name="title" 
                class="w-full border rounded-lg px-4 py-2"
                required
            >
        </div>

        {{-- Content --}}
        <div>
            <label class="block text-sm font-medium mb-1">Article Content</label>
            <textarea 
                name="content" 
                rows="6"
                class="w-full border rounded-lg px-4 py-2"
                required
            ></textarea>
        </div>

        {{-- Image --}}
        <div>
            <label class="block text-sm font-medium mb-1">Image</label>
            <input type="file" name="image" class="w-full">
        </div>

        {{-- Publish --}}
        <div class="flex justify-end">
            <button 
                type="submit"
                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
            >
                Publish
            </button>
        </div>
    </form>
</div>
@endsection
