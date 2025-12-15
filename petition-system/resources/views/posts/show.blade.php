@extends('layouts.app')

@section('title', $post->title)

@section('content')
<section class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <article class="bg-white rounded-xl shadow-lg p-8">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->title }}"
                 class="w-full h-64 object-cover rounded-lg mb-6">
        @endif

        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
            {{ $post->title }}
        </h1>

        <p class="text-sm text-gray-500 mb-6">
            Published on {{ $post->created_at->format('F d, Y') }}
        </p>

        <div class="prose max-w-none text-gray-800">
            {!! nl2br(e($post->content)) !!}
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('posts.edit', $post) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Edit
                    </a>

                    <form action="{{ route('posts.destroy', $post) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg"
                                onclick="return confirm('Delete this article?')">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </article>
</section>
@endsection
