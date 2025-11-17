@extends('layouts.app')

@section('title', 'Voice for Change - Home')

@section('content')

<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="z-10 max-w-4xl px-4">
        <h1 class="text-5xl sm:text-7xl font-extrabold text-white leading-tight mb-6 tracking-tight">
            BE THE CHANGE.
            <span class="block mt-2">CREATE YOUR PETITION</span>
        </h1>
        
        <a href="{{ route('petitions.create') }}" class="inline-block px-10 py-4 text-lg font-bold text-white bg-primary-orange rounded-lg shadow-2xl uppercase transition duration-300 transform hover:scale-105 hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-primary-orange focus:ring-opacity-50">
            LAUNCH YOUR CAUSE NOW
        </a>
    </div>
</section>

<section class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Trending Petitions</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        @forelse ($trending_petitions as $petition)
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <h3 class="text-xl font-semibold text-dark-navy mb-2">
                    {{ $petition->title }}
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    {{ \Illuminate\Support\Str::limit($petition->description, 100) }}
                </p>
                <span class="text-sm font-medium text-primary-orange">
                    {{ number_format($petition->signature_count) }} Signatures
                </span>
            </div>
        @empty
            <div class="col-span-1 md:col-span-3 text-center text-gray-600 py-8 bg-white rounded-xl shadow-lg">
                <p class="text-lg font-medium">No trending petitions yet.</p>
                <p class="mt-2">Be the first to <a href="{{ route('petitions.create') }}" class="text-primary-orange font-semibold hover:underline">start one</a>!</p>
            </div>
        @endforelse

    </div>
</section>
@endsection