@extends('layouts.app')

@section('title', 'Voice for Change - Explore Causes')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-dark-navy mb-6 border-b pb-4">Explore All Petitions</h1>
    
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <p class="text-gray-700 text-lg mb-4">This page would typically feature search, filters (like Environment, Education, Local Government), and a complete listing of all petitions on the platform.</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mt-6">
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#Environment</span>
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#SocialJustice</span>
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#Education</span>
            <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#LocalIssues</span>
        </div>
        
        <p class="text-center mt-8">Start your own movement today!</p>
        <div class="flex justify-center mt-4">
            <a href="{{ route('petitions.create') }}" class="px-8 py-3 text-white font-semibold bg-primary-orange rounded-lg shadow-xl hover:bg-orange-600 transition duration-300">Start a New Petition</a>
        </div>
    </div>
</div>
@endsection