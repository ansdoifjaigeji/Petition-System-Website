@extends('layouts.app')

@section('title', 'Voice for Change - Start a Petition')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-dark-navy mb-8 text-center border-b pb-4">Launch Your Cause Now</h1>
    
    <div class="bg-white p-8 rounded-xl shadow-2xl">
        <form class="space-y-6" action="{{ route('petitions.store') }}" method="POST">
            @csrf 
            
            <div>
                <label for="title" class="block text-lg font-semibold text-dark-navy">Petition Title</label>
                <input type="text" id="title" name="title" required 
                       class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange text-lg" 
                       placeholder="e.g., Save the Downtown Library from Closure">
            </div>
            
            <div>
                <label for="description" class="block text-lg font-semibold text-dark-navy">Detailed Description</label>
                <textarea id="description" name="description" rows="6" required 
                          class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange" 
                          placeholder="Explain your issue, why it matters, and what action you demand."></textarea>
            </div>

            <div>
                <label for="target" class="block text-lg font-semibold text-dark-navy">Target Decision Maker</label>
                <input type="text" id="target" name="target" 
                       class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange" 
                       placeholder="e.g., City Council, CEO of Acme Corp, State Governor">
            </div>
            
            <button type="submit" class="w-full py-4 text-xl font-bold text-white bg-primary-orange rounded-lg shadow-xl hover:bg-orange-600 transition duration-300 transform hover:scale-[1.01]">
                Create and Publish Petition
            </button>
        </form>
    </div>
</div>
@endsection