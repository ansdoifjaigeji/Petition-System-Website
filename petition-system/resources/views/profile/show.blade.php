@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
        
        <div class="bg-gradient-to-r from-dark-navy to-blue-800 h-32 relative"></div>
        
        <div class="px-8 pb-8">
            <div class="relative -mt-16 mb-4">
                <div class="h-32 w-32 rounded-full bg-white dark:bg-gray-800 p-1 mx-auto sm:mx-0">
                    <div class="h-full w-full rounded-full bg-primary-orange flex items-center justify-center text-4xl text-white font-bold border-4 border-white dark:border-gray-800">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <div class="sm:flex sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    <p class="mt-2 text-xs text-gray-400">Member since {{ $user->created_at->format('M d, Y') }}</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('profile.settings') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-white uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">My Activity</h3>
                @if(isset($comments) && $comments->count() > 0)
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <h4 class="font-semibold mb-3">My Recent Comments</h4>
                        <ul class="space-y-3 text-left text-gray-700 dark:text-gray-300">
                            @foreach($comments as $comment)
                                <li class="border border-gray-200 rounded p-3 flex justify-between items-start">
                                    <div>
                                        <a href="{{ route('petitions.show', $comment->petition->id) }}" class="font-semibold text-blue-600 hover:underline">{{ $comment->petition->title }}</a>
                                        <p class="text-sm italic mt-1">"{{ $comment->comment }}"</p>
                                        <p class="text-xs text-gray-500 mt-1">Signed on {{ $comment->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <form action="{{ route('signature.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete your comment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 text-center text-gray-500 dark:text-gray-400">
                        <p>You haven't posted any comments yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection