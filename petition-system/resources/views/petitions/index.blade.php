@extends('layouts.app')

@section('title', 'Voice for Change - Explore Causes')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <h1 class="text-4xl font-extrabold text-dark-navy mb-6 border-b pb-4">
        Explore All Petitions
    </h1>

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- If no petitions --}}
    @if($petitions->isEmpty())
        <p class="text-gray-600 text-lg text-center mt-12">No petitions found. Be the first to create one!</p>
        <div class="flex justify-center mt-4">
            <a href="{{ route('petitions.create') }}" 
               class="px-8 py-3 text-white font-semibold bg-primary-orange rounded-lg shadow-xl hover:bg-orange-600 transition duration-300">
               Start a New Petition
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($petitions as $petition)
                <div class="bg-white p-6 shadow-xl rounded-xl border border-gray-100 hover:shadow-2xl transition">

                    <h2 class="text-xl font-bold text-dark-navy mb-2">
                        {{ $petition->title }}
                    </h2>

                    <p class="text-gray-600 text-sm mb-3">
                        {{ Str::limit($petition->description, 120) }}
                    </p>

                    @if ($petition->target)
                        <p class="text-sm text-gray-500 mb-3">
                            🎯 Target: <span class="font-medium text-dark-navy">{{ $petition->target }}</span>
                        </p>
                    @endif

                    <p class="text-sm text-gray-500 mb-4">
                        ✍️ Signatures: {{ $petition->signature_count ?? 0 }}
                    </p>

                    {{-- BUTTON SECTION --}}
                    <div class="flex justify-between mt-4">

                        {{-- VIEW --}}
                        <a href="{{ route('petitions.show', $petition->id) }}" 
                           class="text-primary-orange font-semibold hover:underline">
                           View
                        </a>

                        {{-- EDIT & DELETE UNTUK PEMILIK --}}
                        @auth
                            @if($petition->user_id == auth()->id())
                                <a href="{{ route('petitions.edit', $petition->id) }}" 
                                   class="text-blue-600 hover:underline">
                                   Edit
                                </a>

                                <form action="{{ route('petitions.destroy', $petition->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this petition?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        @endauth

                    </div> {{-- END buttons section --}}

                </div>
            @endforeach

        </div>
    @endif
</div>
@endsection
