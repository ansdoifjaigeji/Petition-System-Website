@extends('layouts.app')

@section('title', 'Voice for Change - Explore Causes')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-dark-navy mb-6 border-b pb-4">Explore All Petitions</h1>
    
    <!-- Filter tags -->
    <div class="bg-white p-8 rounded-xl shadow-lg mb-10">
        <p class="text-gray-700 text-lg mb-4">
            Browse petitions by category or start your own movement.
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mt-6">
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#Environment</span>
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#SocialJustice</span>
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#Education</span>
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#LocalIssues</span>
        </div>
        
        <div class="flex justify-center mt-8">
            <a href="{{ route('petitions.create') }}" 
               class="px-8 py-3 text-white font-semibold bg-primary-orange rounded-lg shadow-xl hover:bg-orange-600 transition duration-300">
                Start a New Petition
            </a>
        </div>
    </div>

    <!-- Petition listing -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($petitions as $petition)
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-dark-navy mb-2">
                        {{ $petition->title }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ \Illuminate\Support\Str::limit($petition->description, 120) }}
                    </p>
                    <div class="flex justify-between text-sm font-medium">
                        <span class="text-blue-600">{{ number_format($petition->signature_count) }} Signatures</span>
                        <span class="text-green-600">Rp {{ number_format($petition->donation_total, 0) }} Donations</span>
                    </div>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('petitions.show', $petition->id) }}" 
                       class="flex-1 px-4 py-2 text-center text-white bg-primary-orange rounded-lg shadow hover:bg-orange-600 transition">
                        View & Donate
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-3 text-center text-gray-600 py-8 bg-white rounded-xl shadow-lg">
                <p class="text-lg font-medium">No petitions found.</p>
                <p class="mt-2">Be the first to 
                    <a href="{{ route('petitions.create') }}" class="text-primary-orange font-semibold hover:underline">
                        start one
                    </a>!
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10">
        {{ $petitions->links() }}
    </div>
</div>
@endsection